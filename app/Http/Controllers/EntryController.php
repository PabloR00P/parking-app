<?php

namespace App\Http\Controllers;

use App\Models\Entry;
use Illuminate\Http\Request;
use App\Models\VehicleType;
use App\Models\OfficialVehicle;
use App\Models\ResidentVehicle;

class EntryController extends Controller
{
    public function registerEntry(Request $request)
    {
        $vehicleNumber = $request->input('vehicle_number');

        $officialVehicle = OfficialVehicle::where('vehicle_number', $vehicleNumber)->first();

        $residentVehicle = ResidentVehicle::where('vehicle_number', $vehicleNumber)->first();

        $entry = new Entry();
        

        $entry->vehicle_number = $vehicleNumber;
        $entry->entry_time = now();

        if ($officialVehicle) {
            $officialVehicleType = VehicleType::where('name', 'Oficial')->first();
            
            if ($officialVehicleType) {
                $entry->vehicle_type_id = $officialVehicleType->id;
            } else {
                $defaultVehicleTypeId = 1;
                $entry->vehicle_type_id = $defaultVehicleTypeId;
            }
        } elseif ($residentVehicle) {
            $nonResidentVehicleType = VehicleType::where('name', 'Residente')->first();
            
            if ($nonResidentVehicleType) {
                $entry->vehicle_type_id = $nonResidentVehicleType->id;
            } else {
                $defaultVehicleTypeId = 1;
                $entry->vehicle_type_id = $defaultVehicleTypeId;
            }
        } else {
            $defaultVehicleTypeName = 'No Residente';
            
            $defaultVehicleType = VehicleType::where('name', $defaultVehicleTypeName)->first();

            if ($defaultVehicleType) {
                $entry->vehicle_type_id = $defaultVehicleType->id;
            } else {
                $defaultVehicleTypeId = 1;
                $entry->vehicle_type_id = $defaultVehicleTypeId;
            }
        }
        $entry->save();

        return response()->json(['message' => 'Entrada registrada']);
    }

}