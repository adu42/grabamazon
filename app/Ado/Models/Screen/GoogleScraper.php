<?php
/**
 * Created by PhpStorm.
 * User: 杜兵
 * Date: 2016/3/18
 * Time: 11:25
 */

namespace App\Ado\Models\Screen;


class GoogleScraper
{
    protected $keyword	=	"testing";
    protected $urlList	=	"";


    protected function getpagedata($url)
    {
        if(function_exists('curl_version')){
            $ch=curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HEADER, 1);
            curl_setopt($ch, CURLOPT_TIMEOUT, 3);//设置curl执行时间不超过3秒
            curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
            $content=curl_exec($ch);
            curl_close($ch);
        }else{
            $content = file_get_contents($url);
        }
        return $content;
    }


    protected function fetchUrlList()
    {


        $url="http://www.google.co.uk/search?source=hp&biw=1440&bih=762&q=$this->keyword&aq=f&aqi=g10&aql=&oq=&cr=UK";
            $data=$this->getpagedata($url);
        dd($data);
            preg_match('/;ei=(.*?)&amp;start/', $data, $matches);
            $this->ei=urlencode($matches[1]);
            if ($data) {
                if(preg_match("/sorry.google.com/", $data)) {
                    echo "You are blocked";
                    exit;
                } else {
                    preg_match_all('@<h3\s*class="r">\s*<a[^<>]*href="[^<>]*?q=([^<>]*)&amp;sa[^<>]*>(.*)</a>\s*</h3>@siU', $data, $matches);
                    for ($j = 0; $j < count($matches[2]); $j++) {
                        $this->urlList[] = $matches[1][$j];
                    }
                }
            }
            else
            {
                echo "Problem fetching the data";
                exit;
            }

        }

    public function getUrlList($keyword,$proxy='') {
        $this->keyword=$keyword;
        $this->fetchUrlList();
        return $this->urlList;
    }
}