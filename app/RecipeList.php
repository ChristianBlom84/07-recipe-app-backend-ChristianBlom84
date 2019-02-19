<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RecipeList extends Model
{
    protected $fillable = [
        'title', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function recipes()
    {
        return $this->hasMany('App\Recipe');
    }
}
