<?php

namespace App\Services;

use App\Models\Additional\ApiModelInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

/**
 * Class AbstractService
 */
abstract class AbstractService
{
    /**
     * @var string $_modelClass
     */
    protected static $_modelClass;
    /**
     * @var ApiModelInterface|Model $_model
     */
    protected $_model;

    /**
     * AbstractService constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        $this->_validateModelClass();
        $this->setModel(app(static::$_modelClass));
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|null
     */
    public function getAll()
    {
        return $this->getModel()->doRead();
    }

    /**
     * @param $value
     * @param string $by
     * @return mixed
     */
    public function getOne($value, $by = "id")
    {
        return $this->getModel()->doRead($value, $by);
    }

    /**
     * @param array|null $data
     * @return mixed
     */
    public function create(array $data = null)
    {
        if (null === $data) {
            $data = Request::only($this->getModel()->getFillable());
        }

        $method = "_validate" . ucfirst(__FUNCTION__);
        if (method_exists($this, $method)) {
            $validationResult = $this->{$method}();
            if ($validationResult !== true) {
                return $validationResult;
            }
        }

        return $this->getModel()->doCreate($data);
    }

    /**
     * @param int $id
     * @param array $data
     * @return Model|mixed
     * @throws \Exception
     */
    public function update($id, array $data = null)
    {
        if (null === $data) {
            $data = Request::only($this->getModel()->getFillable());
        }

        $method = "_validate" . ucfirst(__FUNCTION__);
        if (method_exists($this, $method)) {
            $validationResult = $this->{$method}();
            if ($validationResult !== true) {
                return $validationResult;
            }
        }

        return $this->getModel()->doUpdate($data, $id);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function remove($id)
    {
        return $this->getModel()->doDelete($id);
    }

    /**
     * @param ApiModelInterface $model
     */
    public function setModel(ApiModelInterface $model)
    {
        $this->_model = $model;
    }

    /**
     * @return ApiModelInterface
     */
    public function getModel()
    {
        return $this->_model;
    }

    /**
     * @throws \Exception
     */
    protected function _validateModelClass()
    {
        if (!class_exists(static::$_modelClass)) {
            throw new \Exception(sprintf(
                'The model class {%s} for %s service dose not exists or not set correctly',
                static::$_modelClass,
                get_class()
            ));
        }
    }
}