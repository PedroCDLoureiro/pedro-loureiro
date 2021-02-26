<?php
/**
 * BSeller - B2W Companhia Digital
 *
 * DISCLAIMER
 *
 * Do not edit this file if you want to update this module for future new versions.
 *
 * @copyright     Copyright (c) 2017 B2W Companhia Digital. (http://www.bseller.com.br/)
 * Access https://ajuda.skyhub.com.br/hc/pt-br/requests/new for questions and other requests.
 */

namespace B2W\SkyHub\View\Admin\Form\Field;

use B2W\SkyHub\View\Template;

/**
 * Class FieldAbstract
 * @package B2W\SkyHub\View\Admin\Attribute
 */
class FieldAbstract extends Template
{
    /**
     * @var null
     */
    protected $_value   = null;
    /**
     * @var null
     */
    protected $_note    = array();

    protected $_name    = null;
    protected $_id      = null;
    protected $_label   = '';

    /**
     * @param string $value
     * @return $this
     */
    public function setValue($value)
    {
        $this->_value = $value;
        return $this;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->_value;
    }

    /**
     * @param string  $note
     * @return $this
     */
    public function addNote($note)
    {
        $this->_note[] = $note;
        return $this;
    }

    /**
     * @return string
     */
    public function getNote()
    {
        return implode('<br />', $this->_note);
    }

    /**
     * @return null
     */
    public function getName()
    {
        return $this->_name;
    }

    /**
     * @param null $name
     */
    public function setName($name)
    {
        $this->_name = $name;
    }

    /**
     * @return null
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * @param null $id
     */
    public function setId($id)
    {
        $this->_id = $id;
    }

    /**
     * @return string
     */
    public function getLabel()
    {
        return $this->_label;
    }

    /**
     * @param string $label
     */
    public function setLabel($label)
    {
        $this->_label = $label;
    }

}