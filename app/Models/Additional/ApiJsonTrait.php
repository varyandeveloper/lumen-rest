<?php
/**
 * Created by PhpStorm.
 * User: Owner
 * Date: 05.02.2018
 * Time: 20:03
 */

namespace App\Models\Additional;

/**
 * Class ApiJsonTrait
 * @package App\Models\Additional
 */
trait ApiJsonTrait
{
    public function doCreate($data)
    {
        // TODO::add new record into json file
    }

    /**
     * @param $value
     * @param string $by
     */
    public function doRead($value, $by = 'id')
    {
        // TODO::read all|filtered values from json file
    }

    public function doUpdate($data, $value, $by = 'id')
    {
        // TODO::update json file where pKey is $by parameter, value for the pKey is $value and replace data is $data
    }

    /**
     * @param $value
     * @param string $by
     */
    public function doDelete($value, $by = 'id')
    {
        // TODO::delete from json file where pKey is $by parameter and value for pKey is $value
    }
}