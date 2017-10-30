<?php

namespace App\Ado\Models\Tables\Evaluate;

use Illuminate\Database\Eloquent\Model;

class EvaluateTip extends Model
{
    protected $table = 'evaluate_tips';
    public $timestamps=false;
    protected $fillable = array('tip_id');

    public function tip(){
        return $this->hasOne('App\Ado\Models\Tables\Evaluate\EvaluateGroupTip','id','tip_id');
    }

}
