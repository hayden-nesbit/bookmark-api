<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class)->create([
            'name' => 'Hayden Nesbit',
            'email' => 'hayden.nesbit@campusoutreach.org',
            'password' => bcrypt('sankey37')
        ]);
        factory(App\User::class, 50)->create();

    }
}
