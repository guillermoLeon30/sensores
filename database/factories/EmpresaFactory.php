<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Empresa::class, function (Faker $faker) {
  return [
    'nombre'    =>  $faker->company,
    'direccion' =>  $faker->address,
    'documento' =>  $faker->randomNumber($nbDigits = 9)
  ];
});
