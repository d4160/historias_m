<?php

namespace App\Http\Controllers;

use App\Models\Tratamiento;
use App\Models\Historia;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class TratamientoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($historia_id)
    {
        $historia = Historia::find($historia_id);
        $patient = $historia->paciente;

        return view('tratamientos.all', ['historia' => $historia,
            'patient' => $patient->user, 'patient_id' => $patient->id
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'historia_id' => ['required', 'exists:historias,id'],
            'titulo' => ['required', 'string', 'max:255'],
            'file' => ['mimes:pdf,png,jpg,jpeg,doc,docx,xls,xlsx,zip,rar', 'max:10240']
        ]);

        $folder = 'tratamientos';

        if ($request->file('file')) {
            $fileName = time().'_'.str_replace('+', '_', $request->file->getClientOriginalName());
            $filePath = $request->file('file')->storeAs($folder, $fileName, 'public');

            $trat = Tratamiento::create([
                'historia_id' => $request->historia_id,
                'tratamiento' => $request->titulo,
                'prox_control' => $request->prox_control,
                'descripcion' => $request->descripcion,
                'url' => '' . $filePath
            ]);
        }
        else {
            $trat = Tratamiento::create([
                'historia_id' => $request->historia_id,
                'tratamiento' => $request->titulo,
                'prox_control' => $request->prox_control,
                'descripcion' => $request->descripcion
            ]);
        }

        if ($request->created_at) {
            $trat->created_at = $request->created_at;
            $trat->save();
        }

        return back();
    }

    public function update(Request $request, $id)
    {
        // dd($request);

        $request->validate([
            'edit_titulo' => ['required', 'string', 'max:255'],
            'edit_file' => ['mimes:pdf,png,jpg,jpeg,doc,docx', 'max:2048']
        ]);

        $folder = 'tratamientos';

        $tratamiento = Tratamiento::find($id);

        if ($request->file('edit_file')) {

            //dd($request->file('lab_edit_file'));

            if(File::exists(public_path('storage/' . $tratamiento->url))) {
                File::delete(public_path('storage/' . $tratamiento->url));
            }
            else {
                //dd('File does not exists: ' . 'storage/' . public_path($tratamiento->url));
            }

            $fileName = time().'_'.str_replace('+', '_', $request->edit_file->getClientOriginalName());
            $filePath = $request->file('edit_file')->storeAs($folder, $fileName, 'public');

            $tratamiento->url = '' . $filePath;
        }
        else if ($request->file('edit_file2')) {
            $fileName = time().'_'.str_replace('+', '_', $request->edit_file2->getClientOriginalName());
            $filePath = $request->file('edit_file2')->storeAs($folder, $fileName, 'public');

            $tratamiento->url = '' . $filePath;
        }

        $tratamiento->tratamiento = $request->edit_titulo;
        $tratamiento->descripcion = $request->edit_descripcion;
        $tratamiento->prox_control = $request->edit_prox_control;
        if ($request->created_at_edit) {
            $tratamiento->created_at = $request->created_at_edit;
        }
        $tratamiento->save();

        return back();
    }

    public function destroy($id)
    {
        $result = Tratamiento::findOrFail($id);

        if(File::exists(public_path('storage/' . $result->url))) {
            File::delete(public_path('storage/' . $result->url));
        }
        else {
            // dd('File does not exists.' . 'storage/' . public_path($result->url));
        }

        $result->delete();

        return back();
    }
}
