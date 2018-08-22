<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categroy extends Model
{
    protected $table = 'categroys';

    protected $fillable = ['name', 'description'];
}
