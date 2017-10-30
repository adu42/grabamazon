<?php

namespace Kaishiyoku\HtmlPurifier;

use HTMLPurifier_Config;
use HTMLPurifier as Purifer;

class HtmlPurifier
{
    /**
     * @var HTMLPurifier_Config
     */
    private $config;

    /**
     * @var \HTMLPurifier
     */
    private $purifier;

    /**
     * HtmlPurifier constructor.
     */
    public function __construct()
    {
        $this->config = HTMLPurifier_Config::createDefault();

        $this->config->set('HTML.Doctype', 'HTML 4.01 Transitional');
        $this->config->set('CSS.AllowTricky', true);
        $this->config->set('Attr.EnableID', true);


        $this->setHtml5Properties();

        $this->purifier = new Purifer($this->config);
    }

    private function setHtml5Properties()
    {
        // Set some HTML5 properties
        $this->config->set('HTML.DefinitionID', 'html5-definitions');
        $this->config->set('HTML.DefinitionRev', 1);

        if ($def = $this->config->maybeGetRawHTMLDefinition()) {
            // http://developers.whatwg.org/sections.html
            $def->addElement('section', 'Block', 'Flow', 'Common');
            $def->addElement('nav',     'Block', 'Flow', 'Common');
            $def->addElement('article', 'Block', 'Flow', 'Common');
            $def->addElement('aside',   'Block', 'Flow', 'Common');
            $def->addElement('header',  'Block', 'Flow', 'Common');
            $def->addElement('footer',  'Block', 'Flow', 'Common');

            // Content model actually excludes several tags, not modelled here
            $def->addElement('address', 'Block', 'Flow', 'Common');
            $def->addElement('hgroup', 'Block', 'Required: h1 | h2 | h3 | h4 | h5 | h6', 'Common');

            // http://developers.whatwg.org/grouping-content.html
            $def->addElement('figure', 'Block', 'Optional: (figcaption, Flow) | (Flow, figcaption) | Flow', 'Common');
            $def->addElement('figcaption', 'Inline', 'Flow', 'Common');

            // http://developers.whatwg.org/the-video-element.html#the-video-element
            $def->addElement('video', 'Block', 'Optional: (source, Flow) | (Flow, source) | Flow', 'Common', array(
                'src' => 'URI',
                'type' => 'Text',
                'width' => 'Length',
                'height' => 'Length',
                'poster' => 'URI',
                'preload' => 'Enum#auto,metadata,none',
                'controls' => 'Bool',
            ));
            $def->addElement('source', 'Block', 'Flow', 'Common', array(
                'src' => 'URI',
                'type' => 'Text',
            ));

            // http://developers.whatwg.org/text-level-semantics.html
            $def->addElement('s',    'Inline', 'Inline', 'Common');
            $def->addElement('var',  'Inline', 'Inline', 'Common');
            $def->addElement('sub',  'Inline', 'Inline', 'Common');
            $def->addElement('sup',  'Inline', 'Inline', 'Common');
            $def->addElement('mark', 'Inline', 'Inline', 'Common');
            $def->addElement('wbr',  'Inline', 'Empty', 'Core');

            // http://developers.whatwg.org/edits.html
            $def->addElement('ins', 'Block', 'Flow', 'Common', array('cite' => 'URI', 'datetime' => 'CDATA'));
            $def->addElement('del', 'Block', 'Flow', 'Common', array('cite' => 'URI', 'datetime' => 'CDATA'));

            // Bootstrap Dropdown
            $def->addAttribute('a', 'data-toggle', 'Text');
            $def->addAttribute('a', 'data-provide', 'Text');
            $def->addAttribute('a', 'role', 'Text');
            $def->addAttribute('a', 'aria-haspopup', 'Bool');
            $def->addAttribute('a', 'aria-expanded', 'Bool');
            $def->addAttribute('a', 'title', 'Text');
        }
    }

    public function purify($value)
    {
        return $this->purifier->purify($value);
    }
}
