<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Users::class, function (Faker $faker) {
  $firstName = $faker->unique()->firstName;
  $lastName = $faker->unique()->lastName;
    return [
        //
        'first_name' => $firstName,
        'last_name' => $lastName,
        'email' => "$firstName.$lastName@mailinator.com",
        'username' => "$firstName.$lastName",
        'password' => Hash::make('password'),
        'status' => 1
    ];
});
