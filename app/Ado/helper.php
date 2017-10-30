<?php
/**
 * Email: 114458573@qq.com .
 * User: 杜兵
 * Date: 15-7-16
 * Time: 上午5:18
 */

use App\Models\Helpers\ImageHelper;

if ( ! function_exists('image_link_to'))
{
    /**
     * Generate a HTML link to a controller action.
     *
     * @param  string  $action
     * @param  string  $title
     * @param  array   $parameters
     * @param  array   $attributes
     * @return string
     */
    function image_link_to($url, $title = null, $attributes = array(), $secure = null)
    {
        if($title){
            $title_as = '####';
            $link =  app('html')->link($url, $title_as, $attributes, $secure);
            $link = str_replace($title_as,$title,$link);
        }else{
            $link =  app('html')->link($url, $title, $attributes, $secure);
        }
        return $link;
    }
}

if ( ! function_exists('article_image'))
{
    /**
     * Generate a HTML link to a controller action.
     *
     * @param  string  $action
     * @param  string  $title
     * @param  array   $parameters
     * @param  array   $attributes
     * @return string
     */
    function article_image($article,$size='x520390', $attributes = array('class'=>'img-responsive'), $secure = null)
    {
        if(!$article)return '';
        //if(!$article->image)return '';
        $title = image_to($article->image,$size,$article->title,$attributes,$secure);
        $link = image_link_to(route('article.show',['uri'=>$article->url_key]),$title,array(),$secure);
        return $link;
    }
}

if ( ! function_exists('evaluate_image'))
{
    /**
     * Generate a HTML link to a controller action.
     *
     * @param  string  $action
     * @param  string  $title
     * @param  array   $parameters
     * @param  array   $attributes
     * @return string
     */
    function evaluate_image($evaluate,$size='x400300', $attributes = array('class'=>'img-responsive'), $secure = null)
    {
        if(!$evaluate)return '';
        $title = image_to($evaluate->screen,$size,$evaluate->brand,$attributes,$secure);
        $link = image_link_to(route('review.domain',['domain'=>$evaluate->domain]),$title,array(),$secure);
        return $link;
    }
}

if ( ! function_exists('image_to'))
{
    /**
     * Generate a HTML link to a controller action.
     *
     * @param  string  $action
     * @param  string  $title
     * @param  array   $parameters
     * @param  array   $attributes
     * @return string
     */
    function image_to($filename,$size=null, $alt = null, $attributes = array(), $secure = null)
    {
        $img =  image_resize($filename,$size);
        return  app('html')->image($img['client_path'], $alt, $attributes, $secure);
    }
}

if ( ! function_exists('avatar_to'))
{
    /**
     * Generate a HTML link to a controller action.
     *
     * @param  string  $action
     * @param  string  $title
     * @param  array   $parameters
     * @param  array   $attributes
     * @return string
     */
    function avatar_to($filename,$size=null, $alt = null, $attributes = array(), $secure = null)
    {
        $size = get_image_size($size);
        $_attributes = ['width'=>$size['width'],'height'=>$size['height']];
        $attributes = array_merge($attributes,$_attributes);
        return  app('html')->image($filename, $alt, $attributes, $secure);
    }
}

if ( ! function_exists('avatar')) {
    function avatar($user,$size='x80',$attributes=[])
    {
        if(empty($attributes))$attributes=['class' => 'img-thumbnail'];
        if(!$user || !$user->avatar){
            $avatar='200x200-o14.jpg';
        }else{
            $avatar =$user->avatar;
        }
        return avatar_to(config('gravatar.path') .$avatar, $size, null, $attributes);
    }
}
if ( ! function_exists('get_image_size'))
{
    function get_image_size($size){
        if($size){
        $sizes = config('image.images_size');
        $_sizes = array_keys($sizes);
        //文件尺码-装配文件存放路径；
        if(is_array($size)){
            $_size = 'x'.$size['width'].$size['height'];
        }else{
            $_sizeas = $size;
            $_size = explode('x',$size);
            $size = array();
            $size['width'] = substr($_size[0],0,3);
            $size['height'] = isset($_size[1])?$_size[1]:substr($_size[0],3,3);
            $_size = $_sizeas;
            unset($_sizeas);
        }
        //如果是固有大小，看配置里是不是有设置固定的目录，如果没有，就装配一个目录
        if(in_array($_size,$_sizes)){
            $size=$sizes[$_size];
            $sizePaths = config('image.image_web_path');
            $sizePath = $sizePaths[$_size];
        }else{
            $sizePath = config('image.image_resize_dir').DIRECTORY_SEPARATOR.$_size.DIRECTORY_SEPARATOR;
        }
            $size['path']=$sizePath;
        }
        return $size;
    }
}

