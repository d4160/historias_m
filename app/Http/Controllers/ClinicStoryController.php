<?php

namespace App\Http\Controllers;

use App\Models\ClinicStory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;

class ClinicStoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('results.all');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'user_id' => ['required', 'exists:users,id'],
            'title' => ['required', 'string', 'max:255'],
            'file' => ['required', 'mimes:pdf,png,jpg,jpeg,doc,docx,xls,xlsx,zip,rar', 'max:10240']
        ]);

        if ($request->file('file')) {
            $fileName = time().'_'.$request->file->getClientOriginalName();
            $filePath = $request->file('file')->storeAs('results', $fileName, 'public');

            ClinicStory::create([
                'user_id' => $request->user_id,
                'title' => $request->title,
                'description' => $request->description,
                'url' => '' . $filePath
            ]);
        }

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OnlineResult  $onlineResult
     * @return \Illuminate\Http\Response
     */
    public function show(ClinicStory $onlineResult)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OnlineResult  $onlineResult
     * @return \Illuminate\Http\Response
     */
    public function edit(ClinicStory $onlineResult)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OnlineResult  $onlineResult
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'edit_title' => ['required', 'string', 'max:255'],
            'edit_file' => ['mimes:pdf,png,jpg,jpeg,doc,docx', 'max:2048']
        ]);

        $onlineResult = ClinicStory::find($id);

        if ($request->file('edit_file')) {

            if(File::exists(public_path('storage/' . $onlineResult->url))) {
                File::delete(public_path('storage/' . $onlineResult->url));
            }
            else {
                //dd('File does not exists: ' . 'storage/' . public_path($onlineResult->url));
            }

            $fileName = time().'_'.$request->edit_file->getClientOriginalName();
            $filePath = $request->file('edit_file')->storeAs('results', $fileName, 'public');

            $onlineResult->url = '' . $filePath;
        }

        $onlineResult->title = $request->edit_title;
        $onlineResult->description = $request->edit_description;
        $onlineResult->save();

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OnlineResult  $onlineResult
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = ClinicStory::findOrFail($id);

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
