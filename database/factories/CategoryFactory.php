<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Category::class;

    protected static $position = 0;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        self::$position++;

        return [
            'name' => $this->faker->name,
            'position' => self::$position
        ];
    }
}
