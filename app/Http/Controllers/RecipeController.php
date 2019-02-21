<?php

namespace App\Http\Controllers;

use App\Recipe;
use App\RecipeList;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class RecipeController extends Controller
{
    public function addRecipeToList(Request $request, $id)
    {
        $recipe_id = $request->get('recipe_id');
        $recipe_name = $request->get('recipe_name');
        $user = JWTAuth::user();

        $addedRecipe = Recipe::create([
            'recipe_list_id' => $id,
            'recipe_id' => $recipe_id,
            'recipe_name' => $recipe_name
        ]);

        return response()->json(['added_recipe', $addedRecipe]);
    }
}
