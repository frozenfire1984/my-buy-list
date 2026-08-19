<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /*if (!User::where('email', 'test@example.com')->exists()) {
            User::factory()->create([
                'name'  => 'Test User John',
                'email' => 'test@example.com',
            ]);
        }*/

        /*$now_timestamp = time();
        $now = now()->format('d.m.Y H:i:s');

        User::firstOrCreate(
            ['email' => 'vasya+' . $now_timestamp .'@example.com'],
            [
                'name' => 'Вася ' .$now,
                'password' => 'password'
            ]
        );*/

        /*User::firstOrCreate(
            ['email' => 'ykononov1984@gmail.com'],
            [
                'name' => 'IURII KONONOV',
                'password' => 'passpass'
            ]
        );

        User::firstOrCreate(
            ['email' => 'ykononov1984+alex@gmail.com'],
            [
                'name' => 'Alex Ivanov',
                'password' => '12345678'
            ]
        );*/

        User::firstOrCreate(
            ['email' => 'john@example.com'],
            [
                'name' => 'john',
                'password' => 'password'
            ]
        );

        User::firstOrCreate(
            ['email' => 'alex@example.com'],
            [
                'name' => 'Alex Ivanov',
                'password' => 'password'
            ]
        );

        User::firstOrCreate(
            ['email' => 'vasya@example.com'],
            [
                'name' => 'Vasya',
                'password' => 'password'
            ]
        );

        User::firstOrCreate(
            ['email' => 'ykononov1984+super-admin@gmail.com'],
            [
                'name' => 'Super Admin',
                'password' => 'admin_pass12345',
                'is_super_admin' => 1,
            ]
        );

    }
}
