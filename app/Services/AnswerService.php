<?php
/**
 * Created by PhpStorm.
 * User: Owner
 * Date: 05.02.2018
 * Time: 18:06
 */

namespace App\Services;

use App\Models\Answer;

/**
 * Class AnswerService
 * @package App\Services
 */
class AnswerService extends AbstractService
{
    /**
     * @var string $_modelClass
     */
    protected static $_modelClass = Answer::class;

    /**
     * @param $question_id
     * @param $id
     * @return mixed
     */
    public function getByQuestionIdOne($question_id, $id)
    {
        return $this->getModel()->where([
            'id' => $id,
            'question_id' => $question_id
        ])->first();
    }
}