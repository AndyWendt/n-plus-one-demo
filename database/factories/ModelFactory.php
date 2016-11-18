<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$idRetriever = (new \App\Helpers\IdRetriever());

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(\App\Publisher\Publisher::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->company,
    ];
});

$factory->define(\App\Author\Author::class, function (Faker\Generator $faker) use ($idRetriever) {
    return [
        'name' => $faker->name,
        'publisher_id' => $idRetriever->randomModelId(\App\Publisher\Publisher::class, 1),
    ];
});

$factory->define(\App\Book\Book::class, function (Faker\Generator $faker) use ($idRetriever) {
    return [
        'name' => $faker->words(3, true),
        'author_id' => $idRetriever->randomModelId(\App\Author\Author::class),
    ];
});

$factory->define(\App\Chapter\Chapter::class, function (Faker\Generator $faker) use ($idRetriever) {
    return [
        'name' => $faker->name,
        'text' => $faker->paragraphs(3, true),
        'book_id' => $idRetriever->randomModelId(\App\Book\Book::class),
    ];
});
