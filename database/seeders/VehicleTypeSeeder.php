<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\VehicleType;

class VehicleTypeSeeder extends Seeder
{
    public function run()
    {
        // Agregar registros por defecto
        VehicleType::create([
            'name' => 'Oficial',
            'payment_per_minute' => 0.00
        ]);

        VehicleType::create([
            'name' => 'Residente',
            'payment_per_minute' => 0.05
        ]);

        VehicleType::create([
            'name' => 'No Residente',
            'payment_per_minute' => 0.50
        ]);
    }
}