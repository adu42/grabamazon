<?php
/**
 * Created by PhpStorm.
 * User: 杜兵
 * Date: 2016/2/20
 * Time: 13:50
 */

namespace App\Ado\Models\Screen;


class GoogleSearch
{
    public function __construct()
    {
        //if ( @ini_set( 'max_execution_time', 120 ) !== FALSE )
       //     @ini_set( 'max_execution_time', 120 );
    }

    protected $apiUrl = 'http://ajax.googleapis.com/ajax/services/search/web';
    protected $params =[
        'v'=>'1.0',
        'q'=>'', // keyword
        'start'=>0,
        'rsz'=>'large',  // onepage
        'userip'=>'',  //ip
        'key'=>'', //key
        'cx'=>'', //account in google
    ];
    protected $_curl_enable = null;
    protected $uas =[
        0 	=> 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.0',
        1 	=> 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2228.0 Safari/537.36',
        2 	=> 'Mozilla/5.0 (compatible, MSIE 11, Windows NT 6.3; Trident/7.0;  rv:11.0) like Gecko',
    ];
    protected $currentUserAgent = null;
    protected $rows = [];
    protected $starts = null;
    protected $currentStart = 0;
    protected $startNum = 0;
    protected $maxStart = 5;
    protected $useproxie = false;
    protected $arrayproxies=[];
    protected $options=[];
    protected $message = '';


    /**
     * 入口执行
     * @param $keyword
     */
    public function runGrab($keyword){
         $url = $this->getApiRequestUrl($keyword,$this->currentStart);
        $data = $this->grabData($url);
        $this->getResult($data);
        if(!empty($this->starts)){
            foreach($this->starts as $page){
                $this->startNum++;
                if($this->startNum>$this->maxStart)break;
                $this->currentStart = $page->start;
                $this->runGrab($keyword);
            }
        }
    }

    /**
     * 外部获取执行结果
     * @return null
     */
    public function getRows(){
        return $this->rows;
    }

    public function getMessage(){
        return $this->message;
    }

    /***
     * 切换userAgent
     * @return null
     */
    protected function getUserAgent(){
        if($this->currentUserAgent===null){
            $n = rand(0,2);
            $this->currentUserAgent = $this->uas[$n];
        }
        return $this->currentUserAgent;
    }

    /**
     * 装配抓取的url，google的专用链接
     * @param $keyword
     * @param int $start
     * @param null $cx
     * @param null $key
     * @param null $ip
     * @return string
     */
    protected function getApiRequestUrl($keyword,$start=0,$cx=null,$key=null,$ip=null)
    {
        $this->params['q']=$keyword;
        $this->params['start']=$start;
        $this->params['cx']=$cx;
        $this->params['key']=$key;
        $this->params['userip']=$ip;
        $this->params = array_filter($this->params);
        $this->params['start']= isset($this->params['start'])?$this->params['start']:0;
        return sprintf("%s?%s", $this->apiUrl, http_build_query($this->params));
    }

    /**
     * 处理结果，好的存放进rows，坏的存放进message
     * @param $data
     */
    protected function getResult($data){
        if(!empty($data)){
            $json = json_decode($data);
            if($json){
            if(!empty($json->responseData)){
                if($json->responseData->results){
                    $rows =  $json->responseData->results;
                    $this->rows = array_merge($this->rows,$rows);
                }
                if($json->responseData->cursor && $json->responseData->cursor->pages && empty($this->starts)){
                    $this->starts = $json->responseData->cursor->pages;
                }
            }elseif(!empty($json->responseDetails)){
                $this->message .= 'responseStatus: '.$json->responseStatus.',responseDetails: '.$json->responseDetails;
            }
            }else{
                $this->message .= $data;
            }
        }
    }

    /**
     * 获取数据
     * @param $url
     * @return bool|null|void
     */
    protected function grabData($url){
        if($this->_isCurl()){
            return $this->_curl($url);
        }else{
            return $this->_getContent($url);
        }
    }

    /**
     * 判断是否有curl
     * @return bool|null
     */
    private function _isCurl() {
        if($this->_curl_enable===null)
            $this->_curl_enable = function_exists('curl_version');
        return $this->_curl_enable;
    }

    /**
     * file_get_contents 获取内容模式
     * @param $url
     */
    private function _getContent($url){
        if(!empty($this->options)){
            $context = stream_context_create($this->options);
            $data	= @file_get_contents( $url, false, $context );
        }else{
            $data	= @file_get_contents($url);
        }
        return $data;
    }

    /**
     * curl 获取模式
     * @param $url
     * @return array|mixed
     */
    private function _curl( $url) {
        try {
             $ch = curl_init($url);
            curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
            curl_setopt( $ch, CURLOPT_HEADER, false );
            curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, true );
            curl_setopt( $ch, CURLOPT_USERAGENT,$this->getUserAgent());
            curl_setopt( $ch, CURLOPT_AUTOREFERER, true );
            curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT, 20);
            curl_setopt( $ch, CURLOPT_TIMEOUT, 20 );
           curl_setopt( $ch, CURLOPT_MAXREDIRS, 10 );
            curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
          //  curl_setopt( $ch, CURLOPT_SSLVERSION, 3 );
            if($this->useproxie){
                if ( !empty( $this->arrayproxies ) ) {
                    foreach( $this->arrayproxies as $param => $val ) {
                        curl_setopt( $ch, $param, $val );
                    }
                }
            }

            $content = curl_exec( $ch );
            $errno = curl_errno( $ch );
            $error = curl_error( $ch );
            curl_close( $ch );
            if ( !$errno ) {
                return  $content;
            } else {
                return array( 'errno' => $errno, 'errmsg' => $error );
            }
        } catch ( Exception $e ) {
            return array( 'errno' => $e->getCode(), 'errmsg' => $e->getMessage());
        }
    }

    /**
     * 设置代理，可用可不用
     * @param $useproxie
     * @param $proxies
     */
    protected function setProxy($useproxie,$proxies){
        $start = rand(0,2);
        if ( $useproxie ) {
            $host = $proxies['host'];
            $port = $proxies['port'];
            $username	= $proxies["username"];
            $password = $proxies["password"];

            if ( !empty( $username ) ) {
                $auth = base64_encode( $username . ":" . $password );
                $useauth = "Proxy-Authorization: Basic $auth";
            } else {
                $useauth = "";
            }

            $options = array(
                "http" => array(
                    "method" => "GET",
                    "header" => "Accept-language: en\r\n" .
                        "Cookie: SEO Zen\r\n" .
                        "User-Agent: " . $this->uas[ $start ] . "\r\n".
                        $useauth,
                    "proxy" => "tcp://" . $host . ":" . $port,
                    "request_fulluri" => true
                )
            );
        } else {
            $options = array(
                "http" => array(
                    "method" => "GET",
                    "header" => "Accept-language: en\r\n" .
                        "Cookie: SEO Zen\r\n" .
                        "User-Agent: " . $this->uas[ $start ] )
            );
        }

        if ( $useproxie ) {
            if ( !empty( $username ) ) {
                $auth = base64_encode( $username . ":" . $password );

                $arrayproxies	= array(
                    CURLOPT_PROXY => $host,
                    CURLOPT_PROXYPORT	=> $port,
                    CURLOPT_PROXYUSERPWD => $auth
                );
            }	else {
                $arrayproxies	= array(
                    CURLOPT_PROXY => $host,
                    CURLOPT_PROXYPORT	=> $port
                );
            }
        }	else {
            $arrayproxies	= array();
        }
        $this->useproxie =$useproxie;
        $this->arrayproxies = $arrayproxies;
        $this->options = $options;
    }


}