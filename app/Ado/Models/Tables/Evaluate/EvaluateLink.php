<?php

namespace App\Ado\Models\Tables\Evaluate;

use Illuminate\Database\Eloquent\Model;

class EvaluateLink extends Model
{
    protected $table = 'evaluate_links';
    public $timestamps=false;
    protected $fillable = array('evaluate_id','label','link','refer','enable','user_id','hits');//enable 将我方审核

    /**
     * 属于谁的链接
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function evaluate(){
        return $this->hasOne('App\Ado\Models\Tables\Evaluate\Evaluate','id','evaluate_id');
    }

    public function user(){
        return $this->hasOne('App\Ado\Models\Tables\User\User','id','user_id');
    }

    public function scopeUser($query,$value){
        return $query->where('user_id',$value);
    }

    public function scopeSearch($query,$value){
        return $query->where('label','like','%'.$value.'%')->where('link','like','%'.$value.'%');
    }

    /**
     * 相关链接目前先只支持这几个
     * @param null $key
     * @return array
     */
    public static function refers($key=null){
        $refers = [
            1=>'google+',
            2=>'facebook',
            3=>'twitter',
            4=>'instagram',
            5=>'linkedin',
        ];
        if($key && isset($refers[$key]))return $refers[$key];
        if($key=='all')return $refers;
    }
}
