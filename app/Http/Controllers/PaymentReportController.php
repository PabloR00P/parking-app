<?php

namespace App\Http\Controllers;

use App\Models\Entry;
use App\Models\VehicleType;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PaymentReportController extends Controller
{
    public function generatePaymentReport(Request $request)
    {
        $filename = $request->input('filename');

        $vehicles = Entry::all();

        // Generar informe de pagos
        $reportData = $this->generateReportData($vehicles);

        $filePath = storage_path('app/public/' . $filename . '.txt');

        $fileContent = $this->generateReportContent($reportData);

        file_put_contents($filePath, $fileContent);

        return response()->download($filePath, $filename . '.txt', ['Content-Type' => 'text/plain']);
    }

    public function getPaymentReportData(Request $request)
    {
        $vehicles = Entry::all();

        $reportData = $this->generateReportData($vehicles);

        return response()->json($reportData);
    }
    
    private function generateReportData($vehicles)
    {
        $reportData = [];

        foreach ($vehicles as $vehicle) {
            $vehicleType = VehicleType::find($vehicle->vehicle_type_id);

            if (!$vehicleType) {
                continue;
            }

            $vehicleTypeName = $vehicleType->name;

            if ($vehicleTypeName === 'Residente') {
                $parkingDuration = $this->calculateParkingDuration($vehicle);
                $amountToPay = $this->calculateAmountToPay($vehicle);

                $reportData[] = [
                    'vehicle_number' => $vehicle->vehicle_number,
                    'parking_duration' => $parkingDuration,
                    'amount_to_pay' => $amountToPay
                ];
            }
        }

        return $reportData;
    }
    
    private function calculateParkingDuration($vehicle)
    {
        $entryTime = Carbon::parse($vehicle->entry_time);

        $exitTime = $vehicle->exit_time ? Carbon::parse($vehicle->exit_time) : Carbon::now();

        $diffInMinutes = $exitTime->diffInMinutes($entryTime);

        return $diffInMinutes;
    }
    
    private function calculateAmountToPay($vehicle)
    {
        $vehicleType = VehicleType::find($vehicle->vehicle_type_id);

        if (!$vehicleType) {
            return 0;
        }

        $vehicleTypeName = $vehicleType->name;

        if ($vehicleTypeName === 'Oficial') {
            return 0;
        } elseif ($vehicleTypeName === 'Residente') {
            return $vehicleType->payment_per_minute * $this->calculateParkingDuration($vehicle);
        } else {
            return $vehicleType->payment_per_minute * $this->calculateParkingDuration($vehicle);
        }
    }
    
    private function generateReportContent($reportData)
    {
        $fileContent = "Núm. Placa\tTiempo Estacionado (min)\tCantidad a Pagar ($)" . PHP_EOL;

        foreach ($reportData as $data) {
            $fileContent .= sprintf(
                "%-15s\t%-25s\t%-15s",
                $data['vehicle_number'],
                $data['parking_duration'],
                $data['amount_to_pay']
            );
            $fileContent .= PHP_EOL;
        }

        return $fileContent;
    }
}