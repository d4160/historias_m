<?php

use App\Http\Controllers\AntecedenteController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ClinicStoryController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\DiagnosticoController;
use App\Http\Controllers\EnfermedadActualController;
use App\Http\Controllers\ExamenAuxiliarController;
use App\Http\Controllers\ExamenController;
use App\Http\Controllers\FuncionController;
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

Route::post('pacientes/importar', [PatientController::class, 'import'])
    ->middleware(['auth', 'role'])->name('patients.import');

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

Route::get('examenesAuxiliares/{historia_id}', [ExamenAuxiliarController::class, 'index'])
    ->middleware(['auth', 'role'])->name('examenes_auxiliares.index');

Route::post('enfermedadActuales/guardar/{id}', [EnfermedadActualController::class, 'save'])
    ->middleware(['auth', 'role'])->name('enfermedad_actuales.save');

Route::post('funciones/guardarBio/{id}', [FuncionController::class, 'saveFunBiologicas'])
    ->middleware(['auth', 'role'])->name('funciones.save_fun_bio');

Route::post('funciones/guardarVit/{id}', [FuncionController::class, 'saveFunVitales'])
    ->middleware(['auth', 'role'])->name('funciones.save_fun_vit');

Route::post('examenes/guardar/{id}', [ExamenController::class, 'save'])
    ->middleware(['auth', 'role'])->name('examenes.save');

Route::post('diagnosticos/guardarP/{id}', [DiagnosticoController::class, 'saveP'])
    ->middleware(['auth', 'role'])->name('diagnosticos.save_p');

Route::post('diagnosticos/guardarD/{id}', [DiagnosticoController::class, 'saveD'])
    ->middleware(['auth', 'role'])->name('diagnosticos.save_d');

Route::post('tratamientos/guardar/{id}', [TratamientoController::class, 'save'])
    ->middleware(['auth', 'role'])->name('tratamientos.save');

Route::post('medicamentos/guardar/{id}/cita/{cita_id}', [TratamientoDetalleController::class, 'store'])
    ->middleware(['auth', 'role'])->name('medicamentos.store');

Route::post('medicamentos/update/{id}/cita/{cita_id}', [TratamientoDetalleController::class, 'update'])
    ->middleware(['auth', 'role'])->name('medicamentos.update');

Route::post('medicamentos/eliminar/{id}', [TratamientoDetalleController::class, 'destroy'])
    ->middleware(['auth', 'role'])->name('medicamentos.destroy');

Route::post('examenAuxiliares/guardar', [ExamenAuxiliarController::class, 'store'])
    ->middleware(['auth', 'role'])->name('examen_auxiliares.store');

Route::post('examenAuxiliares/actualizar/{id}', [ExamenAuxiliarController::class, 'update'])
    ->middleware(['auth', 'role'])->name('examen_auxiliares.update');

Route::post('examenAuxiliares/eliminar/{id}', [ExamenAuxiliarController::class, 'destroy'])
    ->middleware(['auth', 'role'])->name('examen_auxiliares.destroy');

Route::post('resultados/guardar', [ClinicStoryController::class, 'store'])
    ->middleware(['auth', 'role'])->name('results.store');

Route::post('resultados/actualizar/{id}', [ClinicStoryController::class, 'update'])
    ->middleware(['auth', 'role'])->name('results.update');

Route::post('resultados/eliminar/{id}', [ClinicStoryController::class, 'destroy'])
    ->middleware(['auth', 'role'])->name('results.destroy');

Route::get('resultados', [ClinicStoryController::class, 'index'])
    ->middleware(['auth'])->name('results.all');

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
