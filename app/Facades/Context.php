<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/1/30
 * Time: 16:36
 */
namespace App\Facades;
use Illuminate\Support\Facades\Facade;
class Context extends Facade {
    protected static function getFacadeAccessor() { return 'context'; }
}