<?php
namespace App\Libraries;

use Symfony\Component\DomCrawler\Crawler;
use GuzzleHttp\Client;
use GuzzleHttp\Pool;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Exception\ClientException;

class MultithreadingSpider {
    protected $site;

    protected $index;

    protected $news_list;

    public function __construct($site){
        $this->site = $site;
    }

    public function startSpider(){
        $client = new Client();

        $requests = function() use ($client){
            foreach ($this->site as $key => $value) {
                $uri = $value['site_url'];
                yield function() use ($client, $uri){
                    return $client->getAsync($uri);
                };
            }
        };

        $pool = new Pool($client, $requests(),[
            'concurrency' => count($this->site),
            'fulfilled'   => function ($response, $index){
                $res = (string)$response->getBody();
                $Crawler = new Crawler($res);
                $this->index = $index;

                $Crawler->filter($this->site[$this->index]['base_filter']['start_filter'])->each(function($node) use ($Crawler){
                    $news = [];
                    unset($this->site[$this->index]['base_filter']['start_filter']);
                    foreach ($this->site[$this->index]['base_filter'] as $key => $value) {
                        $node_info = $node->filter($value);
                        if($node_info->count() && $value){
                            $news[$key] = trim($node_info->text());
                            if($key == 'title')
                                $news['url'] =  $node_info->attr('href');
                        }
                    }

                    if($news){
                        $this->news_list[$this->site[$this->index]['id']]['site'][] = $news;
                    }
                });
                $this->news_list[$this->site[$this->index]['id']]['site_type_id'] = $this->site[$this->index]['site_type_id'];
                $this->news_list[$this->site[$this->index]['id']]['site_id'] = $this->site[$this->index]['id'];
            },
            'rejected' => function ($reason, $index){
                return "rejected reason: " . $reason;
            },
        ]);

        $promise = $pool->promise();
        $promise->wait();

        return $this->news_list;
    }
}
