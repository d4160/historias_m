<?php

namespace App\Http\Controllers;

use App\Models\Anamnesis;
use App\Models\Antecedente;
use App\Models\Auditoria;
use App\Models\ExamenAuxiliar;
use App\Models\Historia;
use App\Models\Medico;
use App\Models\Paciente;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
//use Illuminate\Support\Facades\Log;

class YabajaAPI extends Controller
{
    //
    function getData($id = null)
    {
        return $id ? ExamenAuxiliar::find($id) : ExamenAuxiliar::all();
    }

    function uploadFile(Request $req){
        $result = $req->file('file')->store('documents');
        return ['result' => $result];
    }

    function uploadPdfReport(Request $req)
    {
        $folder = 'examenes_auxiliares';
        $exam_aux = ExamenAuxiliar::find($req->exam_id);
        $status = 200;
        $message = 'Guardado correctamente';

        if ($exam_aux) {

            if ($req->file('file')) {

                //dd($request->file('lab_edit_file'));

                if(File::exists(public_path('storage/' . $exam_aux->url))) {
                    File::delete(public_path('storage/' . $exam_aux->url));
                }
                else {
                    //dd('File does not exists: ' . 'storage/' . public_path($exam_aux->url));
                }

                $fileName = time().'_'.str_replace('+', '_', $req->file->getClientOriginalName());
                $filePath = $req->file('file')->storeAs($folder, $fileName, 'public');

                $exam_aux->url = '' . $filePath;
                $exam_aux->save();
            }
            else {
                $status = 500;
                $message = 'No has adjuntado un archivo';
            }
        }
        else {
            $status = 404;
            $message = 'ID de examen no encontrado';
        }

        $response = [
            'message' => $message
        ];

        return response($response, $status);
    }

    function uploadBin(Request $request)
    {
        // $binaryData = $request->getContent();

        // $uniqueFileName = md5(uniqid(microtime(), true));
        // $fileExtension = substr(strrchr(getimagesizefromstring($binaryData)['mime'], '/'), 1);
        // $fileName = "$uniqueFileName.$fileExtension";

        $storedFile = Storage::disk('public')->put('documents2.pdf', $request->getContent());

        return Storage::disk('public')->path('documents2.pdf');
    }

    function uploadPdfReport2(Request $req, $id)
    {
        $folder = 'examenes_auxiliares';
        $exam_aux = ExamenAuxiliar::find($id);
        $status = 200;
        $message = 'Guardado correctamente';

        if ($exam_aux) {

       //dd($request->file('lab_edit_file'));

            if(File::exists(public_path('storage/' . $exam_aux->url))) {
                File::delete(public_path('storage/' . $exam_aux->url));
            }
            else {
                //dd('File does not exists: ' . 'storage/' . public_path($exam_aux->url));
            }

            $fileName = time().'_'.str_replace('+', '_', 'report.pdf');
            $filePath = $folder . '/' . $fileName;

            Storage::disk('public')->put($filePath, $req->getContent());

            $exam_aux->url = '' . $filePath;
            $exam_aux->save();
        }
        else {
            $status = 404;
            $message = 'Id de examen no encontrado';
        }

        $response = [
            'message' => $message
        ];

        return response($response, $status);
    }

    function saveExamPdf(){

    }

    function searchExams($dni) {
        $user = User::has('paciente')->with('paciente')->where('num_document', '=', $dni)->firstOrFail();
        $historias = $user->paciente->historias()->with('examenesAuxiliares')->get();

        $examenes_raw = ExamenAuxiliar::whereHas('historia', function($q) use($user) {
            $q->where('paciente_id', $user->specific_role_id);
        })->with('historia')->orderBy('created_at', 'desc')->get();

        $examenes = array();
        foreach ($examenes_raw as $e) {

            $examen = [
                'id' => $e->id,
                'tipo' => $e->titulo,
                'descripcion' => $e->descripcion,
                'report_url' => Storage::url($e->url),
                'viewer_url' => $e->viewer_url,
                'dicom_download_url' => $e->download_url,
                'created_at' => \Carbon\Carbon::parse($e->created_at)
                                        ->timezone(config('app.timezone'))
                                        ->toDateTimeString(),
                'updated_at' => \Carbon\Carbon::parse($e->updated_at)
                                        ->timezone(config('app.timezone'))
                                        ->toDateTimeString(),
                'atencion' => [
                    'id' => $e->historia->id,
                    'estado' => $e->historia->estado,
                    'motivo' => $e->historia->motivo,
                    'created_at' => \Carbon\Carbon::parse($e->historia->created_at)
                                            ->timezone(config('app.timezone'))
                                            ->toDateTimeString()
                ]
            ];
            array_push($examenes, $examen);

        }

        $response = [
            'paciente'=> [
                'id'=>$user->id,
                'dni'=>$user->num_document,
                'nombres'=>$user->first_names,
                'apellido_paterno'=>$user->last_name1,
                'apellido_materno'=> $user->last_name2,
            ],
            'examenes' => $examenes
        ];

        return $response;
    }

