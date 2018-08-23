<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as EloquentModel;

class Categroy extends EloquentModel
{
    protected $table = 'categroys';

    protected $fillable = ['name', 'description'];
}
