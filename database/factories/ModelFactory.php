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
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Discussion::class, function(Faker\Generator $faker) {
   $title = $faker->sentence;
   $channels_ids = App\Channel::query()->pluck('id')->all();
   $users_ids = App\User::query()->pluck('id')->all();

   return [
       'title' => $title,
       'slug' => str_slug($title),
       'content' => $faker->paragraph(random_int(30, 100)),
       'channel_id' => array_rand($channels_ids),
       'user_id' => array_rand($users_ids)
   ];
});

$factory->define(App\Reply::class, function(Faker\Generator $faker) {
   $discussions_ids = App\Discussion::query()->pluck('id')->all();
   $users_ids = App\User::query()->pluck('id')->all();

   return [
       'content' => $faker->paragraph(random_int(3, 10)),
       'user_id' => array_rand($users_ids),
       'discussion_id' => array_rand($discussions_ids)
   ];
});