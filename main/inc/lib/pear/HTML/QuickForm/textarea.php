<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * HTML class for a textarea type field
 *
 * PHP versions 4 and 5
 *
 * LICENSE: This source file is subject to version 3.01 of the PHP license
 * that is available through the world-wide-web at the following URI:
 * http://www.php.net/license/3_01.txt If you did not receive a copy of
 * the PHP License and are unable to obtain it through the web, please
 * send a note to license@php.net so we can mail you a copy immediately.
 *
 * @category    HTML
 * @package     HTML_QuickForm
 * @author      Adam Daniel <adaniel1@eesus.jnj.com>
 * @author      Bertrand Mansion <bmansion@mamasam.com>
 * @copyright   2001-2009 The PHP Group
 * @license     http://www.php.net/license/3_01.txt PHP License 3.01
 * @version     CVS: $Id: textarea.php,v 1.13 2009/04/04 21:34:04 avb Exp $
 * @link        http://pear.php.net/package/HTML_QuickForm
 */

/**
 * HTML class for a textarea type field
 *
 * @category    HTML
 * @package     HTML_QuickForm
 * @author      Adam Daniel <adaniel1@eesus.jnj.com>
 * @author      Bertrand Mansion <bmansion@mamasam.com>
 * @version     Release: 3.2.11
 * @since       1.0
 */
class HTML_QuickForm_textarea extends HTML_QuickForm_element
{
    // {{{ properties

    /**
     * Field value
     * @var       string
     * @since     1.0
     * @access    private
     */
    public $_value = null;
    
    private $columnsSize;
    // }}}
    // {{{ constructor

    /**
     * Class constructor
     *
     * @param     string    Input field name attribute
     * @param     mixed     Label(s) for a field
     * @param     mixed     Either a typical HTML attribute string or an associative array
     * @since     1.0
     * @access    public
     * @return    void
     */
    public function __construct($elementName=null, $elementLabel=null, $attributes=null)
    {
        $attributes['class'] = isset($attributes['class']) ? $attributes['class'] : 'form-control';
        $columnsSize = isset($attributes['cols-size']) ? $attributes['cols-size'] : null;
        $this->setColumnsSize($columnsSize);
        parent::__construct($elementName, $elementLabel, $attributes);
        $this->_persistantFreeze = true;
        $this->_type = 'textarea';
    } //end constructor

    // }}}
    // {{{ setName()

    /**
     * Sets the input field name
     *
     * @param     string    $name   Input field name attribute
     * @since     1.0
     * @access    public
     * @return    void
     */
    function setName($name)
    {
        $this->updateAttributes(array('name'=>$name));
    } //end func setName

    // }}}
    // {{{ getName()

    /**
     * Returns the element name
     *
     * @since     1.0
     * @access    public
     * @return    string
     */
    function getName()
    {
        return $this->getAttribute('name');
    } //end func getName

    // }}}
    // {{{ setValue()

    /**
     * Sets value for textarea element
     *
     * @param     string    $value  Value for textarea element
     * @since     1.0
     * @access    public
     * @return    void
     */
    function setValue($value)
    {
        $this->_value = $value;
    } //end func setValue

    // }}}
    // {{{ getValue()

    /**
     * Returns the value of the form element
     *
     * @since     1.0
     * @access    public
     * @return    string
     */
    function getValue()
    {
        return $this->_value;
    } // end func getValue

    // }}}
    // {{{ setWrap()
    
    /**
     * Sets wrap type for textarea element
     *
     * @param     string    $wrap  Wrap type
     * @since     1.0
     * @access    public
     * @return    void
     */
    function setWrap($wrap)
    {
        $this->updateAttributes(array('wrap' => $wrap));
    } //end func setWrap

    // }}}
    // {{{ setRows()

    /**
     * Sets height in rows for textarea element
     *
     * @param     string    $rows  Height expressed in rows
     * @since     1.0
     * @access    public
     * @return    void
     */
    function setRows($rows)
    {
        $this->updateAttributes(array('rows' => $rows));
    } //end func setRows

    // }}}
    // {{{ setCols()

    /**
     * Sets width in cols for textarea element
     *
     * @param     string    $cols  Width expressed in cols
     * @since     1.0
     * @access    public
     * @return    void
     */
    function setCols($cols)
    {
        $this->updateAttributes(array('cols' => $cols));
    } //end func setCols

