<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Message::class, function (Faker $faker) {
    return [
        'subject' => $faker->sentence(6),
        'user_id' => function () {
            return factory(App\Models\User::class)->create()->id;
        }
    ];
});
