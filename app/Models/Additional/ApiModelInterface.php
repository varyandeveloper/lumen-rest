<?php
/**
 * Created by PhpStorm.
 * User: Owner
 * Date: 03.02.2018
 * Time: 16:58
 */

namespace App\Models\Additional;

/**
 * Interface ApiModelInterface
 * @package App\Models
 */
interface ApiModelInterface
{
    /**
     * @param $data
     * @return mixed
     */
    public function doCreate($data);

    /**
     * @param mixed $value
     * @param string $by
     * @return mixed
     */
    public function doRead($value = null, $by = 'id');

    /**
     * @param array $data
     * @param $value
     * @param string $by
     * @return mixed
     */
    public function doUpdate($data, $value, $by = 'id');

    /**
     * @param $value
     * @param string $by
     * @return mixed
     */
    public function doDelete($value, $by = 'id');
}