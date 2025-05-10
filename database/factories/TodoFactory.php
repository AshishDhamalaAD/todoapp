<?php

namespace Database\Factories;

use App\Models\Todo;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Todo>
 */
class TodoFactory extends Factory
{
    protected $model = Todo::class;

    public function definition(): array
    {
        // 80% of todos get a due date between one week ago and one month from now
        $dueAt = fake()
            ->optional(0.8)
            ->dateTimeBetween('-1 week', '+1 month');

        return [
            'user_id' => User::factory(),
            'title' => fake()->sentence(4),
            'description' => fake()->optional()->paragraph(),
            'due_at' => $dueAt,
            'reminder_at' => $dueAt
                ? fake()->dateTimeBetween('-1 week', $dueAt)
                : null,
            'is_completed' => fake()->boolean(20),
            'is_reminder_sent' => false,
        ];
    }
}
