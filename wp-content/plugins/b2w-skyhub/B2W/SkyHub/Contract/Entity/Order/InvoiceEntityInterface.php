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

namespace B2W\SkyHub\Contract\Entity\Order;

/**
 * Interface InvoiceEntityInterface
 * @package B2W\SkyHub\Contract\Entity\Order
 */
interface InvoiceEntityInterface
{
    /**
     * @return mixed
     */
    public function getKey();

    /**
     * @param $key
     * @return mixed
     */
    public function setKey($key);

    /**
     * @return mixed
     */
    public function getNumber();

    /**
     * @param $number
     * @return mixed
     */
    public function setNumber($number);

    /**
     * @return mixed
     */
    public function getLine();

    /**
     * @param $line
     * @return mixed
     */
    public function setLine($line);

    /**
     * @return mixed
     */
    public function getIssueDate();

    /**
     * @param $issueDate
     * @return mixed
     */
    public function setIssueDate($issueDate);
}