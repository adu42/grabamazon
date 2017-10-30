<?php

namespace App\Ado\Widgets;

use Arrilot\Widgets\AbstractWidget;
use App\Ado\Models\Tables\Cms\Article;
use Context;
use Session;

class Carousel extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * {{ Widget::carousel($position,$column,$catalogId,$style) }}
     * 参数：
     * 1、 位置是置顶位，默认>0  有分类的时候用=固定位置
     * 2、 列数 - 列数决定条数 3 1
     * 3、 文章分类 < 0 时取当前访问的分类，=0 无分类，>0 取传递的这个参数当分类id
     * 4、 列表样式 （0 普通样式 1，隐藏圆点 2 图文混排
     * 按有图的取9篇文章，3x3 放在全栏目里
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $params = func_get_args();
        $column = ($params && count($params))?array_shift($params):3;
        $catalogId = ($params && count($params))?array_shift($params):0;
        $style = ($params && count($params))?array_shift($params):0;
        $row = 1;
        $perPage = 3;
        $position=0;
        if(count($this->config)>=1) $position=array_shift($this->config);
        $num = $column * $row * $perPage;

        $articles = null;

        if($catalogId<0){
            $catalog = Context::get('current_category');
            if($catalog){
                $catalogId= $catalog->id;
            }elseif(Session::has('current_catalog_id')){
                $catalogId= Session::get('current_catalog_id');
            }
        }
        if($catalogId>0){
            $articles = Article::enable()->top($position)->category($catalogId)->take($num)->get();
        }else{
            $articles = Article::enable()->top($position,'>')->take($num)->get();
        }


        $this->config['name']=str_random(4);
        $this->config['column']=$column;
        $this->config['row']=$row;
        $this->config['column-width']=$column?(int)(12/$column):4;
        $this->config['style']=$style;
        $this->config['str_limit']=config('front.str_limit.carousel');

        return view("widgets.carousel", [
            'config' => $this->config,
            'articles'=>$articles
        ]);
    }
}