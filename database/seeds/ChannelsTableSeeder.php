<?php

use App\Channel;
use Illuminate\Database\Seeder;

class ChannelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$channels = ['Laravel', 'Vuejs', 'CSS', 'Javascript', 'PHP', 'Spark', 'Lumen', 'Forge'];

    	foreach($channels as $channel) {
    		Channel::create(['title' => $channel]);
    	}
    }
}
