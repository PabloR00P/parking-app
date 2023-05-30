<?php

namespace App\Http\Controllers;

use App\Models\ResidentVehicle;
use Illuminate\Http\Request;

class ResidentVehicleController extends Controller
{
    public function addResidentVehicle(Request $request)
    {
        $vehicleNumber = $request->input('vehicle_number');
        
        $residentVehicle = new ResidentVehicle();
        $residentVehicle->vehicle_number = $vehicleNumber;
        $residentVehicle->save();
        
        return response()->json(['message' => 'Resident vehicle added successfully']);
    }
}