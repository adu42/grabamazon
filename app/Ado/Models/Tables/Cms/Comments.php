<?php namespace App\Ado\Models\Tables\Cms;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model {
    protected $table = 'comments';
    protected $fillable = ['comment', 'user_id', 'article_id','is_active'];
    protected $quotes = [];

    protected $casts = [
        'quote_user_id' => 'integer',
    ];

    //有一个文章
    public function article(){
        return  $this->hasOne('App\Ado\Models\Tables\Cms\Article','id','article_id');
    }
    //有一个发稿人
    public function user(){
      return  $this->hasOne('App\Ado\Models\Tables\User\User','id','user_id');
    }
    //一个引用人，回复谁
    public function quote_user(){
        return  $this->hasOne('App\Ado\Models\Tables\User\User','id','quote_user_id');
    }

    public function quote(){
        return  $this->hasOne('App\Ado\Models\Tables\Cms\Comments','id','quote_id');
    }

    /**
     * 获得所有引用
     * @return array
     */
    public function getQuotes(){
        $this->quotes($this);
         krsort($this->quotes);
        return $this->quotes;
    }

    protected function quotes($quote){
        if($quote->quote){
            $this->quotes[]=$quote->quote;
            $this->quotes($quote->quote);
        }
    }

    public function save(array $options=[]){
        if(!$this->quote_user_id)$this->quote_user_id=0;
        parent::save($options);
    }
}
