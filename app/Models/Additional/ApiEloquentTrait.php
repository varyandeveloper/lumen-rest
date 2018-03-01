<?php
/**
 * Created by PhpStorm.
 * User: Owner
 * Date: 03.02.2018
 * Time: 17:10
 */

namespace App\Models\Additional;

use Illuminate\Database\Eloquent\Collection;

/**
 * Class AddApiModelMethodsTrait
 * @package App\Models
 */
trait ApiEloquentTrait
{
    /**
     * @param $data
     * @return mixed
     */
    public function doCreate($data)
    {
        $item = new self();
        $item->_buildModel($data);
        if ($item->save()) {
            if ($item instanceof CachableInterface) {
                $item->flush();
            }
            return $item;
        }
        return null;
    }

    /**
     * @param null $value
     * @param string $by
     * @param string $operator
     * @return mixed
     */
    public function doRead($value = null, $by = 'id', $operator = '=')
    {
        if (null !== $value) {
            $result = $this->where($by, $operator, $value);

            if ($this instanceof CachableInterface) {
                $result = $result->getAll();
            }

            if ($result instanceof Collection) {
                return $result->count() <= 1 ? $result->first() : $result;
            };
        }

        return $this instanceof CachableInterface
            ? $this->getAll()
            : $this->all();
    }

    /**
     * @param $data
     * @param $value
     * @param string $by
     * @return mixed
     */
    public function doUpdate($data, $value, $by = 'id')
    {
        $item = $this->where($by, '=', $value)->first();
        $item->_buildModel($data);
        if ($item->save()) {
            if ($item instanceof CachableInterface) {
                $item->flush();
            }
            return $item;
        }
        return null;
    }

    /**
     * @param $value
     * @param string $by
     * @return mixed
     */
    public function doDelete($value, $by = 'id')
    {
        if ($this instanceof CachableInterface) {
            $this->flush();
        }
        return $this->where($by, '=', $value)->delete();
    }

    /**
     * @return int
     */
    public function doGetTotal()
    {
        return $this instanceof CachableInterface ? $this->getCount() : $this->count();
    }

    /**
     * @param array $data
     */
    protected function _buildModel($data)
    {
        foreach ($data as $field => $value) {
            $this->{$field} = $value;
        }
    }
}