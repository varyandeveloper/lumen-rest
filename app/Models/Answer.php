<?php
/**
 * Created by PhpStorm.
 * User: Owner
 * Date: 04.02.2018
 * Time: 0:56
 */

namespace App\Models;

use App\Models\Additional\ApiEloquentTrait;
use App\Models\Additional\ApiModelInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * Class Answer
 * @package App\Models
 */
class Answer extends Model implements ApiModelInterface
{
    use ApiEloquentTrait;

    /**
     * @var array $fillable
     */
    protected $fillable = [
        'question_id',
        'content'
    ];

    /**
     * @param $query
     * @param $questionId
     * @return mixed
     */
    public function scopeWithVotes($query, $questionId, $total = null)
    {
        $raw = null !== $total ? '(COUNT(answer_id) / '.$total.') * 100' : 'COUNT(answer_id)';
        return $query
            ->select($this->getTable() . '.*', DB::raw($raw.' as votes'))
            ->leftJoin('history as h', 'h.answer_id', '=', $this->getTable() . '.id')
            ->where('h.question_id', $questionId)
            ->groupBy($this->getTable() . '.id');
    }
}