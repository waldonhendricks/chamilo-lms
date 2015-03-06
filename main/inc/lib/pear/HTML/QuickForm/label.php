<?php
/**
 * HTML class for static data
 * @example  $form->addElement('label', 'My label', 'Content');
 */

/**
 * A pseudo-element used for adding raw HTML to form
 *
 * Intended for use with the default renderer only, template-based
 * ones may (and probably will) completely ignore this
 *
 * @category    HTML
 * @package     HTML_QuickForm
 * @author      Alexey Borzov <avb@php.net>
 * @version     Release: 3.2.11
 * @since       3.0
 * @deprecated  Please use the templates rather than add raw HTML via this element
 */
class HTML_QuickForm_label extends HTML_QuickForm_static
{
    // {{{ constructor

    /**
     * Class constructor
     *
     * @param string $text raw HTML to add
     * @access public
     * @return void
     */
    function HTML_QuickForm_label(
        $label = null,
        $text = null,
        $attributes = null
    ) {
        $this->HTML_QuickForm_static(null, $label, $text, $attributes);
        $this->_type = 'html';
    }

    /**
     * Accepts a renderer
     *
     * @param HTML_QuickForm_Renderer    renderer object (only works with Default renderer!)
     * @access public
     * @return void
     */
    public function accept(&$renderer, $required = false, $error = null)
    {
        $renderer->renderHtml($this);
    }

    /**
     * @return string
     */
    public function toHtml()
    {
        $for = $this->getLabelFor();
        return '<label class="control-label"' . (empty($for) ? '' : ' for="' . $for . '"') . '>' . $this->getLabel() . '</label>' . HTML_QuickForm_static::toHtml();
    }
}
