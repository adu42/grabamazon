<?php

namespace App\Ado\Models\Tables\Evaluate;

use Illuminate\Database\Eloquent\Model;

class ReviewTemp extends Model
{
    //
    protected $table='review_temps';
    protected $fillable = ['group_id','domain','title', 'review', 'enable','rating','service','value','shipping','returns','quality','used'];
    //
    public function evaluate_group(){
        return $this->hasOne('App\Ado\Models\Tables\Evaluate\EvaluateGroup','id','group_id');
    }

    public function scopeSearch($query, $value){
        if(!empty($value)){
            return $query->where('title','like','%'.$value.'%')->where('title','like','%'.$value.'%')->orWhere('domain','like','%'.$value.'%')
                ->orWhereHas('evaluate_group',function($q) use($value){
                    $q->where('group','like','%'.$value.'%');
                });
        }
        return $query;
    }
}
