<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RecipeListsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('recipe_lists')->insert([
            ['title' => 'Sunday Dinner', 'user_id' => 1],
            ['title' => 'Birthday party', 'user_id' => 1],
            ['title' => 'Monday Dinner', 'user_id' => 2]
        ]);
    }
}
