<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\User::create([
            'name' => env('ADMIN_USER'),
            'email' => env('ADMIN_EMAIL'),
            'password' => bcrypt(env('ADMIN_PASSWORD')),
            'admin' => 1,
            'avatar' => '/avatars/default.jpg'
        ]);

        App\user::create([
            'name' => 'João Fernandes',
            'email' => 'joaofnds@forum.com',
            'password' => bcrypt('FooBarB4z'),
            'avatar' => '/avatars/default.jpg'
        ]);
    }
}
