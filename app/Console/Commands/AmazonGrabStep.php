<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Amazons\AmazonGrab;

class AmazonGrabStep extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'amazon:step {number}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '1=>\'Grab product links\', 2=>\'Grab product rank\', 3=>\'Grab categories links\'';

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
        $number = $this->argument('number');
        $this->info('Start.'.date('Y-m-d H:i:s'));
        if($number==1){
            $this->info('Grab product links from catalog.');
            $amazonGrab->grabCatalogProductLinks();
        }else if ($number==2){
            $this->info('Grab product rank.');
            $amazonGrab->grabProducts();
        }else if ($number==3){
            $this->info('Grab categories links.');
            $amazonGrab->grabCategories();
        }else if ($number==4){
            $this->info('reset focus.');
            $amazonGrab->resetFocus();
            $this->info('reset focus end.');
            $this->info('Grab product rank.');
            $amazonGrab->grabProducts();
        }else if($number=='test'){
            $this->info('Grab Testing.');
            $amazonGrab->testProduct([24213,24214,24215]);
        }
        $this->info('End.'.date('Y-m-d H:i:s'));

    }
}
