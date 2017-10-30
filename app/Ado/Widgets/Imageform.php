<?php

namespace App\Ado\Widgets;

use Arrilot\Widgets\AbstractWidget;

class Imageform extends AbstractWidget
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
        $nums = func_num_args()?func_get_arg(0):3;
        if(count($this->config)>=1)$nums=array_shift($this->config);
        return view("widgets.imageform", [
            'config' => $this->config,
            'nums'=>$nums,
        ]);
    }
}