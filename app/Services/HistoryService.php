<?php
/**
 * Created by PhpStorm.
 * User: Owner
 * Date: 05.02.2018
 * Time: 17:45
 */

namespace App\Services;

use App\Models\Answer;
use App\Models\History;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;

/**
 * Class HistoryService
 * @package App\Services
 */
class HistoryService extends AbstractService
{
    /**
     * @var string $_modelClass
     */
    protected static $_modelClass = History::class;

    /**
     * @var Answer $_answer
     */
    private static $_answer;

    /**
     * @param array|null $data
     * @return array|bool
     * @throws \Exception
     */
    public function create(array $data = null)
    {
        if (null === $data) {
            $data = Request::only($this->getModel()->getFillable());
        }

        $validationResult = $this->_validateCreate();
        if ($validationResult !== true) {
            return $validationResult;
        }

        $data['user_id'] = Auth::id();

        $row = $this->getModel()->where([
            'user_id' => $data['user_id'],
            'question_id' => $data['question_id']
        ])->first();

        try{
            if(!$row){
                $this->getModel()->doCreate($data);
            }

            $total = $this->getModel()->where('question_id', $data['question_id'])->count();
            return [
                'total' => $total,
                'answers' => app(AnswerService::class)->getModel()->withVotes($data['question_id'], $total)->get()
            ];
        }catch (\Exception $exception){
            throw $exception;
        }
    }

    /**
     * @param $question_id
     * @param $id
     * @return Answer
     */
    public static function getAnswer($question_id, $id)
    {
        if(!self::$_answer){
            self::$_answer = app(AnswerService::class)->getByQuestionIdOne($question_id, $id);
        }
        return self::$_answer;
    }

    /**
     * @return bool
     * @throws \Exception
     */
    protected function _validateCreate()
    {
        $request = Request::all();
        $validator = Validator::make($request, [
            'answer_id' => 'required',
            'question_id' => 'required'
        ]);

        if(!self::getAnswer($request['question_id'], $request['answer_id'])){
            throw new \Exception(sprintf(
                "Answer with id %d not found for question with id %d in our collection",
                $request['answer_id'],
                $request['question_id']
            ));
        }

        if ($validator->fails()) {
            return $validator->messages();
        }

        return true;
    }
}