    function searchAttentions($dni) {
        $user = User::has('paciente')->with('paciente')->where('num_document', '=', $dni)->firstOrFail();
        $historias = $user->paciente->historias()->with('examenesAuxiliares')->get();

        $atenciones = array();
        foreach ($historias as $h) {
            $examenes = array();

            foreach ($h->examenesAuxiliares as $e) {
                $examen = [
                    'id' => $e->id,
                    'tipo' => $e->titulo,
                    'descripcion' => $e->descripcion,
                    'report_url' => Storage::url($e->url),
                    'viewer_url' => $e->viewer_url,
                    'dicom_download_url' => $e->download_url,
                    'created_at' => \Carbon\Carbon::parse($e->created_at)
                                         ->timezone(config('app.timezone'))
                                         ->toDateTimeString(),
                    'updated_at' => \Carbon\Carbon::parse($e->updated_at)
                                         ->timezone(config('app.timezone'))
                                         ->toDateTimeString()
                ];
                array_push($examenes, $examen);
            }

            $atencion = [
                'id' => $h->id,
                'estado' => $h->estado,
                'motivo' => $h->motivo,
                'created_at' => \Carbon\Carbon::parse($h->created_at)
                                         ->timezone(config('app.timezone'))
                                         ->toDateTimeString(),
                'examenes' => $examenes
            ];
            array_push($atenciones, $atencion);
        }

        $response = [
            'paciente'=> [
                'id'=>$user->id,
                'dni'=>$user->num_document,
                'nombres'=>$user->first_names,
                'apellido_paterno'=>$user->last_name1,
                'apellido_materno'=> $user->last_name2,
            ],
            'atenciones' => $atenciones
        ];

        return $response;
    }

