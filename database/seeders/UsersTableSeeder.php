<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Create admin role if not exists
        Role::findOrCreate('admin', 'web');

        // Create admin users and assign the admin role
        $admin1 = User::create([
            'username' => 'admin',
            'firstname' => 'Sasho',
            'lastname' => 'Ristevski',
            'email' => 'admin@mail.com',
            'password' => bcrypt('password')
        ]);
        $admin1->assignRole('admin');

//        // Create regular users
//        $user1 = User::create([
//            'name' => 'User 1',
//            'email' => 'user1@example.com',
//            'password' => bcrypt('password'),
//        ]);
    }
}
