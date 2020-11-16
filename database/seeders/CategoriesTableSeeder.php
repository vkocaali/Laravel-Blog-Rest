<?php

namespace Database\Seeders;

use App\Models\Categories;
use App\Models\Tags;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tags::factory(20)->create();
    }
}
