<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patients = User::where('user_role_id', 3)->get();
        return view('patients.all', ['patients' => $patients]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('patients.create');
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
            'num_document' => ['required', 'string', 'max:11', 'confirmed', 'unique:users'],
            'first_names' => ['required', 'string', 'max:255'],
            'last_names' => ['required', 'string', 'max:255']
        ]);

        $patient = User::create([
            'user_role_id' => 3,
            'num_document' => $request->num_document,
            'first_names' => $request->first_names,
            'last_names' => $request->last_names,
            'password' => Hash::make($request->num_document),
        ]);

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
        $patient = User::where('user_role_id', 3)->where('id', $id)->first();
        if ($patient) {
            return view('patients.edit', ['patient' => $patient]);
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
        $request->validate([
            'first_names' => ['required', 'string', 'max:255'],
            'last_names' => ['required', 'string', 'max:255']
        ]);

        $patient = User::find($id);
        $patient->first_names = $request->first_names;
        $patient->last_names = $request->last_names;

        $patient->save();

        return redirect(route('patients.edit', $patient->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $patient = User::findOrFail($id);

        foreach($patient->results as $result) {
            if(File::exists(public_path('storage/' . $result->url))){
                File::delete(public_path('storage/' . $result->url));
            }else{
                // dd('File does not exists.' . 'storage/' . public_path($result->url));
            }
        }

        // $patient->results()->delete();

        $patient->delete();

        return back();
    }
}
