<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Amazons\AmazonOkProduct;
use App\Models\Amazons\AmazonOkProductOption;
use App\Models\Amazons\AmazonOkProductOptionValue;
use App\Models\Amazons\AmazonOkProductOptionProv;
use App\Models\Amazons\AmazonGrab;

class AmazonController extends Controller
{
    //
    public function __construct()
    {

    }

    public function index(AmazonGrab $amazonGrab)
    {
        $amazonGrab->grabOKProductFromAmazon();
      /*
            $product = $amazonOkProduct->find(67);
            $product->options->each(function ($item){
                $item->values->each(function ($value){
                    print_r($value->toArray());
                });
            });
     */
        echo '<a href="'.route('admin.amazon.focustags').'">focustags Amazon</a><br/>';
        echo '<a href="'.route('admin.amazon.focustag.process').'">focustags Process</a><br/>';
    }
}
