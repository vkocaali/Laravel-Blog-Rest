<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(5)->create();
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('settings')->truncate();
        DB::table('categories')->truncate();
        DB::table('articles')->truncate();
        DB::table('tags')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        //$this->call(CategoriesTableSeeder::class);
        $this->call(SettingsTableSeeder::class);
    }
}
