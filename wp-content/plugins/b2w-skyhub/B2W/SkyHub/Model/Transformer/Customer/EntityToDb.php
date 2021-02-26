<?php
/**
 * BSeller - B2W Companhia Digital
 *
 * DISCLAIMER
 *
 * Do not edit this file if you want to update this module for future new versions.
 *
 * @copyright     Copyright (c) 2019 B2W Companhia Digital. (http://www.bseller.com.br/)
 * Access https://ajuda.skyhub.com.br/hc/pt-br/requests/new for questions and other requests.
 */

namespace B2W\SkyHub\Model\Transformer\Customer;


use B2W\SkyHub\Model\Transformer\EntityToDbAbstract;

class EntityToDb extends EntityToDbAbstract
{
    protected function _getMapInstance()
    {
        return null;
    }

    /**
     * Verify is exist email, if not exist, create new custumer
     * 
     * @return Int
     */
    public function convert()
    {
        $email = $this->_data->getEmail();
        if (!$email) {
            return 0;
        }

        if ($userId = email_exists($email)) {
            return $userId;
        }

        $userId = wc_create_new_customer(
            $this->_data->getEmail(),
            $this->_data->getEmail(),
            time()
        );

        if ($userId) {
            return $userId;
        }
    }
}
