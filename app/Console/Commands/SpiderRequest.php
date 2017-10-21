<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\SpiderSiteModel;
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
        $SpiderSiteModel = new SpiderSiteModel();

        $site_list = $SpiderSiteModel->rebuildData($SpiderSiteModel->get()->toArray());
        $Spider = new MultithreadingSpider($site_list);
        var_dump($Spider->startSpider());

    }
}
