<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // factory(User::class, 10)->create()->each(function ($user) {
        //     $user->profile()->save(factory(Profile::class)->make());
        // });
        User::factory()
            ->count(10)
            ->create()
            ->each(function ($user) {
                $user->profile()->create();
            });
    }
}
