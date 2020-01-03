<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\BlogPost;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
  |--------------------------------------------------------------------------
  | Model Factories
  |--------------------------------------------------------------------------
  |
  | This directory should contain each of the model factory definitions for
  | your application. Factories provide a convenient way to generate new
  | model instances for testing / seeding your application's database.
  |
 */

$factory->define(BlogPost::class, function (Faker $faker) {
    $title = $faker->sentence(rand(3, 8), true); // sentence предложение от 3 до 8 символов
    $txt = $faker->realText(rand(1000, 4000));
    $isPublished = (rand(1, 5) > 1) ? TRUE : FALSE; // rand -- Генерирует случайное число min : max
    $createdAt = $faker->dateTimeBetween('-2 month', '-1 days');
    $data = [
        'category_id' => rand(1, 11),
        'user_id' => (rand(1, 5) == 5) ? 1 : 2,
        'title' => $title,
        'slug' => Str::slug($title),
        'excerpt' => $faker->text(rand(40, 100)),
        'content_raw' => $txt,
        'content_html' => $txt,
        'is_published' => $isPublished,
        'published_at' => $isPublished ? $faker->dateTimeBetween('-2 month', '-1 days') : null,
        'created_at' => $createdAt,
        'updated_at' => $createdAt,
    ];
    return $data;
});
