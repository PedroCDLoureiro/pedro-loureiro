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

 namespace B2W\SkyHub\Model\Cron\Order;

use B2W\SkyHub\Model\Cron\Jobs;
use B2W\SkyHub\Model\Queue;
use B2W\SkyHub\Exception\Exception;

class Integration extends Jobs
{
    /**
     * Execute queue
     *
     * @return Bollean
     */
    public function execute()
    {
        try{
            $queue = new Queue();
            $queue->run(self::TYPE_QUEUE_ORDER);
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Download orders SkyHub
     *
     * @return Bollean
     */
    public function executeApi()
    {
        try {
            /** @var \B2W\SkyHub\Model\Repository\OrderApiRepository $orderApi */
            $orderApi = \App::repository(\App::REPOSITORY_ORDER, 'api');

            /** @var \B2W\SkyHub\Model\Entity\OrderEntity $order */
            $order = $orderApi->queue();
            if (!$order) {
                return;
            }
            
            if ($order->save()) {
                $orderApi->ack($order);
            }
        } catch (Exception $e) {
            return false;
        }
    }
}