<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResidentVehicle extends Model
{
    protected $table = "resident_vehicles";
    protected $fillable = ['vehicle_number'];
}