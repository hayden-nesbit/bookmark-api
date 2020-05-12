<?php

use Illuminate\Database\Seeder;

class UserTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\UserTag::create(['title' => 'want-to-read']);
        App\UserTag::create(['title' => 'currently-reading']);
        App\UserTag::create(['title' => 'read']);

    }
}

