<?php namespace App\Ado\Models\Tables\Core;

use Illuminate\Database\Eloquent\Model;

class SettingGroup extends Model {

	//
    protected $table = 'setting_groups';
    public $timestamps=false;
    protected $fillable = array('group', 'sort_order');

    public function settings(){
        return $this->hasMany('App\Ado\Models\Tables\Core\Setting','group_id','id');
    }

}
