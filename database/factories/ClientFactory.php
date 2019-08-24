<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Client;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Client::class, function (Faker $faker) {
    return [
        'district_id'=> $faker->randomDigit ,
        'name'=> $faker->name,
        'email'=> $faker->unique()->safeEmail,
        'password'=> '123456',
        'phone'=> $faker->phoneNumber,
        'api_token'=>Str::random(10),
    ];
});
