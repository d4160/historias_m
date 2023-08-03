<?php

namespace App\Http\Controllers;

use App\Models\Auditoria;
use App\Models\Cita;
use App\Models\Paciente;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CitaController extends Controller
{
    //
    public function index()
    {
        $citas = Cita::where('estado_enum', '!=', 'Atendido')->with(['paciente' => fn ($query) => $query->with('user') ])->orderBy('created_at', 'desc')->get();

        return view('citas.all', ['citas' => $citas]);
    }

    public function store(Request $request, $id = 0, $user_id = 0)
    {
        if ($user_id == 0) {
            $user = $request->num_document ? User::where('num_document', '=', $request->num_document)->first() : null;
        }
        else {
            $user = User::find($user_id);
        }

        $request->validate([
            'num_document' => ['max:11'], // 'confirmed'
            'nombres' => ['required', 'string', 'max:255'],
            'last_name1' => ['required', 'string', 'max:255'],
            'last_name2' => ['max:255']
        ]);


        $my_user = \Auth::user();

        if (!$user) {
            $user = User::create([
                'user_role_id' => 5,
                'num_document' => $request->num_document,
                'first_names' => $request->nombres,
                'last_name1' => $request->last_name1,
                'last_name2' => $request->last_name2,
                'celular' => $request->celular
                //'password' => Hash::make($request->num_document)
            ]);

            $patient = Paciente::create([
                'user_id' => $user->id,
                'tipo' => 0
            ]);

            $user->specific_role_id = $patient->id;
            $user->save();

            Auditoria::create([
                'tabla' => 'pacientes',
                'accion' => 'create',
                'user_id' => $my_user->id,
                'tabla_id' => $patient->id,
                'detalles' => "Asistente:$my_user->full_name; num_document:$user->num_document, full_name:$user->full_name"
            ]);
        }
        else {

            Auditoria::create([
                'tabla' => 'pacientes',
                'accion' => 'update',
                'user_id' => $my_user->id,
                'tabla_id' => $user->id,
                'detalles' => "Asistente:$my_user->full_name; old_celular:$user->celular,new_celular:$request->celular"
            ]);

            $user->first_names = $request->nombres;
            $user->last_name1 = $request->last_name1;
            $user->last_name2 = $request->last_name2;
            $user->celular = $request->celular;

            if ($request->num_document)
                $user->password = Hash::make($request->num_document);

            $user->save();
        }

        if ($id == 0) {
            $cita = Cita::create([
                'paciente_id' => $user->specific_role_id,
                'fecha_hora' => $request->fecha_hora,
                'tipo' => $request->tipo,
                // 'tipo_otros' => $request->tipo_otros,
                'consultorio' => $request->consultorio,
                'medico' => $request->medico,
                'estado' => $request->estado,
                'estado_enum' => $request->estado_enum,
                'origen' => $request->origen
            ]);

            Auditoria::create([
                'tabla' => 'citas',
                'accion' => 'create',
                'user_id' => $my_user->id,
                'tabla_id' => $cita->id,
                'detalles' => "Asistente:$my_user->full_name; paciente:$user->full_name,cita_fecha_hora:$cita->fecha_hora"
            ]);
        }
        else {
            $cita = Cita::find($id);
            $cita->paciente_id = $user->specific_role_id;
            $cita->fecha_hora = $request->fecha_hora;
            $cita->tipo = $request->tipo;
            //$cita->tipo_otros = $request->tipo_otros;
            $cita->consultorio = $request->consultorio;
            $cita->medico = $request->medico;
            $cita->estado = $request->estado;
            $cita->estado_enum = $request->estado_enum;
            $cita->origen = $request->origen;
            $cita->save();

            Auditoria::create([
                'tabla' => 'citas',
                'accion' => 'update',
                'user_id' => $my_user->id,
                'tabla_id' => $cita->id,
                'detalles' => "Asistente:$my_user->full_name; paciente:$user->full_name,cita_fecha_hora:$cita->fecha_hora"
            ]);
        }

        return back()->with(['notification' => 'Cita guardada correctamente', 'color' => '#8dbf42']);
        // '#e7515a'
    }

    public function destroy($id)
    {
        $c = Cita::findOrFail($id);
        $u = $c->paciente->user;
        $my_user = \Auth::user();
        Auditoria::create([
            'tabla' => 'citas',
            'accion' => 'delete',
            'user_id' => $my_user->id,
            'tabla_id' => $c->id,
            'detalles' => "Asistente:$my_user->full_name; paciente:$u->full_name,cita_fecha_hora:$c->fecha_hora"
        ]);

        // $c->results()->delete();

        $c->delete();

        return back();
    }

}
