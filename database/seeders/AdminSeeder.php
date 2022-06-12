<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new User([
            'name'              => 'Mohannad',
            'email'             => 'mohanned.fds@gmail.com',
            'email_verified_at' => now(),
            'role'              => 'admin',
            'password'          => Hash::make('123456789'),
            'remember_token'    => Str::random(10),
        ]);

        $admin->save();
    }
}
