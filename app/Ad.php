<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\DomCrawler\Crawler;

class Ad extends Model
{
    protected $table = 'ads';

    protected $fillable = [
        'url',
        'img',
        'description',
        'model',
        'year',
        'capacity',
        'mileage',
        'price'
    ];

    //category that belong to the ad
//    public function category(){
//
//        return $this->belongsTo('App\Category');
//    }

    public function scopeSort($query, $option){
        switch ($option) {
            case 'price_desc':
                return $query->orderByRaw('LENGTH(price) DESC, price');
            case 'date_desc':
                return $query->orderBy('created_at', 'desc');
            case 'date_asc':
                return $query->orderBy('created_at', 'asc');
            default:
                return $query->orderByRaw('LENGTH(price), price');
        }
    }
//
//    public function scopeNewest($query){
//        return $query->orderBy('created_at', 'desc')->get();
//    }
//
//    public function scopeOldest($query){
//        return $query->orderBy('created_at', 'asc')->get();
//    }
//
//    public function scopeLowestPrice($query){
//        return $query->orderByRaw('LENGTH(price), price');
//    }
//
//    public function scopeHighestPrice($query){
//        return $query->orderByRaw('LENGTH(price) DESC, price');
//    }

    public function isDuplicate(){
        $mileage = explode(' ', $this->mileage);
        if(Ad::where('url', $this->url)->first()) {
            return true;
        } else if(Ad::where('model', $this->model)
                    ->where('year', $this->year)
                    ->where('price', $this->price)
                    ->where('mileage', reset($mileage))
                    ->first()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     *
     */
    public static function parseSS(){

        set_time_limit(0);
        $base = 'https://www.ss.lv';
        $crawler = new Crawler();
        $startTime = Carbon::now();
        $delay = 5;
        $numberOfPages = 1;
        $newAdCounter = 0;
        $duplicateCounter = 0;
        $categories = Category::all('id', 'name')->toArray();
        $duplicates = [];

        foreach ($categories as $category) {
            $categoryName = str_replace(' ', '-', $category['name']);
            $categoryID = $category['id'];
            $categoryUrl = $base . '/ru/transport/cars/' . $categoryName . '/all/sell/';

            $crawler->clear();
            $crawler->add(file_get_contents($categoryUrl));

            for($i = 1; $i<=$numberOfPages; $i++) {
//                $adInfo = $crawler
//                    ->filter('[id^=tr_3]')
//                    ->each(function (Crawler $nodeCrawler) {
//                        //    use ($title)
//
//
//
//                        return [
//                            'url' => $nodeCrawler->filter('.msga2 a')->link()->getUri(),
//                            'img' => $nodeCrawler->filter('.msga2 img')->attr('src'),
//                            'description' => str_replace(array("\n", "\r", "  "), '', $nodeCrawler->filter('.msg2 .d1 a')->text()),
//                            'model' => $nodeCrawler->filter('.pp6')->text(),
//                            'year' => $nodeCrawler->filter('.pp6 + .pp6')->text(),
//                            'capacity' => $nodeCrawler->filter('.pp6 + .pp6 + .pp6')->text(),
//                            'mileage' => $nodeCrawler->filter('.pp6 + .pp6 + .pp6 + .pp6')->text(),
//                            'price' => $nodeCrawler->filter('.pp6 + .pp6 + .pp6 + .pp6 + .pp6')->text(),
//                        ];
//
//                    });
                $crawler
                    ->filter('[id^=tr_3]')
                    ->each(function (Crawler $nodeCrawler) use ($categoryID, &$newAdCounter, &$duplicateCounter, &$duplicates) {

                        $ad = new Ad();
                        $ad->category_id = $categoryID;
                        $ad->url = $nodeCrawler->filter('.msga2 a')->link()->getUri();
                        $ad->img = $nodeCrawler->filter('.msga2 img')->attr('src');
                        $ad->description = str_replace(array("\n", "\r", "  "), '', $nodeCrawler->filter('.msg2 .d1 a')->text());
                        $ad->model = $nodeCrawler->filter('.pp6')->text();
                        $ad->year = $nodeCrawler->filter('.pp6 + .pp6')->text();
                        $ad->capacity = $nodeCrawler->filter('.pp6 + .pp6 + .pp6')->text();
                        $ad->mileage =  str_replace('тыс.', '000', $nodeCrawler->filter('.pp6 + .pp6 + .pp6 + .pp6')->text());
                        $ad->price = str_replace(' €', '€', str_replace(',', ' ', $nodeCrawler->filter('.pp6 + .pp6 + .pp6 + .pp6 + .pp6')->text()));

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
                //pages (max 9)
                $pages = $crawler->filter('div.td2 a.navi')->extract(array('href'));
                if (empty($pages) || $i == $numberOfPages) break;

                $pageUrl = $base . $pages[$i];
                $crawler->clear();
                $crawler->add(file_get_contents($pageUrl));
            }
        }


        return [
            'duplicates' => $duplicates,
            'new' => $newAdCounter,
            'duplicateCounter' => $duplicateCounter,
            'time' =>  $startTime->diffInSeconds()
        ];
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
        return [
            'duplicates' => $duplicates, //test
            'new' => $newAdCounter,
            'duplicateCounter' => $duplicateCounter,
            'time' =>  $startTime->diffInSeconds()
        ];
    }


    public static function parseAuto24(){

        set_time_limit(0);
        $startTime = Carbon::now();
        $delay = 5;
        $numberOfPages = 1;
        $newAdCounter = 0;
        $duplicateCounter = 0;

        $base = 'http://rus.auto24.lv/lietoti/';
        $crawler = new Crawler(file_get_contents($base));

        $auto = $crawler->filter('div.field #searchParam-cmm-1-make option')->extract(array('_text'));
        dd($auto);

        $ss = Category::all('name')->toArray();




//        foreach ($lat as $latn) {
//            foreach ($ss as $ssn) {
//                if($ssn['name'] == $latn['0']){
//                    $categories[] = [
//                        'name' => $latn['0'],
//                        'value' => $latn['1'],
//                        'id' => $ssn['id']
//                    ];
//                    break;
//                }
//            }
//        }
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
        return [
            'duplicates' => $duplicates, //test
            'new' => $newAdCounter,
            'duplicateCounter' => $duplicateCounter,
            'time' =>  $startTime->diffInSeconds()
        ];
    }
}
