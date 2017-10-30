<?php
/**
 * Email: 114458573@qq.com .
 * User: 杜兵
 * Date: 15-7-6
 * Time: 上午11:51
 * linkNodes 转换成Node节点方式
 * toTree 转换成Tree方式
 *
 */

namespace App\Ado\Models\Constuct;
use \Illuminate\Database\Eloquent\Collection as BaseCollection;


class Collection extends  BaseCollection{
    /**
     * 整理转换成有父子节点的节点关系
     * Fill `parent` and `children` relationships for every node in collection.
     *
     * This will overwrite any previously set relations.
     *
     * @return $this
     */
    public function linkNodes()
    {
        if ($this->isEmpty()) return $this;
        $groupedNodes = $this->groupBy($this->first()->getParentIdName());
        /** @var NodeTrait|Model $node */
        foreach ($this->items as $node) {
            if ( ! $node->getParentId()) {
                $node->setRelation('parent', null);
            }
            $children = $groupedNodes->get($node->getKey(), [ ]);
            /** @var Model|NodeTrait $child */
            foreach ($children as $child) {
                $child->setRelation('parent', $node);
            }
            $node->setRelation('children', BaseCollection::make($children));
        }
        return $this;
    }

    /**
     * 转换成树状数组
     * Build tree from node list. Each item will have set children relation.
     *
     * To successfully build tree "id", "_lft" and "parent_id" keys must present.
     *
     * If `$rootNodeId` is provided, the tree will contain only descendants
     * of the node with such primary key value.
     *
     * @param int|Node|null $root
     *
     * @return Collection
     */
    public function toTree($root = null)
    {
        if ($this->isEmpty()) {
            return new static;
        }
        $this->linkNodes();
        $items = [ ];
        $root = $this->getRootNodeId($root);
        /** @var Model|NodeTrait $node */
        foreach ($this->items as $node) {
            if ($node->getParentId() == $root) {
                $items[] = $node;
            }
        }
        return new static($items);
    }

    /**
     * @param mixed $root
     *
     * @return int
     */
    protected function getRootNodeId($root = null)
    {

        if (NestedSet::isNode($root)) {
            return $root->getKey();
        }
        if ($root !== false) {
            return $root;
        }
        // If root node is not specified we take parent id of node with
        // least lft value as root node id.
        $leastValue = null;
        /** @var Model|NodeTrait $node */
        foreach ($this->items as $node) {
            if ($leastValue === null || $node->getLft() < $leastValue) {
                $leastValue = $node->getLft();
                $root = $node->getParentId();
            }
        }
        return $root;
    }

    public function toFlattenedTree()
    {
        $tree = $this->toTree();
        return $tree->flattenTree();
    }
    /**
     * Flatten a tree into a non recursive array
     */
    public function flattenTree()
    {
        $items = [];
        foreach ($this->items as $node) {
            $items = array_merge($items, $this->flattenNode($node));
        }
        return new static($items);
    }
    /**
     * Flatten a single node
     *
     * @param $node
     * @return array
     */
    protected function flattenNode($node)
    {
        $items = [];
        $items[] = $node;
        foreach ($node->children as $childNode) {
            $items = array_merge($items, $this->flattenNode($childNode));
        }
        return $items;
    }

    /**
     * 输出树状图谱格式
     * @param string $editUrl
     * @param string $tag
     * @param callable|null $callable
     * @return string
     */
    public function renderTree($editUrl='',$tag='ul',$sortUrl ='',Callable $callable=null){
        $out = '';
        $tree = $this->toTree();
        if($tree){
            if(!$callable){
                $callable = function($node) use ($editUrl,$sortUrl){
                    if(!empty($editUrl)){
                        $editUrl = urldecode($editUrl);
                        $sortLink = '';
                        if(!empty($sortUrl)) {
                            $sortUrl = urldecode($sortUrl);
                          //  if (!$node->isRoot()) {
                            if ($node->getPrevNode()) {
                                $sortLink .= '&nbsp;&nbsp;<a href="' . $sortUrl . '?id=' . $node->getKey() . '&sort=up">up</a>';
                            }
                            if ($node->getNextNode()) {
                                $sortLink .= '&nbsp;&nbsp;<a href="' . $sortUrl . '?id=' . $node->getKey() . '&sort=down">down</a>';
                            }
                        }
                      //  }
                        return  '<li data-id="'.$node->getKey().'"><a href="'.vsprintf($editUrl,$node->getKey()) .'">' . $node->name . '</a><span>'.$sortLink.'</span>{sub-tree}</li>';
                    }
                    return '<li>' . $node->name . '{sub-tree}</li>';
                };
            }
            $out = $this->renderAsTree($tree,$tag,$sortUrl,$callable);
        }
        return $out;
    }

    /**
     * 输出嵌套格式
     * @param string $editUrl
     * @param string $tag
     * @param callable|null $callable
     * @return string
     */
    public function renderNestset($editUrl='',$tag='ul',Callable $callable=null){
        $out = '';
        $tree = $this->toTree();
        if($tree){
            if(!$callable){
                $callable = function($node) use ($editUrl){
                    if(!empty($editUrl)){
                        $editUrl = urldecode($editUrl);

                        return  '<li class="dd-item" data-id="'.$node->getKey().' "><div class="dd-handle"><a href="'.vsprintf($editUrl,$node->getKey()) .'"><i class="icon-pencil"></i>' . $node->name . '</a></div>{sub-tree}</li>';
                    }
                    return '<li>' . $node->name . '{sub-tree}</li>';
                };
            }
            $out = $this->renderAsNestset($tree,$tag,$callable);
        }
        return $out;
    }
    /**
     * @param $tag
     * @param callable $render
     * @param bool $displayRoot
     * @return string
     * EXAMPLE:
     * $root->render(
     *    'ul',
     *    function ($node) {
     *       return '<li>' . $node->title . '{sub-tree}</li>';
     *   },
     *   TRUE
     * );
     */
    protected function renderAsNestset($tree ,$tag, Callable $callable,$depth=1){
        $out = '';
        if(!$tree->isEmpty()){
            $out .= '<' . $tag . ' class="dd-list">';  //第一级先ul，再li
            foreach($tree as $node){
                $root      = $callable($node);
                $subTree = '';
                if($node->children && !$node->children->isEmpty()){
                    $subTree =$this->renderAsNestset($node->children,$tag,$callable,$depth);
                }
                $out .= str_replace('{sub-tree}', $subTree, $root);
            }
            $out .= '</' . $tag . '>';
        }
        return $out;
    }

