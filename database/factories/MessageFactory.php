<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Entities\Message;
use App\User;
use Faker\Generator as Faker;

$factory->define(Message::class, function (Faker $faker) {
    $random = $faker->numberBetween(1, 5);
    if ($random == 2 || $random == 4) {
        return [
          'subject' => $faker->sentence($faker->numberBetween(3, 5)),
          'content' => $faker->text,
          'user_id' => function () {
              return User::all()->random();
          },
        ];
    }
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'subject' => $faker->sentence($faker->numberBetween(3, 5)),
        'content' => $faker->text,
    ];
});
