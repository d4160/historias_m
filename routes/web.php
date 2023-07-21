<?php

use App\Http\Controllers\AntecedenteController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClinicStoryController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\DiagnosticoController;
use App\Http\Controllers\EnfermedadActualController;
use App\Http\Controllers\ExamenAuxiliarController;
use App\Http\Controllers\ExamenController;
use App\Http\Controllers\KardexController;
use App\Http\Controllers\TratamientoController;
use App\Http\Controllers\TratamientoDetalleController;

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

// Pacientes
Route::get('pacientes', [PatientController::class, 'index'])
    ->middleware(['auth', 'role'])->name('patients.all');

Route::get('pacientes/nuevo', [PatientController::class, 'create'])
    ->middleware(['auth', 'role'])->name('patients.create');

Route::post('pacientes/guardar', [PatientController::class, 'store'])
    ->middleware(['auth', 'role'])->name('patients.store');

Route::get('pacientes/{id}/{notification?}', [PatientController::class, 'edit'])
    ->middleware(['auth', 'role'])->name('patients.edit');

Route::post('pacientes/actualizar/{id}', [PatientController::class, 'update'])
    ->middleware(['auth', 'role'])->name('patients.update');

Route::post('pacientes/actualizar2/{id}', [PatientController::class, 'update2'])
    ->middleware(['auth', 'role'])->name('patients.update2');

Route::post('pacientes/eliminar/{id}', [PatientController::class, 'destroy'])
    ->middleware(['auth', 'role'])->name('patients.destroy');

Route::post('pacientes/importar', [PatientController::class, 'import'])
    ->middleware(['auth', 'role'])->name('patients.import');

// Administradores
Route::get('admins', [AdminController::class, 'index'])
    ->middleware(['auth', 'role'])->name('admins.all');

Route::get('admins/nuevo', [AdminController::class, 'create'])
    ->middleware(['auth', 'role'])->name('admins.create');

Route::post('admins/guardar', [AdminController::class, 'store'])
    ->middleware(['auth', 'role'])->name('admins.store');

Route::get('admins/{id}', [AdminController::class, 'edit'])
    ->middleware(['auth', 'role'])->name('admins.edit');

Route::post('admins/actualizar/{id}', [AdminController::class, 'update'])
    ->middleware(['auth', 'role'])->name('admins.update');

Route::post('admins/eliminar/{id}', [AdminController::class, 'destroy'])
    ->middleware(['auth', 'role'])->name('admins.destroy');

Route::post('admins/importar', [AdminController::class, 'import'])
    ->middleware(['auth', 'role'])->name('admins.import');

// Historias

Route::post('antecedentes/guardar/{id}', [AntecedenteController::class, 'save'])
    ->middleware(['auth', 'role'])->name('antecedentes.save');

Route::get('citas/nuevo/{id}', [CitaController::class, 'create'])
    ->middleware(['auth', 'role'])->name('citas.create');

Route::post('citas/guardar/{id}', [CitaController::class, 'store'])
    ->middleware(['auth', 'role'])->name('citas.store');

Route::get('citas/{id}', [CitaController::class, 'edit'])
    ->middleware(['auth', 'role'])->name('citas.edit');

Route::post('citas/update/{id}', [CitaController::class, 'update'])
    ->middleware(['auth', 'role'])->name('citas.update');

Route::post('citas/destroy/{id}', [CitaController::class, 'destroy'])
    ->middleware(['auth', 'role'])->name('citas.destroy');

Route::post('citas/updateAnamnesis', [CitaController::class, 'updateAnamnesis'])
    ->middleware(['auth', 'role'])->name('citas.update_anamnesis');

Route::post('citas/updateAntecedentes', [CitaController::class, 'updateAntecedentes'])
    ->middleware(['auth', 'role'])->name('citas.update_antecedentes');

Route::post('citas/updateExamenClinico', [CitaController::class, 'updateExamenClinico'])
    ->middleware(['auth', 'role'])->name('citas.update_examen_clinico');

