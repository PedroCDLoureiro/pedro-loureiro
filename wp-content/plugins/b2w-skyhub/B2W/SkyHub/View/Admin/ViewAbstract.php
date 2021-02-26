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

namespace B2W\SkyHub\View\Admin;

use B2W\SkyHub\View\Template;

/**
 * Class ViewAbstract
 * @package B2W\SkyHub\View\Admin
 */
class ViewAbstract extends Template
{
    const NONCE_FIELD   = 'woocommerce-b2w-skyhub-form-key';
    const NONCE_ACTION  = 'woocommerce-b2w-skyhub';

    /**
     * @var array
     */
    protected $_nonce = array(
        'action'    => self::NONCE_ACTION,
        'field'     => self::NONCE_FIELD
    );

    /**
     * @param $key
     * @return mixed|string
     */
    public function nonce($key)
    {
        return isset($this->_nonce[$key]) ? $this->_nonce[$key] : '';
    }
}