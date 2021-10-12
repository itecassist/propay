<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' =>$faker->email,
        'sa_id' =>$faker->randomNumber(),
        'mobile_number'=>$faker->phoneNumber,
        'date_of_birth'=>$faker->date('Y-m-d'),
        'language' => ,
        'interests' =>
    ];
});
