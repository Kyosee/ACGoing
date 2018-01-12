<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\SpiderSite;
use App\Libraries\MultithreadingSpider;

class SpiderRequest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'spider-request';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $SpiderSite = new SpiderSite();

        $site_list = $SpiderSite->rebuildData($SpiderSite->get()->toArray());
        $Spider = new MultithreadingSpider($site_list);
        var_dump($Spider->startSpider());

    }
}
