<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Funcion;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Paciente;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patients = User::where('user_role_id', 5)->get();
        return view('patients.all', ['patients' => $patients]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $paciente_next_id = DB::select("SHOW TABLE STATUS LIKE 'pacientes'");
        return view('patients.create', ['paciente_next_id' => $paciente_next_id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'num_document' => ['required', 'string', 'max:11', 'unique:users'], // 'confirmed'
            'first_names' => ['required', 'string', 'max:255'],
            'last_name1' => ['required', 'string', 'max:255'],
            'last_name2' => ['required', 'string', 'max:255']
        ]);

        $user = User::create([
            'user_role_id' => 5,
            'num_document' => $request->num_document,
            'first_names' => $request->first_names,
            'last_name1' => $request->last_name1,
            'last_name2' => $request->last_name2,
            'estado_civil' => $request->estado_civil,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'edad' => $request->edad,
            'procedencia_dep' => $request->procedencia_dep,
            'procedencia_prov' => $request->procedencia_prov,
            'procedencia_dis' => $request->procedencia_dis,
            'direccion' => $request->direccion,
            'ocupacion' => $request->ocupacion,
            'otros' => $request->otros,
            'password' => Hash::make($request->num_document),
        ]);

        $patient = Paciente::create([
            'user_id' => $user->id
        ]);

        $user->specific_role_id = $patient->id;
        $user->save();

        return redirect(route('patients.edit', $patient->id));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $patient = Paciente::find($id);
        if ($patient) {
            return view('patients.edit', ['patient' => $patient->user, 'patient_id' => $id, 'historias' => $patient->historias]);
        }
        else {
            return redirect(route('patients.all'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $patient = Paciente::find($id)->user;

        $request->validate([
            'first_names' => ['required', 'string', 'max:255'],
            'last_name1' => ['required', 'string', 'max:255'],
            'last_name2' => ['required', 'string', 'max:255'],
            'num_document' => ['required', 'string', 'max:11', 'unique:users,num_document,'.$patient->id], // 'confirmed'
        ]);

        $patient->num_document = $request->num_document;
        $patient->first_names = $request->first_names;
        $patient->last_name1 = $request->last_name1;
        $patient->last_name2 = $request->last_name2;
        $patient->estado_civil = $request->estado_civil;
        $patient->fecha_nacimiento = $request->fecha_nacimiento;
        $patient->edad = $request->edad;
        $patient->procedencia_dep = $request->procedencia_dep;
        $patient->procedencia_prov = $request->procedencia_prov;
        $patient->procedencia_dis = $request->procedencia_dis;
        $patient->direccion = $request->direccion;
        $patient->ocupacion = $request->ocupacion;
        $patient->otros = $request->otros;

        $patient->save();

        return redirect(route('patients.edit', $id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $u = User::findOrFail($id);
        $p = Paciente::find($u->specific_role_id);

        foreach($p->citas as $cita) {

            foreach($cita->examenAuxiliares as $eAux) {
                if(File::exists(public_path('storage/' . $eAux->url))){
                    File::delete(public_path('storage/' . $eAux->url));
                }else{
                    // dd('File does not exists.' . 'storage/' . public_path($result->url));
                }
            }
        }

        // $u->results()->delete();

        $u->delete();

        return back();
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => ['mimes:csv', 'max:5120']
        ]);

        $path = $request->file('file')->getRealPath();
        $records = array_map('str_getcsv', file($path));

        if (! count($records) > 0) {
            return redirect(route('patients.all'));
        }

        // Get field names from header column
        $fields = array_map('strtolower', $records[0]);

        // Remove the header column
        array_shift($records);

        foreach ($records as $record) {
            if (count($fields) != count($record)) {
                return redirect(route('patients.all'));
            }

            // Decode unwanted html entities
            $record =  array_map("html_entity_decode", $record);

            // Set the field name as key
            $record = array_combine($fields, $record);

            // Get the clean data
            $this->rows[] = $this->clear_encoding_str($record);
        }

        set_time_limit(0);

        foreach ($this->rows as $data) {
            // dd($data['peso'] ? $data['peso'] : 0);
            $paciente = explode(' ', $data['paciente']);
            $last_names = !empty($paciente) ? implode(' ', [$paciente[0], $paciente[1]]) : NULL;
            if (!empty($paciente)) {
                array_splice($paciente, 0, 2);
                $first_names = implode(' ', $paciente);
            }

            $user = User::create([
                'user_role_id' => 5,
                'num_document' => $data['﻿dni'] ? $data['﻿dni'] : NULL,
                'first_names' => $first_names,
                'last_names' => $last_names,
                'celular' => $data['celular'],
                'password' => Hash::make($data['﻿dni'] ? $data['﻿dni'] : 'reumainnova')
            ]);

            $patient = Paciente::create([
                'user_id' => $user->id
            ]);

            $user->specific_role_id = $patient->id;
            $user->save();

            $cita = Cita::create([
                'paciente_id' => $patient->id,
                'sede' => $data['sede'] ?? NULL
            ]);

            $f = Funcion::create([
                'cita_id' => $cita->id,
                'fun_vit_peso' => $data['peso'] ? $data['peso'] : NULL,
                'fun_vit_talla' => $data['talla'] ? $data['talla'] : NULL
            ]);

            $cita->funcion_id = $f->id;
            $cita->save();
        }

        return redirect(route('patients.all'));
    }

    private function clear_encoding_str($value)
    {
        if (is_array($value)) {
            $clean = [];
            foreach ($value as $key => $val) {
                $clean[$key] = mb_convert_encoding($val, 'UTF-8', 'UTF-8');
            }
            return $clean;
        }
        return mb_convert_encoding($value, 'UTF-8', 'UTF-8');
    }
}
