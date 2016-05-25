<?php

namespace App\Http\Controllers;

use App\Category;
use App\Ad;
use Illuminate\Http\Request;
use Symfony\Component\DomCrawler\Crawler;
use Carbon\Carbon;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ParserController extends Controller
{


    //show parse page
    public function index(){
        return view('parse');
    }

    //autoparse
    public function scheduleParsing(){

    }


    public function parseSS(){

        $base = 'https://www.ss.lv';

//        $input = Input::get();
//        set_time_limit($input['time']);
//        $delay = $input['delay'];
//        $numberOfPages = $input['pages'];
        set_time_limit(0);
        $delay = 5;
        $numberOfPages = 1;

        $newAdCounter = 0;
        $duplicateCounter = 0;
        $duplicates = [];

        $crawler = new Crawler();
        $startTime = Carbon::now();
        $categories = Category::all('id', 'name')->toArray();

        foreach ($categories as $category) {
            $categoryName = str_replace(' ', '-', $category['name']);
            $categoryID = $category['id'];
            $categoryUrl = $base . '/ru/transport/cars/' . $categoryName . '/all/sell/';

            $crawler->clear();
            $crawler->add(file_get_contents($categoryUrl));

            for($i = 1; $i<=$numberOfPages; $i++) {
                $crawler
                    ->filter('[id^=tr_3]')
                    ->each(function (Crawler $nodeCrawler) use ($categoryID, &$newAdCounter, &$duplicateCounter, &$duplicates) {
                        $ad = new Ad();
                        $ad->category_id = $categoryID;
                        $ad->url = $nodeCrawler->filter('.msga2 a')->link()->getUri();
                        $ad->img = $nodeCrawler->filter('.msga2 img')->attr('src');
                        $ad->description = str_replace(array("\n", "\r", "  "), '', $nodeCrawler->filter('.msg2 .d1 a')->text());
                        $ad->model = $nodeCrawler->filter('.pp6')->text();
                        $ad->year = $nodeCrawler->filter('.pp6')->eq(1)->text();
                        $ad->capacity = $nodeCrawler->filter('.pp6')->eq(2)->text();
                        $ad->mileage =  str_replace('тыс.', '000', $nodeCrawler->filter('.pp6')->eq(3)->text());
                        $ad->price = str_replace(' €', '€', str_replace(',', ' ', $nodeCrawler->filter('.pp6')->eq(4)->text()));
                        if (!$ad->isDuplicate()) {
                            $ad->save();
                            $newAdCounter++;
                        }
                        else {
                            $duplicates[] = $ad->url;
                            $duplicateCounter++;
                        }
                    });

                sleep($delay);
                $pages = $crawler->filter('div.td2 a.navi')->extract(array('href'));
                if (empty($pages) || $i == $numberOfPages) break;
                $pageUrl = $base . $pages[$i];
                $crawler->clear();
                $crawler->add(file_get_contents($pageUrl));
            }
        }

        $result = [
            'duplicates' => $duplicates, //test
            'new' => $newAdCounter,
            'duplicateCounter' => $duplicateCounter,
            'time' =>  $startTime->diffInSeconds()
        ];

        return view('parse', compact('result'));
    }


    public static function parseLatAuto(){

        set_time_limit(0);
        $startTime = Carbon::now();
        $delay = 5;
        $numberOfPages = 1;
        $newAdCounter = 0;
        $duplicateCounter = 0;

        $base = 'http://ru.latauto.lv';
        $crawler = new Crawler(file_get_contents($base));
        $lat = $crawler->filter('div.fl.search_side option')->extract(array('_text', 'value'));
        $ss = Category::all('name', 'id')->toArray();

        foreach ($lat as $latn) {
            foreach ($ss as $ssn) {
                if($ssn['name'] == $latn['0']){

                    $categories[] = [
                        'name' => $latn['0'],
                        'value' => $latn['1'],
                        'id' => $ssn['id']
                    ];
                    break;
                }
            }
        }
        $categories[] = ['name' => 'Mercedes', 'value' => '67', 'id' => 27];

        $duplicates = [];

        foreach ($categories as $category) {
            $categoryValue = $category['value'];
            $categoryID = $category['id'];

            $categoryUrl = $base . '/objavlenija/b-u-avtomobili?fk_place_countries_id=2&make_id='
                . $categoryValue . '&order_by=1&order_direction=DESC';
            $crawler->clear();
            $crawler->add(file_get_contents($categoryUrl));

            for($i = 1; $i<=$numberOfPages; $i++) {

                $crawler
                    ->filter('li div.item')
                    ->each(function (Crawler $nodeCrawler) use ($categoryID, &$newAdCounter, &$duplicateCounter, &$duplicates) {
                        $title = explode(", ", $nodeCrawler->filter('h2.title-list a')->text());
                        $model = explode(" ", reset($title));
                        $capacity = explode(" ", $title[1]);
                        $year = explode("-",$nodeCrawler->filter('div.param-list span')->text());
                        $mileage = '';
                        for($j = 5; $j>=2; $j--) {
                            $str = $nodeCrawler->filter('div.param-list span')->eq($j)->text();
                            if(strpos($str, 'км') !== false){
                                $mileage = $str;
                                break;
                            }
                        }
                        $ad = new Ad();
                        $ad->category_id = $categoryID;
                        $ad->url = $nodeCrawler->filter('div.thumb a')->attr('href');
                        $ad->img = $nodeCrawler->filter('div.thumb a img')->count() ?
                            $nodeCrawler->filter('div.thumb a img')->attr('src') : 'noimage';
                        $ad->model = end($model);
                        $ad->capacity = is_numeric(reset($capacity)) ? reset($capacity) : '';
                        $ad->price = $nodeCrawler->filter('div.price-list strong')->text();
                        $ad->year = reset($year);
                        $ad->mileage = $mileage;

                        if($nodeCrawler->filter('div.param-list span+span')->text() == 'Дизель') {
                            $ad->capacity .= 'D';
                        }

                        if (!$ad->isDuplicate()) {
                            $ad->save();
                            $newAdCounter++;
                        }
                        else {
                            $duplicates[] = $ad->url;
                            $duplicateCounter++;
                        }

                    });

                sleep($delay);
                //pages (max 10)

                $pages = $crawler->filter('div.paging-bot ul.paging a')->extract(array('href'));
                array_pop($pages);
                if (empty($pages) || $i == $numberOfPages) break;

                $pageUrl = $base . $pages[$i];
                $crawler->clear();
                $crawler->add(file_get_contents($pageUrl));
            }
        }
        $result = [
            'duplicates' => $duplicates, //test
            'new' => $newAdCounter,
            'duplicateCounter' => $duplicateCounter,
            'time' =>  $startTime->diffInSeconds()
        ];

        return view('parse', compact('result'));
    }


    public static function parseAuto24(){

        set_time_limit(0);
        $startTime = Carbon::now();
        $delay = 5;
        $numberOfPages = 1;
        $newAdCounter = 0;
        $duplicateCounter = 0;

        $base = 'http://rus.auto24.lv';
        $crawler = new Crawler(file_get_contents($base));

        $auto = $crawler->filter('div.field #searchParam-cmm-1-make option')->extract(array('_text'));


        $categories = Category::all('id', 'name')->toArray();


        $duplicates = [];

        foreach ($categories as $category) {
            $categoryName = str_replace(' ', '_', strtolower($category['name']));
            $categoryID = $category['id'];
            if($categoryName == 'mercedes') {
                $categoryName = 'mercedesbenz';
            } else if($categoryName == 'izh') {
                $categoryName = 'iz';
            }

            $categoryUrl = $base . '/lietoti/' . $categoryName . '/all/sell/';
            $crawler->clear();
            $crawler->add(file_get_contents($categoryUrl));

            for($i = 1; $i<=$numberOfPages; $i++) {

                $crawler
                    ->filter('tr.result-row')
                    ->each(function (Crawler $nodeCrawler) use ($categoryID, $base, &$newAdCounter, &$duplicateCounter, &$duplicates) {

//                        $title = explode(", ", $nodeCrawler->filter('h2.title-list a')->text());
//                        $model = explode(" ", reset($title));
//                        $capacity = explode(" ", $title[1]);
//                        $year = explode("-",$nodeCrawler->filter('div.param-list span')->text());
//                        $mileage = '';
//                        for($j = 5; $j>=2; $j--) {
//                            $str = $nodeCrawler->filter('div.param-list span')->eq($j)->text();
//                            if(strpos($str, 'км') !== false){
//                                $mileage = $str;
//                                break;
//                            }
//                        }

//                        $title = explode('.', $nodeCrawler->filter('td.make_and_model a')->text());
//                        $title = explode(' ', reset($title));
                        $title = $nodeCrawler->filter('td.make_and_model a')->text();


                        $pos = strpos($title, '.');
                        $capacity = $pos !== false ? $title[$pos-1] . '.' . $title[$pos+1] : '';


                        dd($capacity);

                        $ad = new Ad();

                        $ad->category_id = $categoryID;
                        $ad->url = $base . $nodeCrawler->filter('td.pictures a')->attr('href');
                        $ad->img = $nodeCrawler->filter('td.pictures a img')->attr('src');




//                        $ad->model = end($model);
//                        = is_numeric(reset($capacity)) ? reset($capacity) : '';
//                        $ad->price = $nodeCrawler->filter('div.price-list strong')->text();
//                        $ad->year = reset($year);
//                        $ad->mileage = $mileage;

//                        if($nodeCrawler->filter('div.param-list span+span')->text() == 'Дизель') {
//                            $ad->capacity .= 'D';
//                        }

                        if (!$ad->isDuplicate()) {
                            $ad->save();
                            $newAdCounter++;
                        }
                        else {
                            $duplicates[] = $ad->url;
                            $duplicateCounter++;
                        }

                    });

                sleep($delay);
                //pages (max 10)

                $pages = $crawler->filter('div.paging-bot ul.paging a')->extract(array('href'));
                array_pop($pages);
                if (empty($pages) || $i == $numberOfPages) break;

                $pageUrl = $base . $pages[$i];
                $crawler->clear();
                $crawler->add(file_get_contents($pageUrl));
            }
        }
        $result = [
            'duplicates' => $duplicates, //test
            'new' => $newAdCounter,
            'duplicateCounter' => $duplicateCounter,
            'time' =>  $startTime->diffInSeconds()
        ];

        return view('parse', compact('result'));
    }

}
