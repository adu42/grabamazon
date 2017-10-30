<?php

namespace App\Ado\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Requests;
use Input;
use View;
use Auth;
use DataForm;
use DataEdit;
use Config;
use Redirect;
use Session;
use DB;
use Context;
use Zofe\Rapyd\Helpers\HTML as HtmlHelper;
use App\Ado\Models\Tables\Talk\Talk;
use App\Ado\Models\Tables\Talk\TalkShow;
use App\Ado\Repositories\TalkHelper;


class TalkController extends BaseController
{
    /**
     * 
     * @param $share
     * @return mixed
     */
    public function index(){
        return 'index';
    }

    public function edit($share){
        $have = 0;
        if(stripos($share,'http')===0){
            $content = @file_get_contents($share);
            @file_put_contents(public_path().'/html.html',$content);
            $have = 1;
        }
        return View::make(config('front.template').'talk_share',compact('share','have'));
    }


    protected $strHelper = null;

    /**
     * 展示的时候不审核文件内容，只有在保存之前才会去处理
     * @return mixed
     */
    public function share(){
        $media = $this->clean(Input::get('media'));
        $description = $this->clean(Input::get('description'),false);
        $url = $this->clean(Input::get('url'));
        $msg = '';
        $id='';
        if(empty($media)){
            $msg = trans('talk.no_media');
        }
        if(Input::has('save')){
            $saved =  $this->save($media,$description,$url);
            if($saved){
                $id = $saved;
                $msg = trans('talk.media_saved');
            }else{
                $msg = trans('talk.media_exist');
            }
        }
        return View::make(config('front.template').'talk_share',compact('media','description','url','msg','id'));
    }

    /**
     * 列表展示
     */
    public function talk_list(){
        $talks = []; //获得一个实体
        return View::make(config('front.template').'talk_list',compact('talks'));
    }

    /**
     * 单个展示
     * @return mixed
     */
    public function show($id){
        $id = $id?$id:Input::get('id');
        $talk = []; //获得一个实体
        return View::make(config('front.template').'talk_show',compact('talk'));
    }

    /**
     * 同文件不做多次保存
     * @param $media
     * @param $description
     * @param $url
     */
    protected function save($media,$description,$url){
        $session_key = md5($media);
        if(!Session::has($session_key)){
            // todo save
            /***************/
            Session::set($session_key,1);
            return 1;
        }
        return 1;
    }

    /**
     * xss clean
     * @param $str
     * @param bool $remove
     * @return string
     */
    protected function clean($str,$remove=true){
        if($this->strHelper===null){
            $this->strHelper = new HtmlHelper();
        }
        $str = trim($str);
        $strAs = $this->strHelper->xssfilter($str);
        if($strAs!=$str && $remove){
            $str='';
        }else{
            $str=$strAs;
        }
        return $str;
    }
}
