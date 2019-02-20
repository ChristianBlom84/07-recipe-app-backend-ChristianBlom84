<?php

use Illuminate\Database\Seeder;

class RecipesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('recipes')->insert([
            [
                'recipe_list_id' => 1,
                'recipe_id' => 'Cheese-_-Sausage-Wontons-2639332',
                'recipe_name' => 'Cheese & Sausage Wontons'
            ],
            [
                'recipe_list_id' => 1,
                'recipe_id' => 'Falafal-2236573',
                'recipe_name' => 'Falafal'
            ]
        ]);
    }
}
