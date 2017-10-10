<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gregwar\Captcha\CaptchaBuilder;
use App\Libraries\NewsSpider;
use App\Libraries\MultithreadingSpider;
use Goutte\Client;
use GuzzleHttp\Client as GuzzleClient;
use Session;

use App\Models\SpiderSiteModel;
use App\Models\InformationModel;
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

        $SpiderSiteModel = new SpiderSiteModel();


        $site_list = $SpiderSiteModel->rebuildData($SpiderSiteModel->get()->toArray());
        $spider = new MultithreadingSpider($site_list);
        $content = $spider->startSpider();
        var_dump($content);
        $information = new InformationModel();
        var_dump($information->createInformation($content));
    }

    // public function testSP(){
    //     $client = new Client();
    //     $filter['title'] = '.news-list > .news-info > dl >dt > a';
    //     $filter['url'] = '.news-list > .news-info > dl >dt > a';
    //     $spider = new NewsSpider($client, 'http://www.freebuf.com/', '.article-wrap > .news-list', $filter);
    //     $content = $spider->getSpider();
    //     var_dump($content);
    // }

    // public function spider() {
    //     $client = new Client();
    //     $crawler = $client->request('GET', 'http://www.freebuf.com/');
    //
    //     $crawler->filter('.news-info ')->each(function($node) use ($client) {
    //         $href = $node->filter('dl >dt a');
    //         $text = $node->filter('.text');
    //         var_dump(trim($href->text()));
    //         var_dump(trim($text->text()));
    //         // $href = $node->attr('href');
    //         // $this->info("Scraped: " . $href);
    //         // $crawler = $client->request('GET', $href);
    //         // $chapter = $crawler->filter('.col-md-8 .chapter, .col-md-8 .appendix')->html();
    //         // file_put_contents(base_path('resources/docs/').$href, $chapter);
    //     });
    // }
}
