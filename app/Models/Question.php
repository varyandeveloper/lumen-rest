<?php
/**
 * Created by PhpStorm.
 * User: Owner
 * Date: 04.02.2018
 * Time: 0:55
 */

namespace App\Models;

use App\Models\Additional\ApiEloquentTrait;
use App\Models\Additional\ApiModelInterface;
use App\Models\Additional\CachableInterface;
use App\Models\Additional\CachableTrait;
use App\Models\Scopes\OrderableInterface;
use App\Models\Scopes\OrderableTrait;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Question
 * @package App\Models
 */
class Question extends Model implements ApiModelInterface, CachableInterface, OrderableInterface
{
    use ApiEloquentTrait, CachableTrait, OrderableTrait;

    /**
     * @var array $fillable
     */
    protected $fillable = [
        'content'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function answers()
    {
        return $this->hasMany(Answer::class, 'question_id');
    }
}