if ( ! function_exists('image_resize'))
{
    /**
     * 从图片文件夹中找个文件缩放
     * @param $filename
     * @param null $size
     * return array(ok|false,server path,client path)
     */
    function image_resize($filename,$size=null,$upload = true)
    {
        if($upload){


            $fileInServer = config('image.upload_dir').DIRECTORY_SEPARATOR.$filename;
            /*
             $fileInServerAs = public_path().$filename;
            if(!File::exists($fileInServer) && File::exists($fileInServerAs)){
                $fileInServer=$fileInServerAs;
            }
            */
        }else{
            $fileInServer = $filename;
        }
        $servicePath = '';
        $clientPath = '';
        if(is_file($fileInServer)){
            $result =true;
            if($size && !file_exists($servicePath)){
                    $image = new ImageHelper();
                    $size = empty($size) ? config('image.default_size') : $size;
                    $image->resize($size, $fileInServer);
                $servicePath = $image->data['server_path'];
                $clientPath = $image->data['client_path'];
            }else{
                $servicePath = $fileInServer;
                $clientPath = config('image.upload_web_path').$filename;
            }
        }else{
            $fileInServerAs = public_path().$filename;
            if(File::exists($fileInServerAs)){
                $clientPath = $filename;
                $result = true;
            }else{
                $result = false;
                $clientPath = config('image.upload_web_path').'image-'.rand(1,6).'.jpg';
            }
        }
        return array('result'=>$result,'server_path'=>$servicePath,'client_path'=>$clientPath);
    }
}

if ( ! function_exists('time_ago'))
{
    function time_ago($datetime){
        $time = strtotime($datetime);
        $src =  $diff = (time() - $time);
        $diff_as = floor($diff/864000);
        if($diff_as>0)return '10天前';
        $i = 0;
        while($diff>1){
            $src = $diff;
            if($i>=2){  //两次之后
                $diff = floor($diff/24);
            }else{
                $diff = floor($diff/60);
            }
            $i++;
        }
        if($i==1)return $src.'秒前';
        if($i==2)return $src.'分钟前';
        if($i==3)return $src.'小时前';
        if($i==4)return $src.'天前';
        return '15天前';
    }
}


/**
 * 过滤恶意单词
 */
if ( ! function_exists('str_bad_word_filter'))
{
    function str_bad_word_filter($string,$replaceWith='*'){
        $badWords = config('bad-words');
        if(!empty($badWords)){
            foreach ($badWords as $word) {
                if (!strlen($word)) {
                    continue;
                }
                if ($replaceWith === '*') {
                    $fc = $word[0];
                    $lc = $word[strlen($word) - 1];
                    $len = strlen($word);
                    $newWord = $len > 3 ? $fc . str_repeat('*', $len - 2) . $lc : $fc . '**';
                } else {
                    $newWord = $replaceWith;
                }
                $string = str_ireplace($word, $newWord, $string);
            }
        }
        return $string;
    }
}

if ( ! function_exists('external_link_count')) {
    function external_link_count($text = '', $host = '')
    {
        if (empty($host)) $host = $_SERVER['HTTP_HOST'];
        $reg = '/http(?:s?):\/\/((?:[A-za-z0-9-]+\.)+[A-za-z]{2,4})/';
        preg_match_all($reg, $text, $data);
        $math = $data[1];
        $i=0;
        foreach ($math as $value) {
            if ($value != $host)$i++;
        }
        return $i;
    }
}

if ( ! function_exists('bad_word_count')) {
    function bad_word_count($text = '')
    {
        if (empty($text)) return 0;
        $reg = '/[A-Za-z]+(\*)+[A-Za-z]+/';
        preg_match_all($reg, $text, $data);
        $math = isset($data[1])?$data[1]:[];
        return count($math);
    }
}

if ( ! function_exists('route_urlencode')) {
    function route_urlencode($url = '')
    {
        $url = str_replace('://',':||',$url);
        $url = str_replace('/','||',$url);
        $url = urlencode($url);
        return $url;
    }
}


if ( ! function_exists('route_urldecode')) {
    function route_urldecode($url = '')
    {
        $url = urldecode($url);
        $url = str_replace(':||','://',$url);
        $url = str_replace('||','/',$url);
        return $url;
    }
}




