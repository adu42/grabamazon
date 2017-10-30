<?php

namespace App\Ado\Widgets;

use Arrilot\Widgets\AbstractWidget;
use App\Ado\Models\Tables\Evaluate\Evaluate;
use Context;

class Piece extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        //
        $params = func_get_args();
        $title = count($params)?array_shift($params):false;


        $tips=null;
        $evaluate = Context::get('current_evaluate');
        $evaluates = null;
        if($evaluate)$evaluates= Evaluate::where('group_id',$evaluate->group_id)->enable()->take(10)->get();
        if(count($this->config)>=1)$this->config['showTitle']=array_shift($this->config);
        if(!empty($title))$this->config['showTitle']=$title;

        return view("widgets.piece", [
            'config' => $this->config,
            'evaluates'=>$evaluates
        ]);
    }
}