<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gregwar\Captcha\CaptchaBuilder;
use App\Libraries\NewsSpider;
use Goutte\Client;
use GuzzleHttp\Client as GuzzleClient;
use Session;

/**
 * Some tools
 */
class KitController extends Controller{
    /**
     * Show the captcha
     * @param string $tmp random string
     * @param string $captcha_name captcha session name
     * @param int $width picture width
     * @param int $height picture height
     *
     * @return Response
     */
    public function captcha($captcha_name = 'captcha', $width = 100, $height = 40) {
        $builder = new CaptchaBuilder;
        $builder->build($width, $height, $font = null);
        $phrase = $builder->getPhrase();

        Session::flash($captcha_name, $phrase);
        header("Cache-Control: no-cache, must-revalidate");
        header('Content-Type: image/png');
        $builder->output();
    }


    public function testSP(){
        $client = new Client();
        $filter['title'] = 'dl >dt a';
        $spider = new NewsSpider($client, 'http://geek.csdn.net/', '.news-info', $filter);
        $content = $spider->getSpider();
        var_dump($content);


        // $client = new Client();
        // $crawler = $client->request('GET', 'http://geek.csdn.net/');
        //
        // echo $crawler->filter('#geek_list  .geek_list')->text();
        //
        // $crawler->filter('#geek_list  .geek_list')->each(function($node) use ($client) {
        //     echo $node->text();
        //     // var_dump($node);
        //     $href = $node->filter('dd .tracking-ad  a');
        //     // $text = $node->filter('.text');
        //     var_dump(trim($href->text()));
        //     // var_dump(trim($text->text()));
        //     // $href = $node->attr('href');
        //     // $this->info("Scraped: " . $href);
        //     // $crawler = $client->request('GET', $href);
        //     // $chapter = $crawler->filter('.col-md-8 .chapter, .col-md-8 .appendix')->html();
        //     // file_put_contents(base_path('resources/docs/').$href, $chapter);
        // });
    }
}
