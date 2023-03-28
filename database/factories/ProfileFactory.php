<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profile>
 */
class ProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // $table->id();
        // $table->integer('user_id')->unique();
        // $table->string('name');
        // $table->string('profile_pic_path')->nullable();
        // $table->timestamps();
        return [
            'user_id' => User::factory(),
            'name' => $this->faker->name(),
            'profile_pic_path' => $this->faker->imageUrl($width = 640, $height = 480, 'avatar')
        ];
    }
}
