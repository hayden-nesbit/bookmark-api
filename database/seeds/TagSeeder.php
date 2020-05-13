<?php

use Illuminate\Database\Seeder;
use App\Tag;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Tag::create(['title' => 'want-to-read']);
        App\Tag::create(['title' => 'currently-reading']);
        App\Tag::create(['title' => 'read']);

    }
}

