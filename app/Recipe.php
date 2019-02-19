<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    protected $keyType = string;
    public $incrementing = false;
    public $timestamps = false;
}
