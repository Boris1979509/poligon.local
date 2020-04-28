<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UsersTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $data = [
            'name'              => 'Boris',
            'email'             => 'bobabonanadz@mail.ru',
            'email_verified_at' => now(),
            'verify_token'      => null,
            'password'          => bcrypt('secret'),
            'remember_token'    => Str::random(10),
            'status'            => User::STATUS_ACTIVE,
            'role'              => User::ROLE_ADMIN,
            'created_at'        => now(),
            'updated_at'        => now(),
        ];
        DB::table('users')->insert($data);
        factory(User::class, 100)->create();
    }

}
