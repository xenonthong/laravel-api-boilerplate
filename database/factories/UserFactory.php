<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(App\User::class, function (Faker $faker) {
    //@TODO: Change based on your local provider
    $faker->addProvider(new \Faker\Provider\en_PH\PhoneNumber($faker));

    return [
        'name' => $faker->name,
        'username' => $faker->unique()->word,
        'email' => $faker->unique()->safeEmail,
        'mobile' => $faker->unique()->mobileNumber,
        'address' => $faker->address,
        'email_verified_at' => now(),
        'password' => 'password', // password
        'remember_token' => Str::random(10),
    ];
});
