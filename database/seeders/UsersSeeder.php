<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UsersSeeder extends Seeder
{

    public function run(): void
    {



        User::factory()
            ->afterCreating(function (User $user) {
                $user->assignRole('admin');
            })
            ->create(['email' => 'test@test.fr']);

        User::factory()
            ->afterCreating(function (User $user) {
                $user->assignRole('user');
            })
            ->count(10)
            ->create();

    }
}
