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

namespace B2W\SkyHub\Model;

use B2W\SkyHub\Exception\Exception;
use B2W\SkyHub\Exception\Integrator\Catalog\Product\Validation\ProductNotExistException;
use B2W\SkyHub\Exception\Queue\MethodNotFoundException;
use B2W\SkyHub\Exception\Queue\ModelNotFoundException;
use B2W\SkyHub\Exception\Queue\WorkerExecutionError;
use B2W\SkyHub\Model\Queue\MessageAbstract;
use B2W\SkyHub\Exception\Queue\EmptyQueueException;

/**
 * Class Queue
 * @package B2W\SkyHub\Model
 */
class Queue
{
    /**
     * @param string $type
     * @return $this
     * @throws MethodNotFoundException
     * @throws ModelNotFoundException
     * @throws WorkerExecutionError
     * @throws \B2W\SkyHub\Exception\Data\RepositoryNotFound
     */
    public function run($type = 'default')
    {
        try {
            /** @var MessageAbstract $message */
            $getResults = \App::repository(\App::REPOSITORY_QUEUE)->get($type);
            $this->runQueue($getResults);
        } catch (Exception $e) {
            \App::logException($e);
            throw new WorkerExecutionError($e->getMessage());
        }
    }

    /**
     * @param int $idQueue
     * @return $this
     * @throws WorkerExecutionError
     * @throws \B2W\SkyHub\Exception\Data\RepositoryNotFound
     */
    public function runById($idQueue)
    {
        try {
            /** @var MessageAbstract $message */
            $getResults = \App::repository(\App::REPOSITORY_QUEUE)->getById($idQueue);
            $this->runQueue($getResults);
        } catch (Exception $e) {
            \App::logException($e);
            throw new WorkerExecutionError($e->getMessage());
        }
    }

    /**
     * @param array $getResults
     * @return MessageAbstract $message
     * @throws Exception
     */
    protected function runQueue($getResults)
    {
        if (!$getResults) {
            return $this;
        }

        if (!is_array($getResults)) {
            $getResults = [$getResults];
        }

        $count = 0;
        foreach ($getResults as $message) {
            $count++;
            $model  = $message->getModel();
            $method = $message->getMethod();
            $params = $message->getParams();

            try {
                if (!class_exists($model)) {
                    throw new ModelNotFoundException($model);
                }

                $model = new $model;

                if (!method_exists($model, $method)) {
                    throw new MethodNotFoundException($method);
                }

                $response = call_user_func_array(array($model, $method), $params);
                if ($response) {
                    \App::repository(\App::REPOSITORY_QUEUE)->ack($message);
                } else {
                    throw new Exception('Error when delete queue item. IDQueue: ' . $message->getId());
                }
            } catch (ModelNotFoundException $e) {
                \App::repository(\App::REPOSITORY_QUEUE)->ack($message);
                \App::logException($e);
                continue;
            } catch (ProductNotExistException $e) {
                \App::repository(\App::REPOSITORY_QUEUE)->ack($message);
                \App::logException($e);
                continue;
            } catch (MethodNotFoundException $e) {
                \App::repository(\App::REPOSITORY_QUEUE)->ack($message);
                continue;
            } catch (EmptyQueueException $e) {
                \App::repository(\App::REPOSITORY_QUEUE)->error($message);
                continue;
            }
        }
    }
}