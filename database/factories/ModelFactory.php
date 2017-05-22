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

$channels_ids = App\Channel::query()->pluck('id')->all();
$users_ids = App\User::query()->pluck('id')->all();

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

$factory->define(App\Discussion::class, function(Faker\Generator $faker) use ($channels_ids, $users_ids) {
   $title = $faker->sentence;
   $channel_key = array_rand($channels_ids);
   $user_key = array_rand($users_ids);

   echo "[Discussion] channel: $channel_key, user: $user_key\n";

   return [
       'title' => $title,
       'slug' => str_slug($title),
       'content' => $faker->paragraph(random_int(30, 100)),
       'channel_id' => $channels_ids[$channel_key],
       'user_id' => $users_ids[$user_key]
   ];
});

$discussions_ids = App\Discussion::query()->pluck('id')->all();

$factory->define(App\Reply::class, function(Faker\Generator $faker) use ($discussions_ids, $users_ids) {
    $discussions_ids = $discussions_ids ? $discussions_ids : App\Discussion::query()->pluck('id')->all();
   $discussion_key = array_rand($discussions_ids);
   $user_key = array_rand($users_ids);

    echo "[Reply] discussion: $discussion_key, user: $user_key\n";

   return [
       'content' => $faker->paragraph(random_int(3, 10)),
       'discussion_id' => $discussions_ids[$discussion_key],
       'user_id' => $users_ids[$user_key]
   ];
});