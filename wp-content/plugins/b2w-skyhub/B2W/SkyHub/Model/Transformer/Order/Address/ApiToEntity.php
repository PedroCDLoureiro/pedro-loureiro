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

namespace B2W\SkyHub\Model\Transformer\Order\Address;

use B2W\SkyHub\Model\Entity\Order\AddressEntity;
use B2W\SkyHub\Model\Map\MapAttribute;
use B2W\SkyHub\Model\Map\Order\AddressMap;
use B2W\SkyHub\Model\Transformer\ApiToEntityAbstract;

/**
 * Class DbToEntity
 * @package B2W\SkyHub\Model\Transformer\Order\Address
 */
class ApiToEntity extends ApiToEntityAbstract
{
    /**
     * @return AddressMap|mixed
     */
    protected function _getMapInstance()
    {
        return new AddressMap();
    }

    /**
     * @return AddressEntity|mixed
     */
    public function _getEntityInstance()
    {
        $entity = new AddressEntity();
        $entity->setType($this->_getAddrType());
        return $entity;
    }

    /**
     * @return string
     */
    protected function _getAddrType()
    {
        return $this->_attribute->getSkyhub() == 'billing_address'
            ? 'billing'
            : 'shipping';
    }

    /**
     * @param $attribute
     * @return mixed|null
     */
    protected function _getApiValue(MapAttribute $attribute, array $data)
    {
        $local = str_replace('{{ADDR_TYPE}}', '_' . $this->_getAddrType(), $attribute->getWordpress());
        $attribute->setWordpress($local);
        return parent::_getApiValue($attribute, $data);
    }
}