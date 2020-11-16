<?php

namespace Database\Factories;

use App\Models\Settings;
use Illuminate\Database\Eloquent\Factories\Factory;

class SettingsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Settings::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'site_name' => $this->faker->jobTitle,
            'site_description' => $this->faker->realText(15),
            'site_verification' => 'Test',
            'first_last_name' => $this->faker->firstName,
            'email_adress' => $this->faker->email,
            'job_title' => $this->faker->jobTitle,
            'profile_image' => $this->faker->imageUrl(),
            'site_active' => 1,
            'site_linkedin' => $this->faker->url,
            'site_instagram' => $this->faker->url,
            'site_github' => $this->faker->url,
        ];
    }
}
