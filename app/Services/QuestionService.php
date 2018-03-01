<?php
/**
 * Created by PhpStorm.
 * User: Owner
 * Date: 04.02.2018
 * Time: 0:59
 */

namespace App\Services;

use App\Models\Question;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;

/**
 * Class QuestionService
 * @package App\Services
 */
class QuestionService extends AbstractService
{
    /**
     * @var string $_modelClass
     */
    protected static $_modelClass = Question::class;

    /**
     *
     * Get question with answers
     *
     * @param mixed $value
     * @param string $by
     * @return Question
     */
    public function getOne($value, $by = "id")
    {
        return $this->getModel()
            ->where($by, '=', $value)
            ->with([
                // append answer to question with additional conditions
                'answers' => function ($q) {
                    // so we need to get only active answers
                    $q->where('active', '=', true);
                }
            ])->first();
    }

    /**
     * @return bool|object
     */
    protected function _validateCreate()
    {
        $validator = Validator::make(Request::all(), [
            'content' => 'required'
        ]);

        if ($validator->fails()) {
            return $validator->messages();
        }

        return true;
    }

    /**
     * @return bool|object
     */
    protected function _validateUpdate()
    {
        $validator = Validator::make(Request::all(), [
            'content' => 'required'
        ]);

        if ($validator->fails()) {
            return $validator->messages();
        }

        return true;
    }
}