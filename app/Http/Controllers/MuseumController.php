<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entities\Museum;
use Illuminate\Support\Facades\Validator;

class MuseumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $museums = Museum::all();
        return view('museums.index', compact('museums'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('museums.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
          'name' => 'required',
          'description' => 'required',
        ];
        $messages = [
          'name.required' => 'El campo "nombre" es obligatorio',
          'name.description' => 'El campo "descripción" es obligatorio',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return back()
            ->withErrors($validator)
            ->withInput()
            ->with('error', 'No fue posible crear el museo, verifique sus datos');
        }

        $museum               = new Museum();
        $museum->name         = request('name');
        $museum->description  = request('description');
        $museum->phone        = '';
        $museum->rating       = 4.8;
        $museum->address      = '';
        $museum->hours        = '';
        $museum->save();

        return redirect()
            ->route('museums.index')
            ->with('info', 'Museo creado exitosamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $museum = Museum::findOrFail($id);
        return view('museums.show', compact('museum'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
