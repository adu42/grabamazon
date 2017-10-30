<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/2/4
 * Time: 17:55
 * string view render
 */

namespace App\Facades;
use Illuminate\Support\Facades\Facade;

class Strview extends Facade
{
    protected static function getFacadeAccessor() { return 'stringview'; }
}