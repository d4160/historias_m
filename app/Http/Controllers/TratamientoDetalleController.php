<?php

namespace App\Http\Controllers;

use App\Models\TratamientoDetalle;
use Illuminate\Http\Request;

class TratamientoDetalleController extends Controller
{
    public function store(Request $request, $id, $cita_id)
    {
        $request->validate([
            'medicamento' => ['required', 'string', 'max:255'], // 'confirmed'
            'concentracion' => ['required', 'string', 'max:255'],
            'dosis' => ['required', 'string', 'max:255'],
            'frecuencia' => ['required', 'string', 'max:255'],
            'via' => ['required', 'string', 'max:255']
        ]);

        $medicamento = TratamientoDetalle::create([
            'tratamiento_id' => $id,
            'medicamento' => $request->medicamento,
            'concentracion' => $request->concentracion,
            'dosis' => $request->dosis,
            'frecuencia' => $request->frecuencia,
            'via' => $request->via
        ]);

        $medicamento->save();

        return redirect(route('historias.edit', $cita_id));
    }

    public function update(Request $request, $id, $cita_id)
    {
        $request->validate([
            'edit_medicamento' => ['required', 'string', 'max:255'], // 'confirmed'
            'edit_concentracion' => ['required', 'string', 'max:255'],
            'edit_dosis' => ['required', 'string', 'max:255'],
            'edit_frecuencia' => ['required', 'string', 'max:255'],
            'edit_via' => ['required', 'string', 'max:255']
        ]);

        $td = TratamientoDetalle::find($id);

        $td->medicamento = $request->edit_medicamento;
        $td->concentracion = $request->edit_concentracion;
        $td->dosis = $request->edit_dosis;
        $td->frecuencia = $request->edit_frecuencia;
        $td->via = $request->edit_via;

        $td->save();

        return redirect(route('historias.edit', $cita_id));
    }

    public function destroy($id)
    {
        $result = TratamientoDetalle::findOrFail($id);

        $result->delete();

        return back();
    }
}
