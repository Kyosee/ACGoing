<?php

namespace App\Libraries;

use Illuminate\Http\Request;
use Goutte\Client;
use GuzzleHttp\Client as GuzzleClient;

class NewsSpider {


    protected $url;         //site url

    protected $crawler;     //spider object

    protected $start_filter;    //start content or list filter

    protected $news_list = [];  //return result

    protected $filter;          //attr filter

    public function __construct(Client $client, $url, $start_filter, $filter = ['url', 'title', 'description', 'author', 'post_date', 'content']){
        $this->url = $url;
        $this->filter = $filter;
        $this->client = $client;
        $this->start_filter = $start_filter;
        $this->crawler = $client->request('GET', $url);
    }

    public function getSpider(){
        $client = $this->client;

        $this->crawler->filter($this->start_filter)->each(function($node) use ($client){
            $news = [];
            foreach ($this->filter as $key => $value) {
                $node_info = $node->filter($value);
                if($node_info->count() && $value){
                    $news[$key] = $key == 'url' ? trim($node_info->attr('href')) : trim($node_info->text());
                }
            }

            if($news){
                $this->news_list[] = $news;
            }
        });

        return $this->news_list;
    }
}
