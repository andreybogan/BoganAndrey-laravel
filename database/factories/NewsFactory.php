<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Factory;
use App\Model\News;

$factory->define(News::class, function () {

    $faker = Factory::create('ru_RU');

    return [
        'title' => $faker->realText(rand(30,80)),
        'text' => $faker->realText(rand(1000,5000)),
        'private' => false,
        'category_id' => (int)rand(1, 4),
    ];
});
