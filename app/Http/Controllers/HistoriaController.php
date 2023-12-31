<?php

namespace App\Http\Controllers;

use App\Models\Auditoria;
use App\Models\Anamnesis;
use App\Models\Antecedente;
use App\Models\ExamenClinico;
use App\Models\ExamenRegional;
use App\Models\Historia;
use App\Models\ImpresionDiagnostica;
use App\Models\Paciente;
use App\Models\Tratamiento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Mccarlosen\LaravelMpdf\Facades\LaravelMpdf as PDF2;

class HistoriaController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $patient = Paciente::find($id);
        if ($patient) {

            $citas_id = DB::select("SHOW TABLE STATUS LIKE 'citas'");
            $next_id = $citas_id[0]->Auto_increment;

            return view('historias.create', ['patient' => $patient->user, 'next_id' => $next_id, 'patient_id' => $id]);
        }
        else {
            return redirect(route('patients.all'));
        }
    }

    public function store(Request $request, $id)
    {
        $request->validate([
            //'sede' => ['required'], // 'confirmed'
            //'fecha_hora' => ['required', 'date']
        ]);

        $historia = Historia::create([
            'paciente_id' => $id
            // 'sede' => $request->sede,
            // 'fecha_hora' => $request->fecha_hora
        ]);

        $anamnesis = Anamnesis::create([
            'historia_id' => $historia->id
        ]);

        $antecedente = Antecedente::create([
            'historia_id' => $historia->id
        ]);

        $examenClinico = ExamenClinico::create([
            'historia_id' => $historia->id
        ]);

        $examenRegional = ExamenRegional::create([
            'historia_id' => $historia->id
        ]);

        $impresionDiagnostica = ImpresionDiagnostica::create([
            'historia_id' => $historia->id
        ]);

        $historia->anamnesis_id = $anamnesis->id;
        $historia->antecedente_id = $antecedente->id;
        $historia->examen_clinico_id = $examenClinico->id;
        $historia->examen_regional_id = $examenRegional->id;
        $historia->impresion_diagnostica_id = $impresionDiagnostica->id;

        $historia->save();

        $paciente = Paciente::find($id);
        $paciente->proxima_cita = $historia->proxima_cita;
        $paciente->estado = $historia->estado;
        $paciente->save();

        $my_user = \Auth::user();
        Auditoria::create([
            'tabla' => 'historias',
            'accion' => 'create',
            'user_id' => $my_user->id,
            'tabla_id' => $historia->id,
            'detalles' => "Asistente:$my_user->full_name; numero_hc:$historia->id"
        ]);


        return redirect(route('patients.edit', $id));
    }

    public function edit($id)
    {
        $cita = Historia::find($id);
        if ($cita) {
            $patient = Paciente::find($cita->paciente_id);

            return view('citas.edit', ['patient' => $patient->user, 'cita' => $cita, 'enf_actual' => $cita->enfermedadActual, 'funcion' => $cita->funcion, 'diagnostico' => $cita->diagnostico, 'examen' => $cita->examen, 'tratamiento' => $cita->tratamiento]);
        }
        else {
            return redirect(route('patients.all'));
        }
    }

    public function update(Request $request, $id)
    {
        $historia = Historia::find($id);

        $request->validate([
        ]);

        $my_user = \Auth::user();
        Auditoria::create([
            'tabla' => 'historias',
            'accion' => 'update',
            'user_id' => $my_user->id,
            'tabla_id' => $id,
            'detalles' => "Asistente:$my_user->full_name; old_proxima_cita:$historia->proxima_cita,new_proxima_cita:$request->proxima_cita"
        ]);

        $historia->proxima_cita = $request->proxima_cita;
        $historia->estado = $request->estado;
        $historia->motivo = $request->motivo;

        if ($request->created_at_edit) {
            $historia->created_at = $request->created_at_edit;
        }

        $paciente = $historia->paciente;
        $paciente->proxima_cita = $request->proxima_cita;
        $paciente->estado = $request->estado;
        $paciente->save();
        $historia->save();

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $historia = Historia::findOrFail($id);

        foreach($historia->examenesAuxiliares as $eAux) {
            if(File::exists(public_path('storage/' . $eAux->url))){
                File::delete(public_path('storage/' . $eAux->url));
            }else{
                // dd('File does not exists.' . 'storage/' . public_path($result->url));
            }
        }

        $my_user = \Auth::user();
        Auditoria::create([
            'tabla' => 'historias',
            'accion' => 'delete',
            'user_id' => $my_user->id,
            'tabla_id' => $id,
            'detalles' => "Asistente:$my_user->full_name; numero_hc:$id"
        ]);

        // $historia->results()->delete();
        $patient = Paciente::find($historia->paciente_id);

        $historia->delete();

        $historia = Historia::where('paciente_id', '=', $patient->id)->orderBy('updated_at', 'desc')->first();

        if ($historia) {
            $patient->proxima_cita = $historia->proxima_cita;
            $patient->estado = $historia->estado;
            $patient->save();
        }

        return back();
    }

    public function updateAnamnesis(Request $request)
    {
        //Log::info($request);
        $anamnesis = Anamnesis::find($request->anamnesis_id);

        $request->validate([
        ]);

        $anamnesis->anamnesis = $request->anamnesis;

        $anamnesis->save();

        return Redirect::back();
    }

    public function updateAntecedentes(Request $request)
    {
        //Log::info($request);
        $instance = Antecedente::find($request->antecedentes_id);

        $request->validate([
        ]);

        $instance->antecedentes = $request->antecedentes == 'CARGANDO...' ? '' : $request->antecedentes;
        $instance->familiares = $request->familiares == 'CARGANDO...' ? '' : $request->familiares;
        $instance->personales = $request->personales == 'CARGANDO...' ? '' : $request->personales;
        $instance->hab_nocivos = $request->hab_nocivos == 'CARGANDO...' ? '' : $request->hab_nocivos;

        $instance->save();

        return Redirect::back();
    }

    public function updateExamenClinico(Request $request)
    {
        //Log::info($request);
        $instance = ExamenClinico::find($request->examen_clinico_id);

        $request->validate([
        ]);

        $instance->fc = $request->fc;
        $instance->fr = $request->fr;
        $instance->sat = $request->sat;
        $instance->pa = $request->pa;
        $instance->temperatura = $request->temperatura;
        $instance->peso = $request->peso;
        $instance->talla = $request->talla;
        $instance->deposiciones = $request->deposiciones == 'CARGANDO...' ? '' : $request->deposiciones;
        $instance->orina = $request->orina == 'CARGANDO...' ? '' : $request->orina;
        $instance->fur = $request->fur == 'CARGANDO...' ? '' : $request->fur;
        $instance->otros = $request->otros == 'CARGANDO...' ? '' : $request->otros;

        $instance->save();

        return Redirect::back();
    }

    public function updateExamenRegional(Request $request)
    {
        //Log::info($request);
        $instance = ExamenRegional::find($request->examen_regional_id);

        $request->validate([
        ]);

        $instance->examen_regional = $request->examen_regional;

        $instance->save();

        return Redirect::back();
    }

    public function updateImpresionDiagnostica(Request $request)
    {
        //Log::info($request);
        $instance = ImpresionDiagnostica::find($request->impresion_diagnostica_id);

        $request->validate([
        ]);

        $instance->impresion_diagnostica = $request->impresion_diagnostica;

        $instance->save();

        return Redirect::back();
    }

    public function updateTratamiento(Request $request)
    {
        //Log::info($request);
        $instance = Tratamiento::find($request->tratamiento_id);

        $request->validate([
        ]);

        $instance->tratamiento = $request->tratamiento;

        $instance->save();

        return Redirect::back();
    }

    public function print($id)
    {
        $historia = Historia::find($id);

        $examenesAuxiliares = $historia->examenesAuxiliares('asc')->get();
        $examsString = '';
        foreach ($examenesAuxiliares as $exam) {
            $examsString .= '' . ($exam->descripcion ? ('<b>' . $exam->titulo . '</b>: ' . $exam->descripcion) : ('<b>' . $exam->titulo . '</b>')) . ' - ' . substr($exam->created_at, 0, 16) . '; ';
        }

        $tratamientos = $historia->tratamientos('asc')->get();
        $tratsString = '';
        foreach ($tratamientos as $trat) {
            $tratsString .= '' . ($trat->descripcion ? ('<b>' . $trat->tratamiento . '</b>: ' . $trat->descripcion) : ('<b>' . $trat->tratamiento . '</b>')) . '; ';
        }

        return view('historias.print', [
            'historia' => $historia,
            'user' => $historia->paciente->user,
            'examenClinico' => $historia->examenClinico,
            'examsString' => $examsString,
            'tratsString' => $tratsString,
            'kardex' => $historia->kardex
        ]);
    }

    public function print2($id)
    {
        $historia = Historia::find($id);

        $examenesAuxiliares = $historia->examenesAuxiliares('asc')->get();
        $examsString = '';
        foreach ($examenesAuxiliares as $exam) {
            $examsString .= '' . ($exam->descripcion ? ('<b>' . $exam->titulo . '</b>: ' . $exam->descripcion) : ('<b>' . $exam->titulo . '</b>')) . '; ';
        }

        $tratamientos = $historia->tratamientos('asc')->get();
        $tratsString = '';
        foreach ($tratamientos as $trat) {
            $tratsString .= '' . ($trat->descripcion ? ('<b>' . $trat->tratamiento . '</b>: ' . $trat->descripcion) : ('<b>' . $trat->tratamiento . '</b>')) . '; ';
        }

        return view('historias.print_new_static', [
            'historia' => $historia,
            'user' => $historia->paciente->user,
            'examenClinico' => $historia->examenClinico,
            'examsString' => $examsString,
            'tratsString' => $tratsString
        ]);
    }

    public function download($id)
    {
        $historia = Historia::find($id);

        $examenesAuxiliares = $historia->examenesAuxiliares('asc')->get();
        $examsString = '';
        foreach ($examenesAuxiliares as $exam) {
            $examsString .= '' . ($exam->descripcion ? ('<b>' . $exam->titulo . '</b>: ' . $exam->descripcion) : ('<b>' . $exam->titulo . '</b>')) . '; ';
        }

        $tratamientos = $historia->tratamientos('asc')->get();
        $tratsString = '';
        foreach ($tratamientos as $trat) {
            $tratsString .= '' . ($trat->descripcion ? ('<b>' . $trat->tratamiento . '</b>: ' . $trat->descripcion) : ('<b>' . $trat->tratamiento . '</b>')) . '; ';
        }

        $data = [
            'historia' => $historia,
            'user' => $historia->paciente->user,
            'examenClinico' => $historia->examenClinico,
            'examsString' => $examsString,
            'tratsString' => $tratsString
        ];

        $pdf = PDF::loadview('historias.print_new_static', $data);


        return $pdf->download('archivo.pdf');
        //set_time_limit(10);

        //$pdf = app('dompdf.wrapper');
        //$pdf->set_paper('A3','landscape'); //Changed A4 to A3
        //$pdf->loadview('historias.print', $data);
        // $pdf->loadHTML('<h1>Styde.net</h1>');

        //return $pdf->download('mi-archivo.pdf');


        //$pdf = PDF::loadview('historias.print', $data);

        //return $pdf->stream('document.pdf');
    }

    public function download2($id)
    {
        $historia = Historia::find($id);

        $examenesAuxiliares = $historia->examenesAuxiliares('asc')->get();
        $examsString = '';
        foreach ($examenesAuxiliares as $exam) {
            $examsString .= '' . ($exam->descripcion ? ('<b>' . $exam->titulo . '</b>: ' . $exam->descripcion) : ('<b>' . $exam->titulo . '</b>')) . '; ';
        }

        $tratamientos = $historia->tratamientos('asc')->get();
        $tratsString = '';
        foreach ($tratamientos as $trat) {
            $tratsString .= '' . ($trat->descripcion ? ('<b>' . $trat->tratamiento . '</b>: ' . $trat->descripcion) : ('<b>' . $trat->tratamiento . '</b>')) . '; ';
        }

        $data = [
            'historia' => $historia,
            'user' => $historia->paciente->user,
            'examenClinico' => $historia->examenClinico,
            'examsString' => $examsString,
            'tratsString' => $tratsString
        ];

        //$pdf = PDF::loadview('historias.print_new_static', $data);


        //return $pdf->download('archivo.pdf');
        //set_time_limit(10);

        //$pdf = app('dompdf.wrapper');
        //$pdf->set_paper('A3','landscape'); //Changed A4 to A3
        //$pdf->loadview('historias.print', $data);
        // $pdf->loadHTML('<h1>Styde.net</h1>');

        //return $pdf->download('mi-archivo.pdf');


        $pdf = PDF2::loadview('historias.print_new_static', $data);

        return $pdf->stream('document.pdf');
    }
}