Route::post('citas/updateExamenRegional', [CitaController::class, 'updateExamenRegional'])
    ->middleware(['auth', 'role'])->name('citas.update_examen_regional');

Route::post('citas/updateImpresionDiagnostica', [CitaController::class, 'updateImpresionDiagnostica'])
    ->middleware(['auth', 'role'])->name('citas.update_impresion_diagnostica');

Route::post('citas/updateTratamiento', [CitaController::class, 'updateTratamiento'])
    ->middleware(['auth', 'role'])->name('citas.update_tratamiento');

Route::get('historia/imprimir/{id}', [CitaController::class, 'print'])
    ->middleware(['auth', 'role'])->name('citas.print');

Route::get('historia/pdf/{id}', [CitaController::class, 'download'])
    ->middleware(['auth', 'role'])->name('citas.pdf');

Route::get('examenesAuxiliares/{historia_id}', [ExamenAuxiliarController::class, 'index'])
    ->middleware(['auth', 'role'])->name('examenes_auxiliares.index');

Route::get('tratamientos/{historia_id}', [TratamientoController::class, 'index'])
    ->middleware(['auth', 'role'])->name('tratamientos.index');

Route::post('enfermedadActuales/guardar/{id}', [EnfermedadActualController::class, 'save'])
    ->middleware(['auth', 'role'])->name('enfermedad_actuales.save');

Route::post('examenes/guardar/{id}', [ExamenController::class, 'save'])
    ->middleware(['auth', 'role'])->name('examenes.save');

Route::post('examenAuxiliares/guardar', [ExamenAuxiliarController::class, 'store'])
    ->middleware(['auth', 'role'])->name('examen_auxiliares.store');

Route::post('examenAuxiliares/actualizar/{id}', [ExamenAuxiliarController::class, 'update'])
    ->middleware(['auth', 'role'])->name('examen_auxiliares.update');

Route::post('examenAuxiliares/eliminar/{id}', [ExamenAuxiliarController::class, 'destroy'])
    ->middleware(['auth', 'role'])->name('examen_auxiliares.destroy');

Route::post('tratamientos/guardar', [TratamientoController::class, 'store'])
    ->middleware(['auth', 'role'])->name('tratamientos.store');

Route::post('tratamientos/actualizar/{id}', [TratamientoController::class, 'update'])
    ->middleware(['auth', 'role'])->name('tratamientos.update');

Route::post('tratamientos/eliminar/{id}', [TratamientoController::class, 'destroy'])
    ->middleware(['auth', 'role'])->name('tratamientos.destroy');

Route::post('resultados/guardar', [ClinicStoryController::class, 'store'])
    ->middleware(['auth', 'role'])->name('results.store');

Route::post('resultados/actualizar/{id}', [ClinicStoryController::class, 'update'])
    ->middleware(['auth', 'role'])->name('results.update');

Route::post('resultados/eliminar/{id}', [ClinicStoryController::class, 'destroy'])
    ->middleware(['auth', 'role'])->name('results.destroy');

Route::get('resultados', [ClinicStoryController::class, 'index'])
    ->middleware(['auth'])->name('results.all');

Route::get('kardex/{historia_id}', [KardexController::class, 'index'])
    ->middleware(['auth', 'role'])->name('kardex.index');

Route::post('kardex/guardar/{id}', [KardexController::class, 'update'])
    ->middleware(['auth', 'role'])->name('kardex.update');

Route::post('kardex/detalles/guardar/{id}', [KardexController::class, 'detalleStore'])
    ->middleware(['auth', 'role'])->name('kardex.detalle_store');

Route::post('kardex/detalles/actualizar/{id}', [KardexController::class, 'detalleUpdate'])
    ->middleware(['auth', 'role'])->name('kardex.detalle_update');

Route::post('kardex/detalles/eliminar/{id}', [KardexController::class, 'detalleDestroy'])
    ->middleware(['auth', 'role'])->name('kardex.destroy');

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
