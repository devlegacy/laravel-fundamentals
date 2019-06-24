<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Entities\Client;
use Faker\Generator as Faker;

$factory->define(Client::class, function (Faker $faker) {
    $swiftBicNumber = $faker->unique()->swiftBicNumber;

    return [
        'name' => $faker->name,
        'rfc' => $swiftBicNumber,
        'email' =>  $faker->unique()->email,
        'status' => $faker->randomElement($array = ['a','b','c']),
        'gob_doc' => $swiftBicNumber,
        'country_id' => 0,
        'province_id' => 0,
        'location_id' => 0,
    ];
});
// ? factory(App\Entities\Client::class, 2418)->create();
