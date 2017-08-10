<?php

namespace App\Libraries;

use Illuminate\Http\Request;
use Goutte\Client;
use GuzzleHttp\Client as GuzzleClient;

class NewsSpider {


    protected $url;

    protected $crawler;

    protected $start_filter;

    protected $filter = ['title', 'description', 'author', 'post_date', 'content'];

    public function __construct(Client $client, $url, $start_filter, $filter){
        $this->url = $url;
        $this->filter = $filter;
        $this->client = $client;
        $this->start_filter = $start_filter;
        $this->crawler = $client->request('GET', $url);
    }

    public function getSpider(){
        $news_list = [];
        $client = new Client();
        $crawler = $client->request('GET', 'http://www.freebuf.com/');


        $crawler->filter($this->start_filter)->each(function($node) use ($client){
            // $news['url'] = $node->attr('href');
            var_dump($node->text());
            return $node->text();
            foreach ($this->filter as $key => $value) {
                $news[$key] = trim($node->filter($value)->text());
            }

            $news_list[] = $news;
        });

        return $news_list;
    }

    public function spider() {
        $client = new Client();
        $crawler = $client->request('GET', 'http://www.freebuf.com/');

        $crawler->filter('.news-info ')->each(function($node) use ($client) {
            $href = $node->filter('dl >dt a');
            $text = $node->filter('.text');
            var_dump(trim($href->text()));
            var_dump(trim($text->text()));
            // $href = $node->attr('href');
            // $this->info("Scraped: " . $href);
            // $crawler = $client->request('GET', $href);
            // $chapter = $crawler->filter('.col-md-8 .chapter, .col-md-8 .appendix')->html();
            // file_put_contents(base_path('resources/docs/').$href, $chapter);
        });
    }
}
