<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'recipe_list_id', 'recipe_id', 'recipe_name'
    ];

    public function recipeLists()
    {
        return $this->belongsTo('App\RecipeList');
    }
}
