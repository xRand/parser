<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Symfony\Component\DomCrawler\Crawler;

class HomeController extends Controller
{


    public function index(){



        return view('index');
    }


    public function parseSS() {
        //$html2 = <<<'HTML'
//<!DOCTYPE html>
//<html>
//    <body>
//        <p class="message">Hello World!</p>
//        <p>Hello Crawler!</p>
//    </body>
//</html>
//HTML;

        $base = 'https://www.ss.lv';
        $startPoint = $base . '/' . 'ru/transport/cars/';
        $crawler = new Crawler(file_get_contents($startPoint));

        $auto = $crawler->filter('h4.category')->extract(array('_text'));
        $links = $crawler->filter('h4.category a')->extract(array('href'));

//        $commaList = implode(', ', $auto);
//        dd($commaList);


//        if($crawler->filter('.msg2')->count() == 0){
//            $category = $crawler
//                ->filter('h4.category')
//                ->each(function (Crawler $nodeCrawler)   {
//
//                    return [
//                        'title' => $nodeCrawler->filter('a')->text(),
//                        'url' => $nodeCrawler->filter('a')->link()->getUri(),
//                    ];
//                });
//        }


        $html2 = 'https://www.ss.lv/ru/transport/cars/audi/all/';
        $crawler->clear();
        $crawler->add(file_get_contents($html2));


        $categories = array('audi', 'bmw', 'ford');

        $all = [];

        foreach ($categories as $category) {

            print_r($category);


            $categoryUrl = 'https://www.ss.lv/ru/transport/cars/' . $category . '/all/';
            $crawler->clear();
            $crawler->add(file_get_contents($categoryUrl));


            //stranici (max 9)
            $pages = $crawler->filter('div.td2 a.navi')->extract(array('href'));
            $numberOfPages = 2;

            $ads = [];

            $i = 1;
            do {
                $adInfo = $crawler
                    ->filter('[id^=tr_3]')
                    ->each(function (Crawler $nodeCrawler) {
                        //    use ($title)

                        return [
                            'url' => $nodeCrawler->filter('.msga2 a')->link()->getUri(),
                            'img' => $nodeCrawler->filter('.msga2 img')->attr('src'),
                            'description' => str_replace(array("\n", "\r", "  "), '', $nodeCrawler->filter('.msg2 .d1 a')->text()),
                            'model' => $nodeCrawler->filter('.pp6')->text(),
                            'year' => $nodeCrawler->filter('.pp6 + .pp6')->text(),
                            'capacity' => $nodeCrawler->filter('.pp6 + .pp6 + .pp6')->text(),
                            'mileage' => $nodeCrawler->filter('.pp6 + .pp6 + .pp6 + .pp6')->text(),
                            'price' => $nodeCrawler->filter('.pp6 + .pp6 + .pp6 + .pp6 + .pp6')->text(),
                        ];

                    });

                $ads = array_merge($ads, $adInfo);

                if (empty($pages)) break;

                $pageUrl = 'https://www.ss.lv' . $pages[$i];
                $crawler->clear();
                $crawler->add(file_get_contents($pageUrl));

                $i++;
            } while ($i <= $numberOfPages);


            $all[$category] = $ads;
        }

        dd($all);

//            $category[$i] = array(
//                $node['url'] => $productsInfo
//            );


           // $productsInfo = 0;

      //  }


    //    dd($category);


//        $test = array_slice(array_combine($auto, $links), 0, 52);
//        foreach($test as $url) {
//            $html = file_get_contents('https://www.ss.lv'.$url);
//            $ads = $crawler->filter('tr#')->extract(array('_text'));
//
//        }
//        dd($test);





      //  $auto = array_slice($auto, 0, 52);
       // $links = array_slice($links, 0, 52);
       // $output = array_map(null, $auto, $links);
       // dd($output);

      //  $out = $productsInfo;
    }




}