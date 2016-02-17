<?php
/**
 * Abstract class for extension
 */
require_once 'Zend/View/Helper/FormElement.php';


/**
 * Helper to generate a "checkbox" element
 *
 * @category   Zend
 * @package    Zend_View
 * @subpackage Helper
 * @copyright  Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Twitter_Bootstrap_View_Helper_FormRadio extends Zend_View_Helper_FormElement
{
    /**
     * Default checked/unchecked options
     * @var array
     */
    protected static $_defaultCheckedOptions = array(
        'checkedValue'   => '1',
        'uncheckedValue' => '0'
    );

    /**
     * Generates a 'checkbox' element.
     *
     * @access public
     *
     * @param string|array $name If a string, the element name.  If an
     * array, all other parameters are ignored, and the array elements
     * are extracted in place of added parameters.
     * @param mixed $value The element value.
     * @param array $attribs Attributes for the element tag.
     * @return string The element XHTML.
     */
<<<<<<< HEAD:Twitter/Bootstrap/View/Helper/FormRadio.php
    public function formRadio($name, $value = null, $attribs = null, $options = null, $listsep = '')
    {
        $info = $this->_getInfo($name, $value, $attribs, $options, $listsep);
        extract($info); // name, value, attribs, options, listsep, disable

        // retrieve attributes for labels (prefixed with 'label_' or 'label')
        $label_attribs = array();
        foreach ($attribs as $key => $val) {
            $tmp    = false;
            $keyLen = strlen($key);
            if ((6 < $keyLen) && (substr($key, 0, 6) == 'label_')) {
                $tmp = substr($key, 6);
            } elseif ((5 < $keyLen) && (substr($key, 0, 5) == 'label')) {
                $tmp = substr($key, 5);
            }

            if ($tmp) {
                // make sure first char is lowercase
                $tmp[0] = strtolower($tmp[0]);
                $label_attribs[$tmp] = $val;
                unset($attribs[$key]);
            }
=======
    public function formCheckbox($name, $value = null, $attribs = null, array $checkedOptions = null)
    {
        $info = $this->_getInfo($name, $value, $attribs);
        extract($info); // name, id, value, attribs, options, listsep, disable

        $checked = false;
        if (isset($attribs['checked']) && $attribs['checked']) {
            $checked = true;
            unset($attribs['checked']);
        } elseif (isset($attribs['checked'])) {
            $checked = false;
            unset($attribs['checked']);
>>>>>>> formcheckbox:Twitter/Bootstrap/View/Helper/FormCheckbox.php
        }

        if (array_key_exists('class', $attribs)) {
            $attribs['class'] = '';
        }

        $checkedOptions = self::determineCheckboxInfo($value, $checked, $checkedOptions);

        // is the element disabled?
        $disabled = '';
        if ($disable) {
            $disabled = ' disabled="disabled"';
        }

        // build the element
        $xhtml = '';
        if ((!$disable && !strstr($name, '[]'))
            && (empty($attribs['disableHidden']) || !$attribs['disableHidden'])
        ) {
            $xhtml = $this->_hidden($name, $checkedOptions['uncheckedValue']);
        }

        if (array_key_exists('disableHidden', $attribs)) {
            unset($attribs['disableHidden']);
        }

        $xhtml .= '<div class="checkbox"><label><input type="checkbox"'
                . ' name="' . $this->view->escape($name) . '"'
                . ' id="' . $this->view->escape($id) . '"'
                . ' value="' . $this->view->escape($checkedOptions['checkedValue']) . '"'
                . $checkedOptions['checkedString']
                . $disabled
                . $this->_htmlAttribs($attribs)
                . $this->getClosingBracket().'</label></div>';

        return $xhtml;
    }

    /**
     * Determine checkbox information
     *
     * @param  string $value
     * @param  bool $checked
     * @param  array|null $checkedOptions
     * @return array
     */
    public static function determineCheckboxInfo($value, $checked, array $checkedOptions = null)
    {
        // Checked/unchecked values
        $checkedValue   = null;
        $uncheckedValue = null;
        if (is_array($checkedOptions)) {
            if (array_key_exists('checkedValue', $checkedOptions)) {
                $checkedValue = (string) $checkedOptions['checkedValue'];
                unset($checkedOptions['checkedValue']);
            }
            if (array_key_exists('uncheckedValue', $checkedOptions)) {
                $uncheckedValue = (string) $checkedOptions['uncheckedValue'];
                unset($checkedOptions['uncheckedValue']);
            }
            if (null === $checkedValue) {
                $checkedValue = (string) array_shift($checkedOptions);
            }
            if (null === $uncheckedValue) {
                $uncheckedValue = (string) array_shift($checkedOptions);
            }
        } elseif ($value !== null) {
            $uncheckedValue = self::$_defaultCheckedOptions['uncheckedValue'];
        } else {
            $checkedValue   = self::$_defaultCheckedOptions['checkedValue'];
            $uncheckedValue = self::$_defaultCheckedOptions['uncheckedValue'];
        }

        // is the element checked?
        $checkedString = '';
        if ($checked || ((string) $value === $checkedValue)) {
            $checkedString = ' checked="checked"';
            $checked = true;
        } else {
            $checked = false;
        }

        // Checked value should be value if no checked options provided
        if ($checkedValue == null) {
            $checkedValue = $value;
        }

        return array(
            'checked'        => $checked,
            'checkedString'  => $checkedString,
            'checkedValue'   => $checkedValue,
            'uncheckedValue' => $uncheckedValue,
        );
    }
}
