<?php
/**
 * Email: 114458573@qq.com .
 * User: 杜兵
 * Date: 15-7-18
 * Time: 上午9:30
 */

namespace App\Ado\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\Request;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use App\Ado\Models\Oauth\qq;
use Input;
use Redirect;
use Socialite;
use App\Ado\Controllers\Auth\SocialAccountService;


class OauthController extends Controller{
    //创建新票据实例
    public function __construct(Guard $auth, Registrar $registrar)
    {

        $this->auth = $auth;

        $this->registrar = $registrar;

        $this->middleware('guest', ['except' => 'getLogout']);

    }

    public function gg(){
        dd(Input::all());
    }


    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback(SocialAccountService $service, $provider)
    {

        $user = $service->createOrGetUser(Socialite::driver($provider));
        if($user)
        auth()->login($user);
        return redirect()->to('/');
    }


    public function redirectToProvider()
    {
        return Socialite::driver('github')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        $user = Socialite::driver('github')->user();
        dd($user);
        // $user->token;
    }

    //登录
    public function qq_login(qq $qq){
        return $qq->login();
    }

    //分享动态
    public function qq_share(qq $qq){
        $title=Input::get('title');
        $url=Input::get('url');
        $comment=Input::get('comment');
        $summary=Input::get('summary');
        $images=Input::get('images');
        return $qq->add_share($title,$url,$comment,$summary,$images);
    }

    //微博分享
    public function qq_weibo(qq $qq){
        $format=Input::get('format');
        $type=Input::get('type');
        $content=Input::get('content');
        $img=Input::get('img');
        return $qq->add_weibo($format,$type,$content,$img);
    }

    //对返回的数据进行处理
    public function qq_callback(qq $qq){
        $result =  $qq->callback();
        $winFresh =  '<script>function closeWin(){
                            var win = top.window;
                            try{
                                if(win.opener) win.opener.focus();
                                win.opener = null;
                            }catch(ex){
                            }finally{
                                win.close();
                            }
                        }
                        function refreshOpener(mhref){
                            var win = top.window;
                            try{
                                if(win.opener) win.opener.location.href=mhref;
                            }catch(ex){
                            }
                        }
                        function refreshOpenerAndCloseMe(mhref){
                            refreshOpener(mhref);
                            closeWin();
                        }
                    ';
        if($result){
            $winFresh .= 'refreshOpenerAndCloseMe("'.(url('/')).'")</script>';
        }else{
            $winFresh .= 'refreshOpenerAndCloseMe("'.(url('/auth/login')).'")</script>';
        }
        return $winFresh;
    }
}