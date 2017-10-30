<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-4-25
 * Time: 16:25
 */
namespace App\Ado\Repositories;
use App\Ado\Models\Tables\Talk\Talk;
use App\Ado\Models\Tables\Talk\TalkShow;
use App\Ado\Models\Tables\Talk\TalkComments;


class TalkHelper
{
    /**
     * 获取上一条下一条
     * @param $id
     * @param string $direct
     * @param int $limit
     * @return mixed
     */
    public function talk($talk,$direct='next',$limit=1){
        $talkId = 0;
        if(is_a($talk,'App\Ado\Models\Tables\Talk\Talk')){
            $talkId = $talk->id;
        }elseif(is_numeric($talk)){
            $talkId = $talk;
        }
        if($direct=='next'){
            $talks = Talk::where('id','>',$talkId)->take($limit)->get();
        }else{
            $talks = Talk::where('id','<',$talkId)->take($limit)->get();
        }
        return $talks;
    }

    /**
     * 下n个
     * @param $talk
     * @param int $limit
     * @return mixed
     */
    public function talkNext($talk,$limit=1){
        return $this->talk($talk,'next',$limit);
    }

    /**
     * 上n个
     * @param $talk
     * @param int $limit
     * @return mixed
     */
    public function talkPrex($talk,$limit=1){
        return $this->talk($talk,'prex',$limit);
    }

    public function talkShow($talkShow,$direct='next',$limit=1){
        $talkId = 0;
        if(is_a($talkShow,'App\Ado\Models\Tables\Talk\TalkShow')){
            $talkId = $talkShow->id;
        }elseif(is_numeric($talkShow)){
            $talkId = $talkShow;
        }
        if($direct=='next'){
            $talks = TalkShow::where('id','>',$talkId)->take($limit)->get();
        }else{
            $talks = TalkShow::where('id','<',$talkId)->take($limit)->get();
        }
        return $talks;
    }

    /**
     * 下n个
     * @param $talk
     * @param int $limit
     * @return mixed
     */
    public function talkShowNext($talkShow,$limit=1){
        return $this->talkShow($talkShow,'next',$limit);
    }

    /**
     * 上n个
     * @param $talk
     * @param int $limit
     * @return mixed
     */
    public function talkShowPrex($talkShow,$limit=1){
        return $this->talkShow($talkShow,'prex',$limit);
    }

    /**
     * 
     * @param $talkComments
     * @param string $direct
     * @param int $limit
     * @return mixed
     */
    public function TalkComments($talkComments,$direct='next',$limit=1){
        $talkId = 0;
        if(is_a($talkComments,'App\Ado\Models\Tables\Talk\TalkComments')){
            $talkId = $talkComments->id;
        }elseif(is_numeric($talkComments)){
            $talkId = $talkComments;
        }
        if($direct=='next'){
            $talks = TalkComments::where('id','>',$talkId)->take($limit)->get();
        }else{
            $talks = TalkComments::where('id','<',$talkId)->take($limit)->get();
        }
        return $talks;
    }
    /**
     * 下n个
     * @param $talk
     * @param int $limit
     * @return mixed
     */
    public function talkCommentsNext($talkComments,$limit=1){
        return $this->TalkComments($talkComments,'next',$limit);
    }
    /**
     * 上n个
     * @param $talk
     * @param int $limit
     * @return mixed
     */
    public function talkCommentsPrex($talkComments,$limit=1){
        return $this->TalkComments($talkComments,'prex',$limit);
    }

}