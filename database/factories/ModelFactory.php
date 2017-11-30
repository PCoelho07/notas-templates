<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name'           => $faker->name,
        'email'          => $faker->unique()->safeEmail,
        'username'       => $faker->word,
        'password'       => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Client::class, function (Faker\Generator $faker) {
    return [
        'name'            => $faker->name,
        'gender'          => $faker->boolean(),
        'status_cpfcnpj'  => $faker->randomDigit([0, 1]),
        'street_name'     => $faker->streetName,
        'building_number' => $faker->randomDigit,
        'city'            => $faker->city,
        'state'           => $faker->word(2),
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Client\Role::class, function (Faker\Generator $faker) {
    return [
        'type' => $faker->word,
        'description' => $faker->sentence,
    ];
});