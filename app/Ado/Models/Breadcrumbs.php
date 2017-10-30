<?php
namespace App\Ado\Models;

class Breadcrumbs{
    /**
     * Array of breadcrumbs
     *
     * array(
     *  [$index] => array(
     *                  ['label']
     *                  ['title']
     *                  ['link']
     *                  ['first']
     *                  ['last']
     *              )
     * )
     *
     * @var array
     */
    protected $_crumbs = null;
    protected $_show = false;



    public function addCrumb($crumbName, $crumbInfo, $before= false)
    {
        $this->_prepareArray($crumbInfo, array('label', 'title', 'link', 'first', 'last', 'readonly'));
        if ((!isset($this->_crumbs[$crumbName])) || (!$this->_crumbs[$crumbName]['readonly'])) {
            if($before){
                array_unshift($this->_crumbs,$crumbInfo);
            }else{
                $this->_crumbs[$crumbName] = $crumbInfo;
            }
        }
        return $this;
    }

    protected function _prepareArray(&$arr, array $elements=array())
    {
        foreach ($elements as $element) {
            if (!isset($arr[$element])) {
                $arr[$element] = null;
            }
        }
        return $arr;
    }

    public function getCrumb()
    {
        if (is_array($this->_crumbs)) {
            $this->_prepareCrumb();
            reset($this->_crumbs);
            $this->_crumbs[key($this->_crumbs)]['first'] = true;
            end($this->_crumbs);
            $this->_crumbs[key($this->_crumbs)]['last'] = true;
        }
        return $this->_crumbs;
    }

    protected function _prepareCrumb()
    {
           $this->addCrumb('home', array(
            'label'=>trans('Home'),
            'title'=>trans('Go to Home Page'),
            'link'=>config('app.url'),
        ),true);
    }

    public function enable(){
        $this->_show=true;
        return $this;
    }

    public function disable(){
        $this->_show=false;
        return $this;
    }

    public function canShow(){
        return $this->_show;
    }

}


