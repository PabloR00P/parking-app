<?php

namespace App\Http\Controllers;

use App\Models\OfficialVehicle;
use Illuminate\Http\Request;

class OfficialVehicleController extends Controller
{
    public function addOfficialVehicle(Request $request)
    {
        $vehicleNumber = $request->input('vehicle_number');
        
        $officialVehicle = new OfficialVehicle();
        $officialVehicle->vehicle_number = $vehicleNumber;
        $officialVehicle->save();
        
        return response()->json(['message' => 'Official vehicle added successfully']);
    }
}