<?php

namespace Database\Factories;

use App\Models\Menu;
use Illuminate\Database\Eloquent\Factories\Factory;

class MenuFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Menu::class;

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
            'category_id' => rand(1, 5),
            'description' => $this->faker->text,
            'price' => rand(1000, 20000),
            'photo' => null,
            'position' => self::$position
        ];
    }
}
