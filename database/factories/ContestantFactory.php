<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contestant>
 */
class ContestantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'discord_id' => $this->faker->unique()->numerify('##################'),
            'username' => $this->faker->userName(),
            'nickname' => sprintf(
                '%s %s',
                $this->faker->colorName(),
                $this->faker->word()
            ),
        ];
    }
}
