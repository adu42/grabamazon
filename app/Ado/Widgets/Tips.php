<?php

namespace App\Ado\Widgets;

use Arrilot\Widgets\AbstractWidget;
use Context;

class Tips extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     *  {!! Widget::tips(['tips'=>$evaluate->tips]) !!}
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $params = func_get_args();
        $title = count($params)?array_shift($params):false;

        $tips=null;
        $evaluate = Context::get('current_evaluate');
        if($evaluate)$tips=$evaluate->tips;
        if(count($this->config)>=1)$title=array_shift($this->config);

        if(!empty($title))$this->config['showTitle']=$title;


        return view("widgets.tips", [
            'config' => $this->config,
            'tips'=>$tips,
        ]);
    }
}