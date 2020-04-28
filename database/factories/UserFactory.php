<?php


use App\Models\User;
use Faker\Generator as Faker; // Generator Список доступный фэйковых начений
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\Str;

/**
 * @var Factory $factory
 */

$factory->define(User::class, static function (Faker $faker) {
    $active = $faker->boolean;
    return [
        'name'              => $faker->name,
        'email'             => $faker->unique()->safeEmail,
        'email_verified_at' => $active ? now() : null,
        'verify_token'      => $active ? null : Str::uuid(),
        'password'          => bcrypt(Str::random()),
        'remember_token'    => Str::random(10),
        'status'            => !$active ? User::STATUS_WAIT : User::STATUS_ACTIVE,
        'role'              => User::ROLE_USER,
    ];
});
