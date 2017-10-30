<?php

namespace App\Ado\Widgets;

use Arrilot\Widgets\AbstractWidget;
use App\Ado\Models\Tables\Cms\Page as AsPage;

class Page extends AbstractWidget
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
        $params = func_get_args();
        $title = count($params)?array_shift($params):false;
        $showContent= count($params)?array_shift($params):false;
        $identifier=0;
        if(count($this->config)>=1)$identifier=array_shift($this->config);
        if(count($this->config)>=1)$title=array_shift($this->config);
        if(count($this->config)>=1)$this->config['showContent']=array_shift($this->config);
        if(!empty($title))$this->config['showTitle']=$title;
        if(!isset($this->config['showContent']))$this->config['showContent']=$showContent;
        //
        $page=null;
        if($identifier)
            $page = AsPage::where('url_key',$identifier)->first();
        if(isset($this->config['showTitle']) && $this->config['showTitle'] && strlen($this->config['showTitle'])<5 && $page)$this->config['showTitle']=$page->title;

        return view("widgets.page", [
            'config' => $this->config,
            'page'=>$page,
        ]);
    }
}