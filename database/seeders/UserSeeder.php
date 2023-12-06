<?php

namespace Database\Seeders;
use App\Models\User;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superadmin = User::create([
            'username' => 'fachrel',
            'email' => 'superadmin@email.com',
            'name' => 'fachrel razka pramudya',
            'password' => Hash::make('fachrelrazkagg@79'),
        ]);

        $user = User::create([
            'username' => 'admin',
            'email' => 'admin@email.com',
            'name' => 'admin',
            'password' => Hash::make('admin'),
        ]);

        $admin = User::create([
            'username' => 'user',
            'email' => 'user@email.com',
            'name' => 'user',
            'password' => Hash::make('user'),
        ]);

        $contributor = User::create([
            'username' => 'contributor',
            'email' => 'contributor@email.com',
            'name' => 'contributor',
            
            'password' => Hash::make('contributor'),
        ]);
    }
}
