<?php

namespace Database\Factories;

use App\Models\Event;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    protected $model = Event::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $startAt = CarbonImmutable::instance($this->faker->dateTimeBetween('-1 months', '+1 months'));
        $endAt   = $startAt->addDays(rand(1, 14));

        return [
            'id'        => $this->faker->uuid(),
            'name'      => $this->faker->name(),
            'slug'      => $this->faker->unique()->slug(),
            'startAt'   => $startAt->toDateTimeString(),
            'endAt'     => $endAt->toDateTimeString(),
            'createdAt' => now()->toDateTimeString(),
            'updatedAt' => now()->toDateTimeString(),
        ];
    }
}
