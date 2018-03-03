<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Post::class, function (Faker $faker) {
    return [
        'content' => $faker->realText(256),
        'thread_id' => App\Thread::inRandomOrder()->first()->id,
        'user_id' => App\User::inRandomOrder()->first()->id,
    ];
});
