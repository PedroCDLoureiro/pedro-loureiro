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

namespace B2W\SkyHub\Model\Entity\Order;

use B2W\SkyHub\Model\Entity\EntityAbstract;

/**
 * Class AddressEntity
 * @package B2W\SkyHub\Model\Entity\Order
 */
class AddressEntity extends EntityAbstract implements \B2W\SkyHub\Contract\Entity\Order\AddressEntityInterface
{
    /** @var string */
    protected $_type            = null;
    /** @var string */
    protected $_street          = null;
    /** @var string */
    protected $_number          = null;
    /** @var string */
    protected $_detail          = null;
    /** @var string */
    protected $_neighborhood    = null;
    /** @var string */
    protected $_city            = null;
    /** @var string */
    protected $_region          = null;
    /** @var string */
    protected $_country         = 'BR';
    /** @var string */
    protected $_postcode        = null;
    /** @var string */
    protected $_reference       = null;
    /** @var string */
    protected $_complement      = null;
    /** @var string */
    protected $_phone           = null;
    /** @var string */
    protected $_secondary_phone = null;

    /**
     * @var array
     */
    protected $_additional_data = array();

    /**
     * @return string
     */
    public function getType()
    {
        return $this->_type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->_type = $type;
    }

    /**
     * @return null
     */
    public function getStreet()
    {
        return $this->_street;
    }

    /**
     * @param null $street
     */
    public function setStreet($street)
    {
        $this->_street = $street;
    }

    /**
     * @return string
     */
    public function getNumber()
    {
        return $this->_number;
    }

    /**
     * @param string $number
     */
    public function setNumber($number)
    {
        $this->_number = $number;
    }

    /**
     * @return string
     */
    public function getDetail()
    {
        return $this->_detail;
    }

    /**
     * @param string $detail
     */
    public function setDetail($detail)
    {
        $this->_detail = $detail;
    }

    /**
     * @return string
     */
    public function getNeighborhood()
    {
        return $this->_neighborhood;
    }

    /**
     * @param string $neighborhood
     */
    public function setNeighborhood($neighborhood)
    {
        $this->_neighborhood = $neighborhood;
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->_city;
    }

    /**
     * @param string $city
     */
    public function setCity($city)
    {
        $this->_city = $city;
    }

    /**
     * @return string
     */
    public function getRegion()
    {
        return $this->_region;
    }

    /**
     * @param string $region
     */
    public function setRegion($region)
    {
        $this->_region = $region;
    }

    /**
     * @return string
     */
    public function getCountry()
    {
        return $this->_country;
    }

    /**
     * @param string $country
     */
    public function setCountry($country)
    {
        $this->_country = $country;
    }

    /**
     * @return string
     */
    public function getPostcode()
    {
        return $this->_postcode;
    }

    /**
     * @param string $postcode
     */
    public function setPostcode($postcode)
    {
        $this->_postcode = $postcode;
    }

    /**
     * @return string
     */
    public function getReference()
    {
        return $this->_reference;
    }

    /**
     * @param string $reference
     */
    public function setReference($reference)
    {
        $this->_reference = $reference;
    }

    /**
     * @return string
     */
    public function getComplement()
    {
        return $this->_complement;
    }

    /**
     * @param string $complement
     */
    public function setComplement($complement)
    {
        $this->_complement = $complement;
    }

    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->_phone;
    }

    /**
     * @param string $phone
     */
    public function setPhone($phone)
    {
        $this->_phone = $phone;
    }

    /**
     * @return string
     */
    public function getSecondaryPhone()
    {
        return $this->_secondary_phone;
    }

    /**
     * @param string $secondary_phone
     */
    public function setSecondaryPhone($secondary_phone)
    {
        $this->_secondary_phone = $secondary_phone;
    }

    /**
     * @param null $key
     * @return array|mixed|null
     */
    public function getAdditionalData($key = null)
    {
        if (is_null($key)) {
            return $this->_additional_data;
        }

        return isset($this->_additional_data[$key]) ? $this->_additional_data[$key] : null;
    }

    /**
     * @param $key
     * @param null $value
     * @return $this|mixed
     */
    public function setAdditionalData($key, $value)
    {
        $this->_additional_data[$key] = $value;
        return $this;
    }
}
