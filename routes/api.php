<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EntryController;
use App\Http\Controllers\ExitController;
use App\Http\Controllers\OfficialVehicleController;
use App\Http\Controllers\VehicleTypeController;
use App\Http\Controllers\ResidentVehicleController;
use App\Http\Controllers\PaymentReportController;
use App\Http\Controllers\StartMonthController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register-entry', [EntryController::class, 'registerEntry']);

Route::post('/register-exit', [ExitController::class, 'registerExit']);

Route::post('/add-official-vehicle', [OfficialVehicleController::class, 'addOfficialVehicle']);

Route::post('/add-resident-vehicle', [ResidentVehicleController::class, 'addResidentVehicle']);

Route::get('/generate-payment-report', [PaymentReportController::class, 'generatePaymentReport']);

Route::get('/generate-payment-data', [PaymentReportController::class, 'getPaymentReportData']);

Route::get('/vehicle-types', [VehicleTypeController::class, 'index']);

Route::get('/start-month', [StartMonthController::class, 'startMonth']);

