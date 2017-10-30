<?php
/**
 * Email: 114458573@qq.com .
 * User: 杜兵
 * Date: 15-7-6
 * Time: 上午11:56
 */

namespace App\Ado\Models\Constuct;
use Exception;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use LogicException;
use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;

class Node extends Eloquent {
    use NodeTrait;
    const LFT = NestedSet::LFT;
    const RGT = NestedSet::RGT;
    const PARENT_ID = NestedSet::PARENT_ID;
    /**
     * @param Node $parent
     *
     * @return $this
     *
     * @deprecated since 4.1
     */
    public function appendTo(self $parent)
    {
        return $this->appendToNode($parent);
    }
    /**
     * @param Node $parent
     *
     * @return $this
     *
     * @deprecated since 4.1
     */
    public function prependTo(self $parent)
    {
        return $this->prependToNode($parent);
    }
    /**
     * @param Node $node
     *
     * @return bool
     *
     * @deprecated since 4.1
     */
    public function insertBefore(self $node)
    {
        return $this->insertBeforeNode($node);
    }
    /**
     * @param Node $node
     *
     * @return bool
     *
     * @deprecated since 4.1
     */
    public function insertAfter(self $node)
    {
        return $this->insertAfterNode($node);
    }
    /**
     * @param array $columns
     *
     * @return self|null
     *
     * @deprecated since 4.1
     */
    public function getNext(array $columns = [ '*' ])
    {
        return $this->getNextNode($columns);
    }
    /**
     * @param array $columns
     *
     * @return self|null
     *
     * @deprecated since 4.1
     */
    public function getPrev(array $columns = [ '*' ])
    {
        return $this->getPrevNode($columns);
    }
    /**
     * @return string
     */
    public function getParentIdName()
    {
        return static::PARENT_ID;
    }
    /**
     * @return string
     */
    public function getLftName()
    {
        return static::LFT;
    }
    /**
     * @return string
     */
    public function getRgtName()
    {
        return static::RGT;
    }
}