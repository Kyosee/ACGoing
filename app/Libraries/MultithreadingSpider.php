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

    /**
     * 开始执行采集
     * @todo 未完成文章详情内容采集
     * @return array [description]
     */
    public function startSpider(){
        $client = new Client();

        // 创建异步请求对象
        $requests = function() use ($client){
            foreach ($this->site as $key => $value) {
                $uri = $value['site_url'];
                yield function() use ($client, $uri){
                    return $client->getAsync($uri);
                };
            }
        };

        // 创建请求池
        $pool = new Pool($client, $requests(),[
            'concurrency' => count($this->site),
            'fulfilled'   => function ($response, $index){
                $res = (string)$response->getBody();
                $Crawler = new Crawler($res);
                $this->index = $index;

                // 执行基础过滤匹配采集
                $Crawler->filter($this->site[$this->index]['base_filter']['start_filter'])->each(function($node) use ($Crawler){
                    $client = new Client();
                    $news = [];
                    unset($this->site[$this->index]['base_filter']['start_filter']);

                    //遍历过滤规则对返回的响应内容进行过滤
                    foreach ($this->site[$this->index]['base_filter'] as $key => $value) {
                        $node_info = $node->filter($value);
                        if($node_info->count() && $value){
                            $news[$key] = trim($node_info->text());

                            // 判定是否采集到文章信息及相应URL，若需要采集文章内容信息则执行内容采集
                            // if($key == 'title' && $news['url'] = $node_info->attr('href'))
                            //     $child = new Crawler((string)$client->request('GET', $news['url'])->getBody());
                            //     var_dump($child->filter('.property > .name > a')->html());
                            //     exit;
                        }
                    }

                    if($news){
                        $this->news_list[$this->site[$this->index]['id']]['news'][] = $news;
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
