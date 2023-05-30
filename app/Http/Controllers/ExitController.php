<?php

namespace App\Http\Controllers;

use App\Models\Entry;
use Illuminate\Http\Request;

class ExitController extends Controller
{
    public function registerExit(Request $request)
    {
        $vehicleNumber = $request->input('vehicle_number');

        $entry = Entry::where('vehicle_number', $vehicleNumber)->latest()->first();

        if ($entry) {
            $entry->exit_time = now();
            $entry->save();

            return response()->json(['message' => 'Exit registered successfully']);
        } else {
            return response()->json(['message' => 'Vehicle entry not found'], 404);
        }
    }
}