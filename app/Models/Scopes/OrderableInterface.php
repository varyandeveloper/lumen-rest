<?php
/**
 * Created by PhpStorm.
 * User: Owner
 * Date: 05.02.2018
 * Time: 0:17
 */

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;

/**
 * Interface OrderableInterface
 * @package App\Models\Scopes
 */
interface OrderableInterface
{
    /**
     * @param Builder $query
     * @return mixed
     */
    public function scopeReordered($query);
}