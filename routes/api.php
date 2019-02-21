<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', 'UserController@register');
Route::post('login', 'UserController@login')->middleware('cors');
Route::get('open', 'DataController@open');

Route::group(['middleware' => ['jwt.verify', 'cors']], function () {
    Route::get('user', 'UserController@getAuthenticatedUser');
    Route::get('closed', 'DataController@closed');
    
    Route::get('recipe_lists', 'RecipeListsController@getListsForUser');
    Route::get('recipe_lists/{id}', 'RecipeListsController@getList');
    Route::put('recipe_lists/{id}', 'RecipeListsController@updateListName');
    Route::post('recipe_lists', 'RecipeListsController@createList');
    Route::delete('recipe_lists/{id}', 'RecipeListsController@deleteList');

    Route::post('recipe_lists/{id}', 'RecipeController@addRecipeToList');
});
