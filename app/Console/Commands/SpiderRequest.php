<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\SiteModel;
use App\Libraries\MultithreadingSpider;

class SpiderRequest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:spider-request';

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
        $SiteModel = new SiteModel();


        $site_list = $SiteModel->rebuildData($SiteModel->get());
        $Spider = new MultithreadingSpider($site_list);

        var_dump($Spider->startSpider());

    }
}
