<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */
use Illuminate\Support\Str;
use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
            'restaurant_id'=>$faker->randomDigit,
			'image'=>$faker->numberBetween(50,1000).'.jpg',
			'name'=>'product name'.$faker->numberBetween(50,1000),
			'description'=> 'meal desc'.$faker->numberBetween(50,1000),
			'prep_time'=>2000,
			'price'=>$faker->numberBetween(50,100),
			'discount_price' =>0,
    ];
});
