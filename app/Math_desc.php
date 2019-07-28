<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Math_desc extends Model
{
    protected $fillable = ['idDescriptor', 'subject', 'class', 'description'];
}
