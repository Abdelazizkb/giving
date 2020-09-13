<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Donor;
use Faker\Generator as Faker;

$factory->define(Donor::class, function (Faker $faker) {
    return [
        'first_name' => $faker->name,
        'last_name' => $faker->name,

        'email' => $faker->unique()->safeEmail,
        'phone' => $faker->unique()->numberBetween(1,1000000),

        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10)
    ];
});
