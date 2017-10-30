<?php namespace App\Ado\Models\Tables\Cms;

use Illuminate\Database\Eloquent\Model;

class Article extends Model {

    protected $table = 'articles';

    protected $fillable = ['title', 'url_key', 'meta_keywords','meta_description','content_heading','content','writer','is_active','top','hit'];

    /**
     * 用户
     * */
    public function author(){
        return $this->hasOne('App\Ado\Models\Tables\User\User','id','author_id');
    }

    public function setUrlKeyAttribute($value){
        if($value){
            $value=str_slug($value);
        }else{
            if(isset($this->attributes['title']) && !empty($this->attributes['title'])){
                $value=str_slug($this->attributes['title']);
            }else{
                $value = str_random(4).date('YmdHis').'.html';
            }
        }
        $this->attributes['url_key']=$value;
    }

    public function categories(){
        return $this->belongsToMany('App\Ado\Models\Tables\Cms\Category');
    }

    public function comments(){
        return $this->hasMany('App\Ado\Models\Tables\Cms\Comments','article_id','id');
    }

    public function scopeSearch($query,$value){
        if(empty($value))return $query;
        return $query->where('title','like','%'.$value.'%')
            ->orWhereHas('author', function ($q) use ($value) {
                $q->whereRaw(" name like ?", array("%".$value."%"));
            })->orWhereHas('categories', function ($q) use ($value) {
                $q->where('name','like','%'.$value.'%');
            });
    }

    public function scopeCreateAt($query,$value){
        $time = strtotime($value);
       $date = date('Y-m-d H:i:s',$time);
       $query->where('created_at','>=',$date);
        return $query;
    }

    public function scopeCategory($query,$value){
        $value = (int)$value;
        if($value<=0)return $query;
        return $query->whereHas('categories',function($q) use ($value){
            $q->where('id',$value);
        });
    }

    /**
     * top 位置过滤
     * @param $query
     * @param $value
     * @param string $condition
     * @return mixed
     */
    public function scopeTop($query,$value,$condition='='){
        $value = (int)$value;
        if($condition=='='){
            return $query->where('top',$value);
        }else{
            return $query->where('top',$condition,$value)->orderBy('top','desc');
        }
    }

    /**
     *  enable 过滤
     * @param $query
     * @return mixed
     */
    public function scopeEnable($query){
        return $query->where('is_active',1);
    }

    /**
     *  share 过滤
     * @param $query
     * @return mixed
     */
    public function scopeShare($query){
        return $query->where('share',1);
    }


}