    protected function renderAsTree($tree ,$tag,$sortUrl, Callable $callable,$depth=1){
        $out = '';
        if(!$tree->isEmpty()){
            $out .= '<' . $tag . ' class="tree tree-level-'.$depth.'">';  //第一级先ul，再li
            foreach($tree as $node){
                $root      = $callable($node);
                $subTree = '';
                if($node->children && !$node->children->isEmpty()){
                    $depth++;
                    $subTree =$this->renderAsTree($node->children,$tag,$sortUrl,$callable,$depth);
                    $depth--;
                }
                $out .= str_replace('{sub-tree}', $subTree, $root);
            }
            $out .= '</' . $tag . '>';
        }
        return $out;
    }

    /**
     * 输出戴航列表格式
     */
    public function renderNavlist($tag='ul',Callable $callable=null){
        $out = '';
        $tree = $this->toTree();
        if($tree){
            if(!$callable){
                $callable = function($node,$depth){
                    $url = url($node->url_key);
                    $arrow = '';//<b class="arrow icon-angle-down"></b>
                    $menuText = '<span class="title">%s</span>';
                    $aclass = 'data-toggle="collapse"';
                    $liClass =' class="panel panel-default dropdown"';
                    if($node->children &&  !$node->children->isEmpty()){
                        $url = '#dropdown-element-'.$node->id;
                    }else{
                        $liClass = $aclass = '';
					}
                    if($depth>2){
                        $menuText='%s';
                        $arrow = '';
                        $aclass = '';
                        $liClass ='';
                    }
                    return  '<li'.$liClass.'><a href="'.$url .'" '.$aclass.'><span class="icon fa fa-cubes"></span>' .vsprintf($menuText,[$node->name]) .$arrow. '</a>{sub-tree}</li>';
                    //return '<li>' . $node->name . '{sub-tree}</li>';
                };
            }
            $out = $this->renderAsNavlist($tree,$tag,$callable,1,$tree[0]->id);
        }
        return $out;
    }

    protected function renderAsNavlist($tree ,$tag, Callable $callable,$depth=1,$id=''){
        $out = '';
        if(!$tree->isEmpty()){
            if($depth==1){
                $out .= '<' . $tag . ' class="nav navbar-nav">';
            }else{
                $out .='<div id="dropdown-element-'.$id.'" class="panel-collapse collapse"><div class="panel-body">';
                $out .= '<' . $tag . ' class="nav navbar-nav">';  //第一级先ul，再li
            }
            foreach($tree as $node){
                $root      = $callable($node,$depth);
                $subTree = '';
                if($node->children && !$node->children->isEmpty()){
                    $depth++;
                    $subTree =$this->renderAsNavlist($node->children,$tag,$callable,$depth,$node->id);
                    $depth--;
                }
                $out .= str_replace('{sub-tree}', $subTree, $root);
            }
            $out .= '</' . $tag . '>';
            if($depth>1){
                $out .='</div></div>';
            }
        }
        return $out;
    }

    /**
     * 输出纵列导航格式
     * @param string $tag
     * @param callable|null $callable
     * @return string
     */
    public function renderHorizontal($tag='ul',Callable $callable=null){
        $out = '';
        $tree = $this->toTree();

        if($tree){
            if(!$callable){
                $callable = function($node,$depth){
                    $url = url($node->url_key);
                    $arrow = '<span class="caret"></span>';
                    $menuText = '<span class="menu-text">%s</span>';
                    $aclass = 'class="dropdown-toggle" aria-expanded="true" data-toggle="dropdown"';
                    if($node->children &&  !$node->children->isEmpty()){
                        $url = '#';
                    }else{
                        $aclass = '';
                        $arrow = '';
                    }
                    if($depth>2){
                        $menuText='%s';
                        $arrow = '';
                        $aclass = '';
                    }
                    return  '<li><a href="'.$url .'" '.$aclass.'>' .vsprintf($menuText,[$node->name]) .$arrow. '</a>{sub-tree}</li>';
                    //return '<li>' . $node->name . '{sub-tree}</li>';
                };
            }
            $out = $this->renderAsHorizontal($tree,$tag,$callable);
        }

        return $out;
    }

    protected function renderAsHorizontal($tree,$tag,Callable $callable,$depth=1){
        $out = '';
        if(!$tree->isEmpty()){
            if($depth==1){
                $out .= '<' . $tag . ' class="nav navbar-nav">';
            }else{
                $out .= '<' . $tag . ' class="dropdown-menu">';  //第一级先ul，再li
            }
            foreach($tree as $node){
                $root      = $callable($node,$depth);
                $subTree = '';
                if($node->children && !$node->children->isEmpty()){
                    $depth++;
                    $subTree =$this->renderAsHorizontal($node->children,$tag,$callable,$depth);
                    $depth--;
                }
                $out .= str_replace('{sub-tree}', $subTree, $root);
            }

            $out .= '</' . $tag . '>';
        }
        return $out;
    }

}