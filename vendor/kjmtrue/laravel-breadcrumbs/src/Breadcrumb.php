<?php
namespace KjmTrue\Breadcrumbs;

class Breadcrumb
{
    protected static $breadcrumbs = [];

    protected $divider = '/';

    protected $cssClass = [];

    protected $listElement = 'ul';

    protected $itemElement = 'li';

    protected $beforeElement = '';

    public function __construct()
    {
        if (config('breadcrumb')) {
            $this->divider       = config('breadcrumb.divider');
            $this->cssClass      = config('breadcrumb.cssClass');
            $this->listElement   = config('breadcrumb.listElement');
            $this->itemElement   = config('breadcrumb.itemElement');
            $this->beforeElement = config('breadcrumb.beforeElement');
        }
    }

    /**
     * @param $name
     * @param null $href
     * @param array $args
     * @return $this
     */
    public function add($name, $href = null, $args = [])
    {
        self::$breadcrumbs[] = [
            'name'   => $name,
            'href'   => $href,
            'class'  => isset($args['class'])  ? $args['class']  : '',
            'before' => isset($args['before']) ? $args['before'] : '',
        ];

        return $this;
    }

    /**
     * @param string $divider
     * @return Breadcrumb
     */
    public function setDivider($divider)
    {
        $this->divider = $divider;

        return $this;
    }

    /**
     * @param array $cssClass
     * @return $this
     */
    public function setCssClass(array $cssClass)
    {
        $this->cssClass = $cssClass;

        return $this;
    }

    /**
     * @param string $listElement
     * @return $this
     */
    public function setListElement($listElement)
    {
        $this->listElement = $listElement;

        return $this;
    }

    /**
     * @param $itemElement
     * @return $this
     */
    public function setItemElement($itemElement)
    {
        $this->itemElement = $itemElement;

        return $this;
    }

    /**
     * @param $beforeElement
     * @return $this
     */
    public function setBeforeElement($beforeElement)
    {
        $this->beforeElement = $beforeElement;

        return $this;
    }

    /**
     * @param $crumb
     * @param bool|false $isLast
     * @return string
     */
    protected function renderCrumb($crumb, $isLast = false)
    {
        $itemClass = '';
        if (is_string($crumb['class'])) {
            $itemClass = $crumb['class'];
        } elseif (is_array($crumb['class'])) {
            $itemClass = implode(' ', $crumb['class']);
        }

        $output = "<{$this->itemElement} class='{$itemClass}'>";

        if ($crumb['before']) {
            $output .= $crumb['before'];
        }

        if ($isLast) {
            $output .= "<span>{$crumb['name']}</span>";
        } else {
            $output .= "<a href='{$crumb['href']}'>{$crumb['name']}</a>";
            $output .= $this->divider;
        }

        $output .= "</{$this->itemElement}>";

        return $output;
    }

    /**
     * @return string
     */
    protected function renderCrubms()
    {
        end(self::$breadcrumbs);
        $lastKey = key(self::$breadcrumbs);

        $output = '';
        foreach (self::$breadcrumbs as $key => $crumb)
        {
            $isLast = ($lastKey === $key);
            $output .= $this->renderCrumb($crumb, $isLast);
        }
        return $output;
    }

    /**
     * @return string
     */
    public function render()
    {
        if (! self::$breadcrumbs) {
            return '';
        }

        $cssClass = implode(' ', $this->cssClass);

        return '<ul class="' . $cssClass . '">' .
            $this->beforeElement   .
            $this->renderCrubms() .
        '</ul>';
    }
}