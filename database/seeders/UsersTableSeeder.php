<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::create([
            'name' => 'Administrator',
            'username' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin')
        ]);
    }
}
