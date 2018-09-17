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

$factory->define(App\Models\User::class, function (Faker $faker) {

    $codes = ['EUR', 'USD', 'RUB', 'GBP', 'CZK'];
    shuffle($codes);

    return [
        'name' => uniqid('user', true),
        'country' => $faker->country,
        'city' => $faker->city,
        'balance' => $faker->randomFloat(null, 0, 1000),
        'currency_id' => \App\Models\Currency::where('code', '=', head($codes))->first()->id,
        'email' => uniqid('e', true) . $faker->unique()->safeEmail,
        'password' => 'secret', // secret
        'remember_token' => str_random(10),
    ];
});
