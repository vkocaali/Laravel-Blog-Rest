<?php

namespace Database\Factories;

use App\Models\Categories;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoriesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Categories::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $rank = Categories::all()->max('rank');
        $name = $this->faker->sentence(5);
        return [
            'name' => $name,
            'description' => $this->faker->realText(rand(80, 500)),
            'content' => $this->faker->text,
            'slug' => Str::slug($name),
            'parent' => 0,
            'is_active' => 1,
            'rank' => is_null($rank) ? 1 : $rank + 1,
        ];
    }
}
