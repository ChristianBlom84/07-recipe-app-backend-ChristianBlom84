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
        $recipeId = $request->get('recipe_id');
        $recipeName = $request->get('recipe_name');
        $user = JWTAuth::user();

        $addedRecipe = Recipe::create([
            'recipe_list_id' => $id,
            'recipe_id' => $recipeId,
            'recipe_name' => $recipeName
        ]);

        return response()->json(['added_recipe', $addedRecipe]);
    }

    public function deleteRecipeFromList($listId, $recipeId)
    {
        $user = JWTAuth::user();

        $deletedRecipe = Recipe::where('recipe_id', $recipeId)->where('recipe_list_id', $listId);
        $recipeList = RecipeList::find($listId);

        if ($recipeList->user_id == $user->id) {
            $deletedRecipe->delete();
        } elseif ($deletedRecipe->trashed()) {
            return response()->json('Recipe not found', 404);
        } else {
            return response()->json(['status' => 'Unauthorized'], 401);
        }

        return response()->json('deleted_recipe', 200);
    }
}
