<?php

use Illuminate\Foundation\Inspiring;
use TesseractOCR as Tesseract;
use App\Models\Amazons\AmazonGrab;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->describe('Display an inspiring quote');

Artisan::command('test', function () {
    $amazonGrab = new AmazonGrab();

    $path = 'storage/app/img.jpg';
    $a = (new Tesseract($path))->psm(6)->run();
    echo $a.'==';
});


