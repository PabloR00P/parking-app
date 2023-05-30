<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
    protected $table = 'vehicles';
    protected $fillable = ['vehicle_number', 'entry_time', 'vehicle_type_id'];
}