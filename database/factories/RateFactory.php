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

$factory->define(App\Models\Rate::class, function (Faker $faker) {
    return [
        'created_at' => $faker->dateTime(),
        'rates' => '{"base": "USD", "date": "2018-09-12", "rates": {"AUD": 1.4042, "BGN": 1.6882, "BRL": 4.1311, "CAD": 1.3066, "CHF": 0.97341, "CNY": 6.8699, "CZK": 22.089, "DKK": 6.4388, "EUR": 0.86319, "GBP": 0.76848, "HKD": 7.8493, "HRK": 6.4178, "HUF": 281.17, "IDR": 14825, "ILS": 3.5843, "INR": 72.223, "ISK": 114.03, "JPY": 111.46, "KRW": 1128.5, "MXN": 19.142, "MYR": 4.1465, "NOK": 8.3149, "NZD": 1.5341, "PHP": 54.07, "PLN": 3.7202, "RON": 4.0035, "RUB": 69.193, "SEK": 9.041, "SGD": 1.3763, "THB": 32.785, "TRY": 6.3687, "ZAR": 15.0512}, "amount": 1.0}'
    ];
});
