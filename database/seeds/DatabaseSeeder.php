<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        /**
         * Поочерёдное выполнение с помощью команды
         * php artisan db:seed
         */
        $this->call(UsersTableSeeder::class);
        //factory(App\Models\User::class, 10)->create();
        $this->call(BlogCategoriesTableSeeder::class);
        // Helper factory на создание постов в кол-ве 100 шт.
        factory(App\Models\Blog\BlogPost::class, 100)->create();
        $this->call(RegionsTableSeeder::class);
    }
}
