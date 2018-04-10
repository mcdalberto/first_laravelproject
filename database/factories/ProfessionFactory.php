<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Profession::class, function (Faker $faker) {
    return [
        //El componente Faker es una librería de PHP que genera datos de prueba por nosotros. Por ejemplo, podemos generar un nombre
        //En este caso genera oracione de 3 palabras
        'title'=>$faker->sentence(3,false)
    ];
});
