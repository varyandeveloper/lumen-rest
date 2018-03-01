<?php

namespace App\Models\Scopes;

/**
 * Class Orderable
 * @package App\Models\Scopes
 */
trait OrderableTrait
{
    /**
     * @param $query
     * @return mixed
     */
    public function scopeReordered($query)
    {
        $orderField = property_exists($this, '_orderField') ? $this->_orderField : 'id';
        $query->orderBy($orderField, 'desc');
        return $this;
    }
}