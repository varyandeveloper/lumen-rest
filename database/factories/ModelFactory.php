<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    return [
        'username' => $faker->userName
    ];
});

$factory->define(\App\Models\Question::class, function (Faker\Generator $faker){
    return [
        'content' => $faker->text
    ];
});

$factory->define(\App\Models\Answer::class, function (Faker\Generator $faker){
    return [
        'question_id' => mt_rand(1, \App\Models\Question::count()),
        'content' => $faker->text
    ];
});
