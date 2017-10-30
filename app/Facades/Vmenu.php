<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/2/4
 * Time: 17:55
 * string view render
 */

namespace App\Facades;
use Lavary\Menu\Facade;

class Vmenu extends Facade
{
    protected static function getFacadeAccessor() { return 'Vmenu'; }
}