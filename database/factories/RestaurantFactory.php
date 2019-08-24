<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Restaurant;
use Faker\Generator as Faker;

$factory->define(Restaurant::class, function (Faker $faker) {
    return [
            'district_id' =>$faker->randomDigit ,
			'category_id'=> $faker->randomDigit ,
			'image'=> $faker->company ,
			'name'=>  $faker->name,
			'minimum_charge'=> '100',
			'delivery'=> '15',
			'phone'=>  $faker->phoneNumber,
			'whatsapp'=> $faker->phoneNumber,
			'email'=> $faker->unique()->safeEmail,
			'password'=>'123456',
			'status'=> '1',
			'activated'=> '1',
			'api_token'=>Str::random(10),
    ];
});
