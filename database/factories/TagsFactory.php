<?php

namespace Database\Factories;

use App\Models\Categories;
use App\Models\Tags;
use Illuminate\Database\Eloquent\Factories\Factory;

class TagsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Tags::class;


    public function definition()
    {
        $className = Categories::class;
        return [
            'tag_type' => $className,
            'tag_id' => function() {
                return Categories::factory()->create()->id;
            },
            'tag_name' => $this->faker->sentence(5),
            'is_active' => 1,
        ];
    }
}
