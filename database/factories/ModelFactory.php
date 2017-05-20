<?php

/*
|--------------------------------------------------------------------------
| shopping_mall Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your shopping_mall factories. shopping_mall factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default shopping_mall should look.
|
*/

$factory->define(shopping_mall\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});
