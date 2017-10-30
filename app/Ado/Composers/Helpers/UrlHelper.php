<?php
/**
 * Created by PhpStorm.
 * User: forldo
 * Date: 15-4-11
 * Time: 上午6:15
 *
 */

namespace App\Ado\Composers\Helpers;


class UrlHelper {

    public function getBaseUrl(){

    }

    public function getUrl($path = null, $parameters = array(), $secure = null){
        return url($path , $parameters , $secure );
    }
}