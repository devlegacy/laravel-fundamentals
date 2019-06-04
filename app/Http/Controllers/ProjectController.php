<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Entities\Project;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $portfolio = [
        //   ['title' => 'Proyecto #1'],
        //   ['title' => 'Proyecto #2'],
        //   ['title' => 'Proyecto #3'],
        //   ['title' => 'Proyecto #4'],
        // ];
        // $portfolio = DB::table('projects')->get();
        $projects = Project::latest('created_at')->paginate(2); //Project::orderBy('created_at', 'DESC')->get(); //Project::all();

        return view('projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('projects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fields = request()->validate([
          'title' => 'required',
          'description' => 'required',
        ]);
        $fields = array_merge($fields, ['slug'=>Str::slug(request('title'))]);

        // request()->all();
        // request()->only(['title','description']);
        // Project::create([
        //   'title'=> request('title'),
        //   'description'=> request('description'),
        //   'slug'=> Str::slug(request('title')),
        // ]);
        Project::create($fields);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        //
        // $project = Project::findOrFail($project);
        return view('projects.show', compact('project'));
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
