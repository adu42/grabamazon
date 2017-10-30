<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Amazons\AmazonGrab;
class AmazonGrabStep1 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'amazon:step1';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Categories Links Grab Product';

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
    public function handle(AmazonGrab $amazonGrab)
    {
        $this->info('Start.'.date('Y-m-d H:i:s'));
        $amazonGrab->grabCatalogProductLinks();
        $this->info('End.'.date('Y-m-d H:i:s'));
    }
}
