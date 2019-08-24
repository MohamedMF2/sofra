<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Offer;
use Faker\Generator as Faker;

$factory->define(Offer::class, function (Faker $faker) {
    return [
        'name' => 'summer offer',
        'description'=>' get a'.$faker->numberBetween(5,25).'% for your first order' ,     
        'image'=>$faker->numberBetween(1,1200).'image.jpg' ,        
        'restaurant_id'=>  1               ,              //$faker->numberBetween(1,10) ,        
        'start'=>$faker->dateTimeThisMonth,        
        'end'=>$faker->dateTimeThisMonth,        
   
    ];
});
