<?php

namespace App\Models\Additional;

/**
 * Interface CachableInterface
 * @package App\Models\Additional
 */
interface CachableInterface
{
    /**
     * @return array|null
     */
    public function getAll();

    /**
     * @return mixed
     */
    public function getCount();

    /**
     * @param null $key
     * @return mixed
     */
    public function flush($key = null);
}