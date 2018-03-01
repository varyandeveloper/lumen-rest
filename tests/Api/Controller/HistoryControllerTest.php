<?php

/**
 * Class HistoryControllerTest
 */
class HistoryControllerTest extends TestCase
{
    public function testHistoryResponseSuccess()
    {
        factory(\App\Models\Question::class, 2)->create();
        factory(\App\Models\Answer::class, 4)->create(['question_id' => 1]);

        $data = [
            'question_id' => 1,
            'answer_id' => 2
        ];

        $response = $this->post('/history', $data);
        $response->seeStatusCode(401);

        $user = factory(\App\Models\User::class)->create();
        $this->actingAs($user, 'api');

        $response = $this->post('/history', $data);

        $response->seeStatusCode(201);
        $response->seeJsonStructure([
            'history' => [
                'total',
                'answers'
            ]
        ]);
    }
}