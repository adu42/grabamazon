<?php

namespace App\Ado\Widgets;

use Arrilot\Widgets\AbstractWidget;
use App\Ado\Models\Tables\Cms\Article;
use Context;
use Session;

class Articles extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     *
     * Treat this method as a controller action.
     * Return view() or other content to display.
     * num
     * num,filter,
     * num,catalogId
     * num,catalogid,filter
     */
    public function run()
    {
        $params = func_get_args();
        $filter = count($params)?array_shift($params):false;
        $title = count($params)?array_shift($params):false;
        $num = 10;
        if(count($this->config)>0)$num=array_shift($this->config);
        if(count($this->config)>0)$filter=array_shift($this->config);
        if(count($this->config)>=1)$this->config['showContent']=array_shift($this->config);
        if(!empty($title))$this->config['showTitle']=$title;


        //
        $articles = Article::enable()->share();
        if(empty($filter)){
            $catalog = Context::get('current_category');
            if($catalog){
                $filter = $catalog->id;
            }elseif(Session::has('current_catalog_id')){
                $filter = Session::get('current_catalog_id');
            }
        }

        if(!empty($filter)){
        if(is_numeric($filter)){
            $articles =  $articles->whereHas('categories',function($q) use ($filter){
                $q->where('id',$filter);
            });
        }elseif(is_array($filter)){
            $articles =  $articles->whereIn('id',$filter);
        }elseif(is_string($filter)){
            $articles =  $articles->where('title','like','%'.$filter.'%');
        }
        }
        $articles =  $articles->orderBy('updated_at','desc')->take($num)->get();

        $this->config['str_limit']=config('front.str_limit.articles');

        return view("widgets.articles", [
            'config' => $this->config,
            'articles'=>$articles
        ]);
    }
}