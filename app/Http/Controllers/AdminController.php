<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\admin;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admins = User::where('user_role_id', 4)->orderBy('created_at', 'desc')->get();
        return view('admins.all', ['admins' => $admins]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $admin_next_id = DB::select("SHOW TABLE STATUS LIKE 'users'");
        return view('admins.create', ['admin_next_id' => $admin_next_id]);
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
            'num_document' => ['required', 'string', 'max:50', 'unique:users'], // 'confirmed'
            'first_names' => ['required', 'string', 'max:255'],
            'last_name1' => ['required', 'string', 'max:255'],
            'last_name2' => ['required', 'string', 'max:255'],
            'otros' => ['required', 'string', 'max:255']
        ]);

        $user = User::create([
            'user_role_id' => 4,
            'num_document' => $request->num_document,
            'first_names' => $request->first_names,
            'last_name1' => $request->last_name1,
            'last_name2' => $request->last_name2,
            'email' => $request->email,
            'otros' => $request->otros,
            'password' => Hash::make($request->otros),
        ]);

        $user->save();

        return redirect(route('admins.create', $user->id));
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
        $admin = User::find($id);
        if ($admin && $admin->user_role_id === 4) {
            return view('admins.edit', ['admin' => $admin]);
        }
        else {
            return redirect(route('admins.all'));
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
        $admin = User::find($id);

        $request->validate([
            'first_names' => ['required', 'string', 'max:255'],
            'last_name1' => ['required', 'string', 'max:255'],
            //'last_name2' => ['required', 'string', 'max:255'],
            'num_document' => ['required', 'string', 'max:50', 'unique:users,num_document,'.$admin->id], // 'confirmed'
            'otros' => ['required', 'string', 'max:255'],
            //'email' => ['unique:users,email,'.$admin->id], 
        ]);

        $admin->num_document = $request->num_document;
        $admin->first_names = $request->first_names;
        $admin->last_name1 = $request->last_name1;
        $admin->last_name2 = $request->last_name2;
        $admin->email = $request->email;
        $admin->otros = $request->otros;
        $admin->password = Hash::make($request->otros);

        $admin->save();

        return redirect(route('admins.all', $id));
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
            return redirect(route('admins.all'));
        }

        // Get field names from header column
        $fields = array_map('strtolower', $records[0]);

        // Remove the header column
        array_shift($records);

        foreach ($records as $record) {
            if (count($fields) != count($record)) {
                return redirect(route('admins.all'));
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
            $admin = explode(' ', $data['admin']);
            $last_names = !empty($admin) ? implode(' ', [$admin[0], $admin[1]]) : NULL;
            if (!empty($admin)) {
                array_splice($admin, 0, 2);
                $first_names = implode(' ', $admin);
            }

            $user = User::create([
                'user_role_id' => 4,
                'num_document' => $first_names,
                'otros' => $data['﻿dni'] ? $data['﻿dni'] : NULL, //﻿
                'first_names' => $first_names,
                'last_names' => $last_names,
                'email' => $data['email'] ? $data['email'] : NULL,
                'password' => Hash::make($data['﻿dni'] ? $data['﻿dni'] : 'yabaja2031')
            ]);
        }

        return redirect(route('admins.all'));
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
