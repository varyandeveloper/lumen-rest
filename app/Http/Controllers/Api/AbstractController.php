<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\AbstractService;
use App\Services\ResponseService;
use Illuminate\Support\Facades\Request;

/**
 * Class AbstractController
 * @package Illuminate\Contracts\Api
 */
abstract class AbstractController extends Controller
{
    /**
     * @var string $_serviceClass
     */
    protected static $_serviceClass;
    /**
     * @var AbstractService $_service
     */
    protected $_service;

    /**
     * AbstractController constructor.
     */
    public function __construct()
    {
        $this->_validateService();
        $this->setService(app(static::$_serviceClass));
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $data = $this->_service->getAll();
        return ResponseService::multiple(0, $data, Request::segment(1));
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function show($id)
    {
        $data = $this->_service->getOne($id);
        if (null === $data) {
            throw new \Exception(sprintf(
                'Sorry! ' . ucfirst(Request::segment(1)) . ' with id %d not found in our collection',
                $id
            ));
        }
        return ResponseService::single($data);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function store()
    {
        $response = $this->_service->create();
        return ResponseService::single($response, Request::segment(1), 201);
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id)
    {
        $response = $this->_service->update($id);
        return ResponseService::single($response, Request::segment(1), 202);
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $response = $this->_service->remove($id);
        return ResponseService::single($response, Request::segment(1), 202);
    }

    /**
     * @param AbstractService $service
     */
    public function setService(AbstractService $service)
    {
        $this->_service = $service;
    }

    /**
     * @return AbstractService
     */
    public function getService()
    {
        return $this->_service;
    }

    /**
     * @throws \Exception
     */
    protected function _validateService()
    {
        if (!class_exists(static::$_serviceClass)) {
            throw new \Exception(sprintf(
                'The service class %s for %s controller dose not exists or not set correctly',
                static::$_serviceClass,
                get_class()
            ));
        }
    }
}