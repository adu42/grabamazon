<?php
/**
 * Email: 114458573@qq.com .
 * User: 杜兵
 * Date: 15-7-18
 * Time: 上午8:56
 */

namespace App\Ado\Models\Oauth;
use Session;
use Input;
use App\Ado\Models\Tables\User\User;
use Hash;
use Auth;


class qq {
    protected $config = [];
    public function setConfig($config){
        $this->config = $config;
    }

    public function getConfig($key){
        if(empty($this->config)){
            $this->config = config('front.qq.connect');
        }
        if($key&& !empty($this->config) && isset($this->config[$key])){
            return $this->config[$key];
        }
        return '';
    }
    /**
     * //用户点击qq登录按钮调用此函数
     *    qq_login($_SESSION["appid"], $_SESSION["scope"], $_SESSION["callback"]);
     * @param $appid
     * @param $scope
     * @param $callback
     */
   public function login()
    {
        $appid = $this->getConfig('appid');
        $scope = $this->getConfig('scope');
        $callback = url($this->getConfig('callback'));
        Session::set('state',md5(uniqid(rand(), TRUE))); //CSRF protection
        $login_url = "https://graph.qq.com/oauth2.0/authorize?response_type=code&client_id="
            . $appid . "&redirect_uri=" . urlencode($callback)
            . "&state=" . Session::get('state')
            . "&scope=".$scope;
        header("Location:$login_url");
    }

    public function callback()
    {
         $appid = $this->getConfig('appid');
        $scope = $this->getConfig('scope');
        $appkey = $this->getConfig('appkey');
        $callback = url($this->getConfig('callback'));
        $code = Input::get('code');
        if(Input::get('state') == Session::get('state')) //csrf
        {
            $token_url = "https://graph.qq.com/oauth2.0/token?grant_type=authorization_code&"
                . "client_id=" .$appid. "&redirect_uri=" . urlencode($callback)
                . "&client_secret=" .$appkey. "&code=" . $code;

            $response = $this->post($token_url);

            if (strpos($response, "callback") !== false)
            {
                $lpos = strpos($response, "(");
                $rpos = strrpos($response, ")");
                $response  = substr($response, $lpos + 1, $rpos - $lpos -1);
                $msg = json_decode($response);

                if (isset($msg->error))
                {
                    echo "<h3>error:</h3>" . $msg->error;
                    echo "<h3>msg  :</h3>" . $msg->error_description;
                    exit;
                }
            }

            $params = array();
            parse_str($response, $params);

            //debug
            //print_r($params);

            //set access token to session
            Session::set('access_token',$params["access_token"]);

            $openid = $this->openid();
            if($openid)Session::set('openid',$openid);
            //$_SESSION["access_token"] = $params["access_token"];

           return $this->getUserInfo();

        }
        else
        {
            echo("The state does not match. You may be a victim of CSRF.");
        }
        return false;
    }


    public function getUserInfo(){
        $access_token = Session::get('access_token');
        $appid = $this->getConfig('appid');
        $openid = Session::get('openid');
        $token_url = "https://graph.qq.com/user/get_user_info?access_token=$access_token&oauth_consumer_key=$appid&openid=$openid";
        $response = $this->post($token_url);

        if (strpos($response, "callback") !== false)
        {
            $lpos = strpos($response, "(");
            $rpos = strrpos($response, ")");
            $response  = substr($response, $lpos + 1, $rpos - $lpos -1);
            $msg = json_decode($response);

            if (isset($msg->error))
            {
                echo "<h3>error:</h3>" . $msg->error;
                echo "<h3>msg  :</h3>" . $msg->error_description;
                exit;
            }
        }

        $params = json_decode($response);

        if(isset($params->nickname)){

            $email = $openid."@codebing.com";
            $passwd = Hash::make($email);
            $user = User::where('email',$email)->get();
            if($user->isEmpty()){
            $data['name']=$data['nickname']=$params->nickname;
            $data['gender']=$params->gender;
            $data['province']=$params->province;
            $data['city']=$params->city;
            $data['year']=$params->year;
            $data['avatar']=$params->figureurl_1;
            $data['email']=$email;
            $data['password']=$passwd;
            $data['is_active']=1;

             $user = User::firstOrCreate($data);
            }else{
                $user =   $user->first();
               // $user->password = $passwd;
               // $user->save();
            }

            $credentials = array(
                'password' => $user->email,
                'email' => $user->email,
            );
            return Auth::attempt($credentials);
        }
        return false;
    }

    /**
     *  发布一条动态的接口地址, 不要更改!!
     * @param $title
     * @param $url
     * @param $comment
     * @param $summary
     * @param $images
     * @return mixed
     */
    public function add_share($title,$url,$comment,$summary,$images)
    {
        //发布一条动态的接口地址, 不要更改!!
        $url = "https://graph.qq.com/share/add_share?"
            ."access_token=".Session::get("access_token")
            ."&oauth_consumer_key=".Session::get("appid")
            ."&openid=".Session::get("openid")
            ."&format=json"
            ."&title=".urlencode($title)
            ."&url=".urlencode($url)
            ."&comment=".urlencode($comment)
            ."&summary=".urlencode($summary)
            ."&images=".urlencode($images);
        return $this->post($url);
    }

    /**
     * @return mixed
     */
    public function add_weibo($format,$type,$content,$img)
    {
        //发表微博的接口地址, 不要更改!!
        $url  = "https://graph.qq.com/wb/add_weibo";
        $data = "access_token=".Session::get("access_token")
            ."&oauth_consumer_key=".Session::get("appid")
            ."&openid=".Session::get("openid")
            ."&format=".$format
            ."&type=".$type
            ."&content=".urlencode($content)
            ."&img=".urlencode($img);
        return $this->post($url, $data);
    }


    public function openid()
    {

        $graph_url = "https://graph.qq.com/oauth2.0/me?access_token="
            . Session::get('access_token');

        $str  = $this->post($graph_url);
        if (strpos($str, "callback") !== false)
        {
            $lpos = strpos($str, "(");
            $rpos = strrpos($str, ")");
            $str  = substr($str, $lpos + 1, $rpos - $lpos -1);
        }

        $user = json_decode($str);
        if (isset($user->error))
        {
            echo "<h3>error:</h3>" . $user->error;
            echo "<h3>msg  :</h3>" . $user->error_description;
            exit;
        }

        //debug
        //echo("Hello " . $user->openid);

        //set openid to session
        Session::set("openid", $user->openid);
    }



    public  function post($url, $data='')
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        if(!empty($data)){
            curl_setopt($ch, CURLOPT_POST, TRUE);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        }else{
            curl_setopt($ch, CURLOPT_POST, FALSE);
        }
        curl_setopt($ch, CURLOPT_URL, $url);
        $ret = curl_exec($ch);

        curl_close($ch);
        return $ret;
    }
}