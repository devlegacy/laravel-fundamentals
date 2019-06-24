<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Entities\Sale;
use Faker\Generator as Faker;

$factory->define(Sale::class, function (Faker $faker) {
    $neto = $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 15000);
    $total = bcmul($neto, 1.16, 2);
    $iva = bcmul($neto, 0.16, 2);
    return [
      'date' => $faker->date($format = 'Y-m-d', $max = 'now'),
      'invoice' => $faker->numberBetween($min = 1000, $max = 9000),
      'neto' => $neto,
      'iva' => $iva,
      'total' => $total,
      'client_id' => function () {
          return App\Entities\Client::all()->random();
      },
    ];
});
// ? factory(App\Entities\Sale::class, 139974)->create();
