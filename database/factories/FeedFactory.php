
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

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Feed::class, function (Faker\Generator $faker) {
    return [
        'url' => $faker->sentence,
        'description' => "<p>".implode("</p>\n\n<p>", $faker->paragraphs(rand(3,6)))."</p>",
        'author' => $faker->name,
    ];
}

);
