<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExitRecord extends Model
{
    protected $table = 'vehicles';
    protected $fillable = ['exit_time'];
}