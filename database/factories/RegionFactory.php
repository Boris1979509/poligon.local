<?php

use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;
use App\Models\Adverts\Region;
use Illuminate\Support\Str;

/**
 * @param Faker $fake
 * @return array
 */
function getFaker(Faker $faker)
{
    return [
        'name'      => $name = $faker->unique()->city,
        'slug'      => Str::slug($name),
        'parent_id' => null,
    ];
}

/**
 * @var Factory $factory
 */
$factory->define(Region::class, 'getFaker');
