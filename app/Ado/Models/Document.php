<?php
/**
 * Email: 114458573@qq.com .
 * User: 杜兵
 * Date: 15-7-13
 * Time: 上午5:33
 */

namespace App\Ado\Models;
use Illuminate\Container\Container;
use Collective\Html\HtmlFacade as HTML;
use Illuminate\Support\Facades\Input;
use Route;

class Document {
    protected $container;
    protected $js         = array();
    protected $css        = array();
    protected $scripts    = array();
    protected $styles     = array();

    public $title='';
    public $keywords='';
    public $description='';
    public $rss;
    public $favicon_file='/assets/images/favicon.ico';
    public $charset='utf-8';
    public $link_rel=array();
    public $propertyMeta=array();
    public $nameMeta=array();
    public $conversion_code=array();

    public $values = array();



    /**
     * Bind a Container to Rapyd
     *
     * @param Container $container
     */
    public function setContainer(Container $container)
    {

        static::$container = $container;
    }

    /**
     * Get the Container from Rapyd
     *
     * @param  string    $service
     * @return Container
     */
    public function getContainer($service = null)
    {

        if ($service) {
            return static::$container->make($service);
        }

        return static::$container;
    }

    //获得所有头输出
    public function getHead(){
        $html='';
        $html.= "\r\n".$this->getCharset();
        $html.="\r\n".$this->getTitle();
        $html.="\r\n".$this->getKeywords();
        $html.="\r\n".$this->getDescription();
        $html.="\r\n".$this->getNameMeta();
        $html.="\r\n".$this->getPropertyMeta();
        $html.="\r\n".$this->getFaviconFile();
        $html.="\r\n".$this->head();
        $html.="\r\n".$this->getRss();
        return $html;
    }

    //头输出
    public function head()
    {
        $buffer = "\n";

        //css links
        foreach ($this->css as $item) {
            $buffer .= HTML::style($item);
        }
        //js links
        foreach ($this->js as $item) {
            $buffer .= HTML::script($item);
        }

        //inline styles & scripts
        if (count($this->styles)) {
            $buffer .= sprintf("<style type=\"text/css\">\n%s\n</style>", implode("\n", $this->styles));
        }
        if (count($this->scripts)) {
            $buffer .= sprintf("\n<script language=\"javascript\" type=\"text/javascript\">\n\$(document).ready(function () {\n\n %s \n\n});\n</script>\n", implode("\n", $this->scripts));
        }

        return $buffer;
    }

    //获得脚本
    public function scripts()
    {
        $buffer = "\n";

        //js links
        foreach ($this->js as $item) {
            $buffer .= HTML::script($item);
        }

        //inline scripts
        if (count($this->scripts)) {
            $buffer .= sprintf("\n<script language=\"javascript\" type=\"text/javascript\">\n\$(document).ready(function () {\n\n %s \n\n});\n\n</script>\n", implode("\n", $this->scripts));
        }

        return $buffer;
    }

    //获得样式
    public function styles()
    {
        $buffer = "\n";

        //css links
        foreach ($this->css as $item) {
            $buffer .= HTML::style($item);
        }

        //inline styles
        if (count($this->styles)) {
            $buffer .= sprintf("<style type=\"text/css\">\n%s\n</style>", implode("\n", $this->styles));
        }

        return $buffer;
    }

    //添加js文件
    public function js($js)
    {
        if (!in_array('assets/'.$js, $this->js))
            $this->js[] = 'assets/'.$js;
    }

    //添加样式文件
    public function css($css)
    {
        if (!in_array('assets/'.$css, $this->css))
            $this->css[] = 'assets/'.$css;
    }

    //添加脚本
    public function script($script)
    {
        $this->scripts[] = $script;
    }

    //添加样式
    public function style($style)
    {
        $this->styles[] = $style;
    }

    //删除脚本
    public function pop_script()
    {
        return array_pop($this->scripts);
    }

    //删除样式
    public function pop_style()
    {
        return array_pop($this->styles);
    }

    //meta 格式化
    protected function metaFormat($type,$content){
       return  '<meta name="'.$type.'" content="'.$content.'" />';
    }

    //meta标题
    public function getTitle(){
        $title =  htmlspecialchars(html_entity_decode(trim($this->title)), ENT_QUOTES, 'UTF-8');
        return '<title>'.$title.'</title>';
    }

    //meta关键词
    public function getKeywords(){
        $keywords = htmlspecialchars(html_entity_decode(trim($this->keywords)), ENT_QUOTES, 'UTF-8');
        return $this->metaFormat('keywords',$keywords);
    }

    //meta描述
    public function getDescription(){
        $description = htmlspecialchars(html_entity_decode(trim($this->description)), ENT_QUOTES, 'UTF-8');
        return $this->metaFormat('description',$description);
    }

    //meta标题
    public function setTitle($value,$default = null){
        $this->title = empty($value)?$default:$value;
        return $this;
    }

    //meta关键词
    public function setKeywords($value,$default = null){
        $this->keywords = empty($value)?$default:$value;
        return $this;
    }

    //meta描述
    public function setDescription($value,$default = null){
        $this->description = empty($value)?$default:$value;
        return $this;
    }

    //Rss
    public function getRss($params=''){
        if($this->css){
          return  sprintf('<link href="%s"%s rel="alternate" type="application/rss+xml" />',
                $this->css, $params
            );
        }
       return '';
    }

    //图标icon
    public function getFaviconFile(){
        $favicon_file = '';
        if($this->favicon_file){
            $favicon_file = '<link rel="icon" href="'.$this->favicon_file.'" type="image/x-icon" />';
            $favicon_file .= '<link rel="shortcut icon" href="'.$this->favicon_file.'" type="image/x-icon" />';
        }
        return $favicon_file;
    }

    //编码
    public function getCharset(){
       return  '<meta charset="'.$this->charset.'" /><meta http-equiv="Content-Type" content="text/html; charset='.$this->charset.'" />';
    }

    // property Meta
    public function getPropertyMeta(){
        $html = '';
        if(!empty($this->propertyMeta)){
            foreach($this->propertyMeta as $type => $meta){
                $html .= '<meta property="'.$type.'" content="'.$meta.'" />';
            }
        }
        return $html;
    }

    //name Meta
    public function getNameMeta(){
        $html = '';
        if(!empty($this->nameMeta)){
            foreach($this->nameMeta as $type => $meta){
                $html .= '<meta name="'.$type.'" content="'.$meta.'" />';
            }
        }
        return $html;
    }

    //统计代码
    public function getConversionCode($position=''){
        if(!empty($this->conversion_code)){
            if(empty($position)){
                return implode("\n",$this->conversion_code);
            }else if(isset($this->conversion_code[$position])){
                return $this->conversion_code[$position];
            }
        }
        return '';
    }

    /** 以下是构造器,set  get 属性 **/
    public function setter($key, $value)
    {
       // $key = str_replace('_', '-', $key);
        if (isset($this->values[$key])) $this->values[$key]['value'] = $value;
        return $this;
    }

    public function getter($key)
    {
       // $key = str_replace('_', '-', $key);
        return isset($this->values[$key]) && isset($this->values[$key]['value']) ? $this->values[$key]['value'] : null;
    }

    public function __call($method, $parameters)
    {
        switch (substr(snake_case($method), 0, 3))
        {
            case 'get': return $this->getter(substr(snake_case($method), 3)); break;
            case 'set': return $this->setter(substr(snake_case($method), 3), isset($parameters[0]) ? $parameters[0] : null); break;
            default: throw new \Exception('Method "' . $method . '" not found'); break;
        }
    }

}