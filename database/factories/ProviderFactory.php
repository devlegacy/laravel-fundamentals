<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Entities\Provider;
use Faker\Generator as Faker;

$factory->define(Provider::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
    ];
});
// ? factory(App\Entities\Provider::class, 213)->create();
