<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Entities\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'detail' => $faker->paragraph,
        'color' => $faker->hexcolor,
        'status' => $faker->numberBetween(0, 1),
        'price' => $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 900),// 48.8932 //numberBetween(100, 1000),
        'stock' => $faker->randomDigit,
        'discount' => $faker->numberBetween(2, 30), // Percentage
        // 'user_id' => function () {
        //     return App\User::all()->random();
        // }
        'provider_id' => function () {
            return App\Entities\Provider::all()->random();
        }
    ];
});
// ? factory(App\Entities\Product::class, 6989)->create();
