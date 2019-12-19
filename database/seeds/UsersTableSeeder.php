<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $data = [
            [
                'name' => 'Автор не известен',
                'email' => 'author_unknown@mail.ru',
                'password' => Str::random(16),
            ],
            [
                'name' => 'Автор',
                'email' => 'author@mail.ru',
                'password' => bcrypt('root'),
            ],
        ];
        DB::table('users')->insert($data);
    }

}
