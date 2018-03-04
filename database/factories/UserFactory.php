<?php

use Faker\Factory as Faker;

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

$factory->define(App\User::class, function ($faker) {
    $faker = Faker::create('en_GB');
    $name = $faker->firstName . " " . $faker->lastName;

    return [
        'name' => $name,
        'email' => str_replace(' ', '', $name) . rand(0, 99) . '@' . $faker->freeEmailDomain,
        'password' => bcrypt($faker->password),
        'remember_token' => str_random(10),
    ];
});