    // }}}
    // {{{ toHtml()

    /**
     * Returns the textarea element in HTML
     *
     * @since     1.0
     * @access    public
     * @return    string
     */
    public function toHtml()
    {
        if ($this->_flagFrozen) {
            return $this->getFrozenHtml();
        } else {
            return $this->_getTabs() .
                   '<textarea' . $this->_getAttrString($this->_attributes) . '>' .
                   // because we wrap the form later we don't want the text indented
                   // Modified by Ivan Tcholakov, 16-MAR-2010.
                   //preg_replace("/(\r\n|\n|\r)/", '&#010;', htmlspecialchars($this->_value)) .
                   preg_replace("/(\r\n|\n|\r)/", '&#010;', @htmlspecialchars($this->_value, ENT_COMPAT, HTML_Common::charset())) .
                   //
                   '</textarea>';
        }
    }

    /**
     * Returns the value of field without HTML tags (in this case, value is changed to a mask)
     *
     * @since     1.0
     * @access    public
     * @return    string
     */
    public function getFrozenHtml()
    {
        // Modified by Ivan Tcholakov, 16-MAR-2010.
        //$value = htmlspecialchars($this->getValue());
        $value = @htmlspecialchars($this->getValue(), ENT_COMPAT, HTML_Common::charset());
        //
        if ($this->getAttribute('wrap') == 'off') {
            $html = $this->_getTabs() . '<pre>' . $value."</pre>\n";
        } else {
            $html = nl2br($value)."\n";
        }
        return $html . $this->_getPersistantData();
    }
    
    /**
     * @return null
     */
    public function getInputSize()
    {
        return $this->inputSize;
    }

    /**
     * @param null $inputSize
     */
    public function setInputSize($inputSize)
    {
        $this->inputSize = $inputSize;
    }
    /**
     * @return null
     */
    public function getColumnsSize()
    {
        return $this->columnsSize;
    }

    /**
     * @param null $columnsSize
     */
    public function setColumnsSize($columnsSize)
    {
        $this->columnsSize = $columnsSize;
    }
    
    /**
     * @param string $layout
     *
     * @return string
     */
    public function getTemplate($layout)
    {
        $size = $this->getColumnsSize();
        $this->removeAttribute('cols-size');

        if (empty($size)) {
            $sizeTemp = $this->getInputSize();
            if (empty($size)) {
                $sizeTemp = 8;
            }
            $size = array(2, $sizeTemp, 2);
        } else {
            if (is_array($size)) {
                if (count($size) != 3) {
                    $sizeTemp = $this->getInputSize();
                    if (empty($size)) {
                        $sizeTemp = 8;
                    }
                    $size = array(2, $sizeTemp, 2);
                }
                // else just keep the $size array as received
            } else {
                $size = array(2, intval($size), 2);
            }
        }
        

        switch ($layout) {
            case FormValidator::LAYOUT_INLINE:
                return '
                <div class="form-group {error_class}">
                    <label {label-for} >
                        <!-- BEGIN required --><span class="form_required">*</span><!-- END required -->
                        {label}
                    </label>
                    {element}
                </div>';
                break;
            case FormValidator::LAYOUT_HORIZONTAL:
                return '
                <div class="form-group {error_class}">
                    <label {label-for} class="col-sm-'.$size[0].' control-label" >
                        <!-- BEGIN required --><span class="form_required">*</span><!-- END required -->
                        {label}
                    </label>
                    <div class="col-sm-'.$size[1].'">
                        {icon}
                        {element}

                        <!-- BEGIN label_2 -->
                            <p class="help-block">{label_2}</p>
                        <!-- END label_2 -->

                        <!-- BEGIN error -->
                            <span class="help-inline">{error}</span>
                        <!-- END error -->
                    </div>
                    <div class="col-sm-'.$size[2].'">
                        <!-- BEGIN label_3 -->
                            {label_3}
                        <!-- END label_3 -->
                    </div>
                </div>';
                
                break;
            case FormValidator::LAYOUT_BOX_NO_LABEL:
                return '
                        <label {label-for}>{label}</label>
                        <div class="input-group">
                            
                            {icon}
                            {element}
                        </div>';
                break;
        }
    }
    
 
}
