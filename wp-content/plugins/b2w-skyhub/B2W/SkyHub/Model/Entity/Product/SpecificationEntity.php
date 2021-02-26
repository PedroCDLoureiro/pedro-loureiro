<?php

/**
 * BSeller - B2W Companhia Digital
 *
 * DISCLAIMER
 *
 * Do not edit this file if you want to update this module for future new versions.
 *
 * @copyright     Copyright (c) 2020 B2W Companhia Digital. (http://www.bseller.com.br/)
 * Access https://ajuda.skyhub.com.br/hc/pt-br/requests/new for questions and other requests.
 */

namespace B2W\SkyHub\Model\Entity\Product;

use B2W\SkyHub\Contract\Entity\Product\Attribute\OptionEntityInterface;
use B2W\SkyHub\Model\Entity\EntityAbstract;
use B2W\SkyHub\Contract\Entity\Product\SpecificationEntityInterface;

/**
 * Class SpecificationEntity
 * @package B2W\SkyHub\Model\Entity\Product
 */
class SpecificationEntity extends EntityAbstract implements SpecificationEntityInterface
{
    /** @var AttributeEntity */
    protected $attribute = null;

    /** @var OptionEntityInterface */
    protected $option = null;

    /** @var string*/
    protected $value = null;

    /** @var string */
    protected $attributeInBase;

    /**
     * @return string
     */
    public function getAttribute()
    {
        return $this->attribute;
    }

    /**
     * @param string $attribute
     * @return $this|mixed
     */
    public function setAttribute($attribute)
    {
        $this->attribute = $attribute;
        return $this;
    }

    /**
     * @return \B2W\SkyHub\Contract\Entity\Product\Attribute\OptionEntityInterface
     */
    public function getOption()
    {
        return $this->option;
    }

    /**
     * @param OptionEntityInterface $option
     * @return $this|mixed
     */
    public function setOption($option)
    {
        $this->option = $option;
        return $this;
    }

    /**
     * Get the value of _value
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set the value of _value
     *
     * @return self
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

    /**
     * Get the value of attributeInBase
     */ 
    public function getAttributeInBase()
    {
        return $this->attributeInBase;
    }

    /**
     * Set the value of attributeInBase
     *
     * @return  self
     */ 
    public function setAttributeInBase($attributeInBase)
    {
        $this->attributeInBase = $attributeInBase;

        return $this;
    }
}