<?php

namespace App\Ado\Models\Tables\Evaluate;

use Illuminate\Database\Eloquent\Model;

class EvaluateGroupTip extends Model
{
    protected $table = 'evaluate_group_tips';
    public $timestamps=false;
    protected $fillable = array('group_id','tip','type','general');//'success','notice','warning'

    public function evaluate_group(){
        return $this->hasOne('App\Ado\Models\Tables\Evaluate\EvaluateGroup','id','group_id');
    }
    /**
     *
     * @param null $key
     * @return array|string
     */
    public static function types($key=null){
        $types = [
            1=>'success',
            2=>'notice',
            3=>'warning',
        ];
        if(is_numeric($key) && isset($types[$key])) return $types[$key];
        if($key=='all')return $types;
        return '';
    }




    public function scopeSearch($query, $value){
        if(!empty($value)){
            return $query->where('tip','like','%'.$value.'%')
                ->orWhereHas('evaluate_group',function($q) use($value){
                    $q->where('group','like','%'.$value.'%');
                });
        }
        return $query;
    }
}