    function saveDICOM(Request $req)
    {
        //return response()->json($req->all());

        //$data = $req->json()->all();
        //$data = $req->getContent();

        $paciente = $req->input('paciente');
        $u = User::has('paciente')->where('num_document', '=', $paciente['dni'])->first();
        $p = NULL;

        if (!$u) {
            // create
            $u = User::create([
                'user_role_id' => 5,
                'num_document' => $paciente['dni'],
                'first_names' => $paciente['nombres'],
                'last_name1' => $paciente['apellido_paterno'],
                'last_name2' => $paciente['apellido_materno'],
                'fecha_nacimiento' => $paciente['fecha_nacimiento'],
                //'edad' => $request->edad,
                'procedencia_dep' => substr($paciente['ubigeo'], 0, 2),
                'procedencia_prov' => substr($paciente['ubigeo'], 2, 2),
                'procedencia_dis' => substr($paciente['ubigeo'], 4, 2),
                'direccion' => $paciente['direccion'],
                'celular' => $paciente['celular'],
                //'refiere' => $request->refiere,
                //'medico_tratante' => $request->medico_tratante,
                //'otros' => $request->otros,
                'email' => $paciente['email'],
                'password' => Hash::make($paciente['dni'])
                //'created_at' => $request->created_at
            ]);

            $p = Paciente::create([
                'user_id' => $u->id
            ]);

            $u->specific_role_id = $p->id;
            $u->save();

            Auditoria::create([
                'tabla' => 'pacientes',
                'accion' => 'create',
                'user_id' => 1,
                'tabla_id' => $p->id,
                'detalles' => "Asistente:api; num_document:$u->num_document, full_name:$u->full_name"
            ]);
        }
        else {
            $p = $u->paciente;
        }


        $atencion = $req->input('atencion');
        $examen = $req->input('examen');

        $a = Historia::find($atencion['id']);

        if (!$a) {
            $at = Historia::where([
					['created_at', '=', $examen['fecha_hora']]
				])->first();

            if ($at) {
                //Log::info($et->historia->paciente->user->num_document);
                //Log::info($paciente['dni']);

                if ($at->paciente->user->num_document == $paciente['dni'])
                    $a = $at;
            }
        }

        if (!$a) {
            $a = Historia::create([
                'paciente_id' => $p->id,
                'motivo' => $atencion['motivo']
            ]);

            //$a->created_at = $atencion['fecha_hora'];

            $anamnesis = Anamnesis::create([
                'historia_id' => $a->id,
                'anamnesis' => $atencion['anamnesis']
            ]);

            $antecedente = Antecedente::create([
                'historia_id' => $a->id,
                'antecedentes' => $atencion['antecedentes']
            ]);

            $a->anamnesis_id = $anamnesis->id;
            $a->antecedente_id = $antecedente->id;
            $a->created_at = $examen['fecha_hora'];
            $a->updated_at = $examen['fecha_hora'];

            Auditoria::create([
                'tabla' => 'historias',
                'accion' => 'create',
                'user_id' => 1,
                'tabla_id' => $a->id,
                'detalles' => "Asistente:api; paciente:$u->num_document | $u->full_name"
            ]);

            $a->save();
        }

        $e = ExamenAuxiliar::find($examen['id']);

        if (!$e) {
            $et = ExamenAuxiliar::where([
					['titulo', '=', $examen['tipo']],
					['created_at', '=', $examen['fecha_hora']],
                    ['descripcion', '=', $examen['descripcion']]
				])->first();


            if ($et) {
                //Log::info($et->historia->paciente->user->num_document);
                //Log::info($paciente['dni']);

                if ($et->historia->paciente->user->num_document == $paciente['dni'])
                    $e = $et;
            }
        }

        if (!$e) {
            $e = ExamenAuxiliar::create([
                'historia_id' => $a->id,
                'titulo' => $examen['tipo'],
                'descripcion' => $examen['descripcion'],
                'viewer_url' => $examen['url_visor'],
                'download_url' => $examen['url_descarga'],
                'url' => $examen['url_informe']
            ]);

            Auditoria::create([
                'tabla' => 'examenes_auxiliares',
                'accion' => 'create',
                'user_id' => 1,
                'tabla_id' => $e->id,
                'detalles' => "Asistente:api; titulo: $e->titulo, descripcion: $e->descripcion, paciente:$u->num_document | $u->full_name"
            ]);

            $e->created_at = $examen['fecha_hora'];
            $e->updated_at = $examen['fecha_hora'];
            $e->save();
        }
        else {
            $e->viewer_url = $examen['url_visor'];
            $e->download_url = $examen['url_descarga'];
            $e->url = $examen['url_informe'];
            $e->save();
        }

        $medicos = $req->input('medicos');;

        // Referente
        if ($medicos[0]) {
            $dni = $medicos[0]['dni'];
            $u = User::has('medico')->where('num_document', '=', $dni)->first();

            if (!$u && $dni) {
                $u = User::create([
                    'user_role_id' => 3,
                    'num_document' => $medicos[0]['dni'],
                    'first_names' => $medicos[0]['nombres'],
                    'last_name1' => $medicos[0]['apellido_paterno'],
                    'last_name2' => $medicos[0]['apellido_materno'],
                    //'email' => $paciente['email'],
                    'password' => Hash::make($medicos[0]['dni'])
                    //'created_at' => $request->created_at
                ]);

                $m = Medico::create([
                    'user_id' => $u->id
                ]);

                $u->specific_role_id = $m->id;
                $u->save();
            }
            else {
                $m = $u->medico;
            }

            $e->medico_1_id = $m->id;
        }

        // Radiologo
        if ($medicos[1]) {
            $u = User::has('medico')->where('num_document', '=', $medicos[1]['dni'])->first();

            if (!$u) {
                $u = User::create([
                    'user_role_id' => 3,
                    'num_document' => $medicos[1]['dni'],
                    'first_names' => $medicos[1]['nombres'],
                    'last_name1' => $medicos[1]['apellido_paterno'],
                    'last_name2' => $medicos[1]['apellido_materno'],
                    //'email' => $paciente['email'],
                    'password' => Hash::make($medicos[1]['dni'])
                    //'created_at' => $request->created_at
                ]);

                $m = Medico::create([
                    'user_id' => $u->id
                ]);

                $u->specific_role_id = $m->id;
                $u->save();
            }
            else {
                $m = $u->medico;
            }

            $e->medico_2_id = $m->id;
        }

        // Tecnico
        if ($medicos[2]) {
            $u = User::has('medico')->where('num_document', '=', $medicos[2]['dni'])->first();

            if (!$u) {
                $u = User::create([
                    'user_role_id' => 3,
                    'num_document' => $medicos[2]['dni'],
                    'first_names' => $medicos[2]['nombres'],
                    'last_name1' => $medicos[2]['apellido_paterno'],
                    'last_name2' => $medicos[2]['apellido_materno'],
                    //'email' => $paciente['email'],
                    'password' => Hash::make($medicos[2]['dni'])
                    //'created_at' => $request->created_at
                ]);

                $m = Medico::create([
                    'user_id' => $u->id
                ]);

                $u->specific_role_id = $m->id;
                $u->save();
            }
            else {
                $m = $u->medico;
            }

            $e->medico_3_id = $m->id;
        }

        $e->save();

        $response = [
            'message' => 'Guardado correctamente'
        ];

        return response($response, 200);
    }
}
