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

namespace B2W\SkyHub\View\Admin\Sales\Order\Address;

use B2W\SkyHub\Model\Map\MapAttribute;
use B2W\SkyHub\Model\Map\Order\AddressMap;
use B2W\SkyHub\View\Admin\Admin;
use B2W\SkyHub\View\Admin\Attribute\EditAbstract;
use B2W\SkyHub\View\Admin\Form\Field\Text;

/**
 * Class Edit
 * @package B2W\SkyHub\View\Admin\Catalog\Product\Attribute
 */
class Edit extends EditAbstract
{
    /**
     * @var string
     */
    protected $_config      = 'map/order/address';
    /**
     * @var string
     */
    protected $_entity      = 'sales/order/address';
    /**
     * @var string
     */
    protected $_redirect    = Admin::SLUG_SALES_ORDER_CUSTOMER_ATTRIBUTE_LIST;

    /**
     * @return \B2W\SkyHub\Model\Map\MapAbstract|AddressMap
     */
    protected function _loadMapInstance()
    {
        return new AddressMap();
    }

    /**
     * @param MapAttribute $attribute
     * @return Text|mixed|string
     */
    public function renderField(MapAttribute $attribute)
    {
        $field = new Text();
        $field->setName('related-attribute');
        $field->setValue($attribute->getWordpress());
        $field->addNote(__('Use {{ADDR_TYPE}} to dynamically use address type.', Admin::DOMAIN));
        $field->addNote(
            __('Ex.: "{{ADDR_TYPE}}_name" will be converted to _billing_name or _shipping_name', Admin::DOMAIN)
        );
        return $field->render();
    }
}