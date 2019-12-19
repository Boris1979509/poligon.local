<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        /**
         * Поочерёдное выполнение с помощбю команды
         * php artisan db:seed
         */
        $this->call(UsersTableSeeder::class);
        $this->call(BlogCategoriesTableSeeder::class);
        // Helper factory на создание постов в кол-ве 100 шт.
        factory(App\Models\BlogPost::class, 100)->create();
    }
}
