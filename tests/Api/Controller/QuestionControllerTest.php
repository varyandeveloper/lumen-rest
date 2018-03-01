<?php

/**
 * Class QuestionControllerTest
 */
class QuestionControllerTest extends TestCase
{
    public function testQuestionCreatedAction()
    {
        $data = [
            'content' => "Is this a test question?"
        ];

        $response = $this->post('/questions', $data);
        $response->seeStatusCode(401);

        $user = factory(\App\Models\User::class)->create();
        $this->actingAs($user, 'api');

        $response = $this->post('/questions', $data);

        $response->seeStatusCode(201);
        $response->seeJsonStructure([
            'questions' => ['id', 'content', 'created_at', 'updated_at']
        ]);
    }

    public function testQuestionUpdated()
    {
        $data = [
            'content' => 'modified question'
        ];

        $response = $this->put('/questions/1', $data);
        $response->seeStatusCode(401);

        $user = factory(\App\Models\User::class)->create();
        $this->actingAs($user, 'api');
        factory(\App\Models\Question::class, 2)->create();

        $response = $this->put('/questions/1', $data);

        $response->seeStatusCode(202);
        $response->seeJsonStructure([
            '*' => ['id', 'content', 'created_at', 'updated_at']
        ]);
    }

    public function testQuestionListedAction()
    {
        factory(\App\Models\Question::class, 5)->create();

        $response = $this->get('/questions');
        $response->seeStatusCode(401);

        $user = factory(\App\Models\User::class)->create();
        $this->actingAs($user, 'api');
        $response = $this->get('/questions');

        $response->seeStatusCode(200);
        $response->seeJsonStructure([
            'total',
            'questions' => [
                ['id','content', 'created_at', 'updated_at']
            ]
        ]);
    }

    public function testQuestionFoundedAction()
    {
        factory(\App\Models\Question::class, 3)->create();

        $response = $this->get('/questions/2');
        $response->seeStatusCode(401);

        $user = factory(\App\Models\User::class)->create();
        $this->actingAs($user, 'api');

        $response = $this->get('/questions/2');
        $response->seeStatusCode(200);
        $response->seeJsonStructure([
            'item' => ['id', 'content', 'created_at', 'updated_at', 'answers']
        ]);
    }

    public function testQuestionFoundedWithAnswersAction()
    {
        factory(\App\Models\Question::class, 3)->create();
        factory(\App\Models\Answer::class, 5)->create(['question_id' => 3]);
        $user = factory(\App\Models\User::class)->create();
        $this->actingAs($user, 'api');

        $response = $this->get('/questions/3');
        $response->seeStatusCode(200);
        $response->seeJsonStructure([
            'item' => ['id', 'content', 'created_at', 'updated_at',
                'answers' => [
                    ['id', 'question_id', 'content', 'created_at', 'updated_at']
                ]
            ]
        ]);
    }
}