<?php
/**
 * Created by PhpStorm.
 * User: Owner
 * Date: 05.02.2018
 * Time: 17:46
 */

namespace App\Models;

use App\Models\Additional\ApiEloquentTrait;
use App\Models\Additional\ApiModelInterface;
use App\Models\Additional\CachableInterface;
use App\Models\Additional\CachableTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * Class History
 * @package App\Models
 */
class History extends Model implements CachableInterface, ApiModelInterface
{
    use ApiEloquentTrait, CachableTrait;

    protected $table = 'history';
    /**
     * @var array $fillable
     */
    protected $fillable = [
        'question_id',
        'answer_id',
        'user_id'
    ];

    /**
     * @param $questionId
     * @return mixed
     */
    public function getVotes($questionId)
    {
        return $this
            ->select('content', DB::raw('COUNT(answer_id) as votes'))
            ->where($this->getTable() . '.question_id', $questionId)
            ->leftJoin('answers as a', 'a.id', '=', $this->getTable() . '.question_id')
            ->get();
    }
}