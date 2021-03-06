<?php

namespace App\Http\Controllers;

use App\RecipeList;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class RecipeListsController extends Controller
{
    public function getListsForUser(Request $request)
    {
        $user = JWTAuth::user();
        $recipeLists = RecipeList::where('user_id', '=', $user->id)->get();
        
        return response()->json($recipeLists);
    }

    public function getList($id)
    {
        $recipeList = RecipeList::find($id);
        $recipeList->recipes;

        if ($recipeList->user_id == JWTAuth::user()->id) {
            return response()->json($recipeList);
        } else {
            return response()->json(['status' => 'Unauthorized'], 401);
        }
    }

    public function createList(Request $request)
    {
        if (empty($request->get('title'))) {
            return new JsonResponse(
                ['error' => 'No title specified.'],
                JsonResponse::HTTP_BAD_REQUEST
            );
        }

        $newList = RecipeList::create([
            'title' => $request->title,
            'user_id' => JWTAuth::user()->id
        ]);

        return response()->json(['created_list', $newList]);
    }

    public function updateListName(Request $request, $id)
    {
        $input = $request->all();
        $list = RecipeList::find($id);
        $list->update(['title' => $request->get('title')]);

        return response()->json(['updated_list', $list]);
    }

    public function deleteList(Request $request, $id)
    {
        $list = RecipeList::find($id);

        if (JWTAuth::user()->id === $list->user_id) {
            $list->delete();
            return response()->json(['deleted_list', $list]);
        } else {
            return response()->json(['status' => 'Unauthorized'], 401);
        }
    }
}
