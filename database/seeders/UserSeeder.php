<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = collect([
            [
                'name' => 'Super Admin',
                'email' => 'sangkips19@gmail.com',
                'email_verified_at' => now(),
                'password' => bcrypt('Sang@123%'),
                'created_at' => now(),
                'uuid' => Str::uuid(),
                'photo' => 'admin.jpg'
            ],
            [
                'name' => 'Admin',
                'email' => 'nextgentips01@gmail.com',
                'email_verified_at' => now(),
                'password' => bcrypt('Sang@123%'),
                'created_at' => now(),
                'uuid' => Str::uuid(),
                'photo' => 'admin.jpg'
            ],
            [
                'name' => 'staff',
                'email' => 'quest@quest.com',
                'email_verified_at' => now(),
                'password' => bcrypt('Sang@123%'),
                'created_at' => now(),
                'uuid' => Str::uuid(),
                'photo' => 'admin.jpg'
            ],
            [
                'name' => 'user',
                'email' => 'user@email.com',
                'email_verified_at' => now(),
                'password' => bcrypt('Sang@123%'),
                'created_at' => now(),
                'uuid' => Str::uuid(),
                'photo' => 'admin.jpg'
            ]
        ]);

        $users->each(function ($user) {
            User::insert($user);
        });
    }
}
