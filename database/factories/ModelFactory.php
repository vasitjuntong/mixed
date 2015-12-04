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

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt(12345),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Project::class, function (Faker\Generator $faker) {
    return [
        'code' => str_random('2') . rand(10, 99),
    ];
});

$factory->define(App\Unit::class, function (Faker\Generator $faker) {
    return [
        'name' => str_random('4'),
    ];
});

$factory->define(App\Location::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->address,
    ];
});
