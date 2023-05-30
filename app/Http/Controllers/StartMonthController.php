<?php

namespace App\Http\Controllers;

use App\Models\Entry;
use App\Models\VehicleType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\OfficialVehicle;

class StartMonthController extends Controller
{
    public function startMonth(Request $request)
    {
        $this->deleteOfficialEntries();
        $this->resetResidentParkingDuration();

        return response()->json(['message' => 'Se ha iniciado el mes correctamente']);
    }

    private function deleteOfficialEntries()
    {
        OfficialVehicle::truncate();
    }

    private function resetResidentParkingDuration()
    {
        $residentVehicleType = VehicleType::where('name', 'Residente')->first();
        Entry::where('vehicle_type_id', $residentVehicleType->id)->update(['entry_time' => Carbon::now()]);
    }
}
