<?php

namespace App\Models\Additional;

/**
 * Class CachableTrait
 * @package App\Models\Additional
 */
trait CachableTrait
{
    /**
     * @return mixed
     */
    public function getAll()
    {
        $results = \Cache::remember($this->toSql(), 5, function () {
            return $this->get();
        });

        return $results;
    }

    /**
     * @return mixed
     */
    public function getCount()
    {
        return \Cache::remeber($this->toSql(), 5, function () {
            return $this->count();
        });
    }

    /**
     * @param null $key
     * @return mixed
     */
    public function flush($key = null)
    {
        if (null !== $key && \Cache::has($key)) {
            return \Cache::forget($key);
        }
        return \Cache::flush();
    }
}