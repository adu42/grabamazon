<?php

namespace App\Ado\Models\Tables\Evaluate;
use Illuminate\Database\Eloquent\Model;

class SearchLog extends Model
{
    protected $table='search_log';
    protected $fillable = ['id','keyword','times'];
    public $timestamps=false;

    /**
     * 如果本
     * @param array $options
     * @return bool
     */
    public function save(array $options = [])
    {
        $keyword = $this->attributes['keyword'];
        $model =  $this->where('keyword',$keyword)->first();
        if($model){
            $this->attributes['times']+=1;
        }
        return parent::save($options);
    }
}
