<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Descriptors extends Model
{
    protected $fillable = ['idDescriptor', 'class', 'subject', 'description'];
}
