<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 50)->create();

        DB::table('user_tags')
            ->insert(
                ['title' => "want-to-read",
                 'user_id' => 1
                ]);
        DB::table('user_tags')
            ->insert(
                ['title' => "currently-reading",
                 'user_id' => 1
                ]);
        DB::table('user_tags')
            ->insert(
                ['title' => "read",
                 'user_id' => 1
                ]);
    }
}
