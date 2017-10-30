<?php

namespace App\Ado\Models\Tables\Talk;

use Illuminate\Database\Eloquent\Model;

class TalkShow extends Model
{
    //
    protected $table = 'talk_show';

    public function talk(){
        return $this->hasOne('App\Ado\Models\Tables\Talk\Talk','id','talk_id');
    }
}
