<?php

namespace App\Http\Controllers;

use App\Category;
use App\Ad;
use Illuminate\Support\Facades\Input;
use Symfony\Component\DomCrawler\Crawler;
use Carbon\Carbon;
use App\Http\Requests;

class ParserController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }


    //show parse page
    public function index(){
        return view('parse');
    }

    public function scheduleParsing(){
        $this->parseSS();
        $this->parseLatAuto();
        $this->parseAuto24();
    }

    public function parseSS(){
        $input = Input::get();
        set_time_limit($input['limit']);
        $numberOfPages = $input['pages'];
        $delay = $input['delay'];

        $newAdCounter = 0;
        $duplicateCounter = 0;
        $duplicates = [];

        $base = 'https://www.ss.lv';
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
                        $ad->description = str_replace(["\n", "\r", '  '], ' ', $nodeCrawler->filter('.msg2 .d1 a')->text());
                        $ad->model = $nodeCrawler->filter('.pp6')->text();
                        $ad->year = $nodeCrawler->filter('.pp6')->eq(1)->text();
                        $ad->capacity = $nodeCrawler->filter('.pp6')->eq(2)->text();
                        $ad->mileage =  str_replace(' тыс.', '000', $nodeCrawler->filter('.pp6')->eq(3)->text());
                        $ad->price = str_replace([',', '  €'], '', $nodeCrawler->filter('.pp6')->eq(4)->text());
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

        $input = Input::get();
        set_time_limit($input['limit']);
        $numberOfPages = $input['pages'];
        $delay = $input['delay'];

        $startTime = Carbon::now();
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

                        $ad = new Ad();
                        $ad->category_id = $categoryID;
                        $ad->url = $nodeCrawler->filter('div.thumb a')->attr('href');
                        $ad->img = $nodeCrawler->filter('div.thumb a img')->count() ?
                            $nodeCrawler->filter('div.thumb a img')->attr('src') : 'noimage';
                        $ad->model = end($model);
                        $ad->capacity = is_numeric(reset($capacity)) ? reset($capacity) : '';
                        $ad->price = str_replace([' ', '€'], '', $nodeCrawler->filter('div.price-list strong')->text());
                        $ad->year = reset($year);
                        $ad->mileage = $nodeCrawler->filter('div.param-list span[title="Пробег"]')->count() ?
                            str_replace(['км', ' '], '', $nodeCrawler->filter('div.param-list span[title="Пробег"]')->text()) : '';
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
        $input = Input::get();
        set_time_limit($input['limit']);
        $numberOfPages = $input['pages'];
        $delay = $input['delay'];
        dd();
        $startTime = Carbon::now();
        $newAdCounter = 0;
        $duplicateCounter = 0;

        $base = 'http://rus.auto24.lv';
        $crawler = new Crawler(file_get_contents($base));

        $categories = Category::all('id', 'name')->toArray();

        foreach ($categories as &$category) {
            $category['name'] = str_replace(' ', '_', strtolower($category['name']));
            if($category['name'] == 'mercedes') {
                $category['name'] = 'mercedesbenz';
            } else if($category['name'] == 'izh') {
                $category['name'] = 'iz';
            }
        }

        $duplicates = [];

        foreach ($categories as $category) {
            $categoryName = $category['name'];
            $categoryID = $category['id'];

            $categoryUrl = $base . '/lietoti/' . $categoryName . '/all/sell/';
            $crawler->clear();
            $crawler->add(file_get_contents($categoryUrl));

            for($i = 1; $i<=$numberOfPages; $i++) {

                $crawler
                    ->filter('tr.result-row')
                    ->each(function (Crawler $nodeCrawler) use ($categoryID, $base, &$newAdCounter, &$duplicateCounter, &$duplicates) {

                        $title = $nodeCrawler->filter('td.make_and_model a')->text();
                        $pos = strpos($title, '.');
                        $capacity = $pos !== false ? $title[$pos-1] . '.' . $title[$pos+1] : '';
                        $title = explode(' ', $title); //check
                        $mileage = explode('км', $nodeCrawler->filter('td.make_and_model div.extra')->text());

                        $ad = new Ad();
                        $ad->category_id = $categoryID;
                        $ad->url = $base . $nodeCrawler->filter('td.pictures a')->attr('href');
                        $ad->img = $nodeCrawler->filter('td.pictures a img')->attr('src');
                        $ad->model = $title[1]; //check
                        $ad->capacity = $capacity;
                        $ad->mileage = str_replace(' ', '', $mileage[0]); //check
                        $ad->year = $nodeCrawler->filter('td.year')->text();
                        $ad->price = $nodeCrawler->filter('td.price')->text();
                        if($nodeCrawler->filter('td.fuel')->text() == 'Д') {
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



}
