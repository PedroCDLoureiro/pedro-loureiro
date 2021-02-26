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

namespace B2W\SkyHub\Model\Repository;

use B2W\SkyHub\Contract\Entity\OrderEntityInterface;
use B2W\SkyHub\Contract\Repository\OrderApiRepositoryInterface;
use B2W\SkyHub\Exception\Api\OrderNotFoundException;
use B2W\SkyHub\Exception\ApiException;
use B2W\SkyHub\Model\Entity\Order\ItemEntity;
use B2W\SkyHub\Model\Entity\OrderEntity;
use B2W\SkyHub\Model\Transformer\Order\ApiToEntity;

/**
 * Class OrderApiRepository
 * @package B2W\SkyHub\Model\Repository
 */
class OrderApiRepository implements OrderApiRepositoryInterface
{
    /**
     * @return OrderEntityInterface|OrderEntity|mixed
     * @throws ApiException
     * @throws OrderNotFoundException
     * @throws \B2W\SkyHub\Exception\Data\RepositoryNotFound
     * @throws \B2W\SkyHub\Exception\Data\TransformerNotFound
     */
    public function queue()
    {
        $requestHandler = \App::api()->queue();
        $response       = $requestHandler->orders();

        return $this->_prepareOrder($response);
    }

    /**
     * @param $id
     * @return OrderEntityInterface|OrderEntity|mixed
     * @throws ApiException
     * @throws OrderNotFoundException
     * @throws \B2W\SkyHub\Exception\Data\RepositoryNotFound
     * @throws \B2W\SkyHub\Exception\Data\TransformerNotFound
     */
    public function one($id)
    {
        $requestHandler = \App::api()->order();
        $response       = $requestHandler->order($id);

        return $this->_prepareOrder($response);
    }

    /**
     * @param OrderEntityInterface $order
     * @return bool|mixed
     * @throws \B2W\SkyHub\Exception\Exception
     */
    public function ack(OrderEntityInterface $order)
    {
        $requestHandler = \App::api()->queue();
        $response       = $requestHandler->delete($order->getCode());

        if ($response->exception()) {
            /** @var \SkyHub\Api\Handler\Response\HandlerException $response */
            throw new \B2W\SkyHub\Exception\Exception($response->message());
        }

        return true;
    }

    /**
     * @param \SkyHub\Api\Handler\Response\HandlerInterface $response
     * @return OrderEntityInterface|OrderEntity
     * @throws ApiException
     * @throws OrderNotFoundException
     * @throws \B2W\SkyHub\Exception\Data\RepositoryNotFound
     * @throws \B2W\SkyHub\Exception\Data\TransformerNotFound
     */
    protected function _prepareOrder(\SkyHub\Api\Handler\Response\HandlerInterface $response)
    {
        /** @var \SkyHub\Api\Handler\Response\HandlerDefault $response */
        if ($response->exception()) {
            return false;
        }

        if (!$response->body()) {
            return false;
        }

        //load order if already exists
        $id   = null;
        $data = $response->toArray();
        
        if ($response->exception()) {
            /** @var \SkyHub\Api\Handler\Response\HandlerException $response */
            throw new ApiException("Order Code: {$data['code']} - " . $response->message());
        }

        /** @var OrderEntityInterface $order */
        if ($order = \App::repository(\App::REPOSITORY_ORDER)->code($data['code'])) {
            $id = $order->getId();
        }

        /** @var ApiToEntity $transformer */
        $transformer = new ApiToEntity();
        $transformer->setResponse($response);

        /** @var OrderEntity $order */
        $order = $transformer->convert();
        //clean transformer
        $transformer = null;

        if ($id) {
            $order->setId($id);
        }

        return $order;
    }

    /**
     * @param OrderEntityInterface $order
     * @return $this|mixed
     * @throws ApiException
     * @throws \B2W\SkyHub\Exception\Data\RepositoryNotFound
     */
    public function shipp(OrderEntityInterface $order)
    {
        /** TODO check how to manage track codes */
        $requestHandler = \App::api()->order();

        $code = get_post_meta($order->getId(),'_skyhub_order_shipping_code');
        $url = get_post_meta($order->getId(),'_skyhub_order_shipping_url');
        $method = get_post_meta($order->getId(),'_skyhub_order_shipping_method');

        $response       = $requestHandler->shipment(
            $order->getCode(),
            $this->_prepareItems($order),
            $code,
            $method,
            $method,
            $url
        );

        if ($response->exception()) {
            /** @var \SkyHub\Api\Handler\Response\HandlerException $response */
            throw new ApiException("OrderId: {$order->getId()} - " . $response->message());
        }

        if ($response->success()) {
            return true;
        }
        return false;
    }

    /**
     * @param OrderEntityInterface $order
     * @return $this|mixed
     * @throws ApiException
     * @throws \B2W\SkyHub\Exception\Data\RepositoryNotFound
     */
    public function invoiceApi(OrderEntityInterface $order)
    {
        $invoice = $order->getInvoices()->first();
        if (!$invoice) {
            return false;
        }

        /** TODO check how to manage track codes */
        $requestHandler = \App::api()->order();
        $response       = $requestHandler->invoice($order->getCode(), $invoice->getKey());

        if ($response->exception()) {
            /** @var \SkyHub\Api\Handler\Response\HandlerException $response */
            throw new ApiException("OrderId: {$order->getId()} - " . $response->message());
        }

        if ($response->success()) {
            return true;
        }
        return false;
    }

    /**
     * @param OrderEntityInterface $order
     * @return $this|mixed
     * @throws ApiException
     */
    public function delivery(OrderEntityInterface $order)
    {
        $requestHandler = \App::api()->order();
        $response       = $requestHandler->delivery($order->getCode());

        if ($response->exception()) {
            /** @var \SkyHub\Api\Handler\Response\HandlerException $response */
            throw new ApiException("OrderId: {$order->getId()} - " . $response->message());
        }

        if ($response->success()) {
            return true;
        }
        return false;
    }

    /**
     * @param OrderEntityInterface $order
     * @return $this|mixed
     * @throws ApiException
     */
    public function cancel(OrderEntityInterface $order)
    {
        $requestHandler = \App::api()->order();
        $response       = $requestHandler->cancel($order->getCode());

        if ($response->exception()) {
            /** @var \SkyHub\Api\Handler\Response\HandlerException $response */
            throw new ApiException("OrderId: {$order->getId()} - " . $response->message());
        }

        if ($response->success()) {
            return true;
        }
        return false;
    }

    /**
     * @param OrderEntityInterface $order
     * @return array
     * @throws \B2W\SkyHub\Exception\Data\RepositoryNotFound
     */
    protected function _prepareItems(OrderEntityInterface $order)
    {
        $itemsArray = array();
        $items      = \App::repository(\App::REPOSITORY_ORDER_ITEM)->load($order);

        /** @var ItemEntity $item */
        foreach ($items as $item) {
            $itemsArray[] = array(
                'sku' => $item->getProduct()->getSku(),
                'qty' => $item->getQty()
            );
        }

        return $itemsArray;
    }
}