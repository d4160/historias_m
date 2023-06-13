<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\OnlineResultController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('pacientes', [PatientController::class, 'index'])
    ->middleware(['auth', 'role'])->name('patients.all');

Route::get('pacientes/nuevo', [PatientController::class, 'create'])
    ->middleware(['auth', 'role'])->name('patients.create');

Route::post('pacientes/guardar', [PatientController::class, 'store'])
    ->middleware(['auth', 'role'])->name('patients.store');

Route::get('pacientes/{id}', [PatientController::class, 'edit'])
    ->middleware(['auth', 'role'])->name('patients.edit');

Route::post('pacientes/actualizar/{id}', [PatientController::class, 'update'])
    ->middleware(['auth', 'role'])->name('patients.update');

Route::post('pacientes/eliminar/{id}', [PatientController::class, 'destroy'])
    ->middleware(['auth', 'role'])->name('patients.destroy');

Route::post('resultados/guardar', [OnlineResultController::class, 'store'])
    ->middleware(['auth', 'role'])->name('results.store');

Route::post('resultados/actualizar/{id}', [OnlineResultController::class, 'update'])
    ->middleware(['auth', 'role'])->name('results.update');

Route::post('resultados/eliminar/{id}', [OnlineResultController::class, 'destroy'])
    ->middleware(['auth', 'role'])->name('results.destroy');

Route::get('resultados', [OnlineResultController::class, 'index'])
    ->middleware(['auth'])->name('results.all');

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
