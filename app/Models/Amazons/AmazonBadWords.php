<?php

namespace App\Models\Amazons;

use Illuminate\Database\Eloquent\Model;
use Cache;

class AmazonBadWords extends Model
{
    protected $table = 'amazon_bad_words';
    public $timestamps=false;
    protected $fillable = ['word'];


    public function compareIn($string=''){
        $result = false;
        if(!empty($string)){
            $items =$userAgents = Cache::get('amazon_bad_words', function() {    return $this->all();});
            if($items->count()){
            foreach ($items as $item){
                if(stripos($string,$item->word)!==false){
                    $result = true;
                    break;
                }
            }}
        }
        return $result;
    }

    public function scopeSearch($query, $value){
        return $query->where('word','like','%'.$value.'%');
    }
}
