<?php

namespace App\Ado\Widgets;

use Arrilot\Widgets\AbstractWidget;
use Context;

class Links extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * {!! Widget::links() !!}   use Context
     * {!! Widget::links(['title'=>'Block Title']) !!}  use Context
     *  {!! Widget::links(['title'=>'Block Title','links'=>$evaluate->links]) !!}
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        //
        $params = func_get_args();
        $title = count($params)?array_shift($params):false;
        $links=null;
        $evaluate = Context::get('current_evaluate');
        if($evaluate)$links=$evaluate->links;
       // if(count($this->config)>=1)$links = array_shift($this->config);
        if(count($this->config)>=1)$title=array_shift($this->config);
        if(count($this->config)>=1)$links = array_shift($this->config);
        if(!empty($title))$this->config['showTitle']=$title;


        return view("widgets.links", [
            'config' => $this->config,
            'links'=>$links,
        ]);
    }
}