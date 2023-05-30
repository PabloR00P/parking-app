<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OfficialVehicle extends Model
{
    protected $table = "official_vehicles";
    protected $fillable = ['vehicle_number'];
}