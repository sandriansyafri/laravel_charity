<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory(5)->create();
        $user = User::first();
        $user->name = 'Administrator';
        $user->username = 'administrator';
        $user->email = 'admin@gmail.com';
        $user->role_id = 1;
        $user->save();
    }
}
