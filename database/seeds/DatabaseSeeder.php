<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $this->call(UsersTableSeeder::class);
         $this->call(ChannelsTableSeeder::class);

         factory(App\Discussion::class, 100)->create();
         factory(App\Reply::class, 1000)->create();
    }
}
