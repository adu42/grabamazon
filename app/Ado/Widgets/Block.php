<?php

namespace App\Ado\Widgets;

use Arrilot\Widgets\AbstractWidget;
use App\Ado\Models\Tables\Cms\Block as AsBlock;
use Context;

class Block extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];//'identifier'=>''

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $title = func_num_args()?func_get_arg(0):false;
        $identifier=0;
        if(count($this->config)>=1)$identifier=array_shift($this->config);
        if(count($this->config)>=1)$this->config['showTitle']=array_shift($this->config);
        if(!empty($title))$this->config['showTitle']=$title;

        //
        $block=null;
        if($identifier)
        $block = AsBlock::where('identifier',$identifier)->first();
        if(isset($this->config['showTitle']) && $this->config['showTitle'] && strlen($this->config['showTitle'])<5 && $block)$this->config['showTitle']=$block->title;

        return view("widgets.block", [
            'config' => $this->config,
            'block'=>$block,
        ]);
    }
}