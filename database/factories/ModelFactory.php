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

/**
 * @var \Illuminate\Database\Eloquent\Factory $factory
 */
$factory->define(\App\Questionnaire::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->sentence(4),
        'description' => $faker->sentence(15),
    ];
});

$factory->define(\App\Section::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->title,
        'order' => $faker->randomNumber(2),
    ];
});

$factory->define(\App\Question::class, function (Faker\Generator $faker) {
    return [
        'text' => $faker->sentence(15),
        'input_type' => $faker->randomElement([0]),
    ];
});

$factory->define(\App\Answer::class, function (Faker\Generator $faker) {
    return [
        'value' => $faker->sentence(10),
    ];
});