<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Project;

class ProjectsController extends Controller
{
    //
    public function index() 
    {
        $projects =  Project::all();

        return view('projects.index', ['projects' => $projects] );
    }

    public function create() 
    {
        return view('projects.create');
    }

    public function show(Project $project) 
    {
        // replaced by route model binding in parameter
        //$project  = Project::findOrFail($id);
     
        

        return view('projects.show', compact('project'));

    }

    public function edit(Project $project)  // example.com/2/edit
    {
        //$project  = Project::findOrFail($id);

        return view('projects.edit', compact('project'));
    }

    public function update(Project $project) 
    {
        //$project = Project::findOrFail($id);

        $project->update(request(['title', 'description']));

        // $project->title = request('title');
        // $project->description = request('description');

        // $project->save();

        return redirect('/projects');
    }

    public function destroy(Project $project)
    {
        $project->delete();

        return redirect('/projects');

    }

    public function store() 
    {
        // redirects back to same page if validation fails,
        // also returns validated attributes
        $attributes = request()->validate(
                [
                'title' => ['required', 'min:3'],
                'description' => ['required', 'min:3']
                ]
            );

        Project::create( $attributes );

        // $project = new Project();
        // $project->title = request('title');
        // $project->description = request('description');

        // $project->save();

        return redirect('/projects');

    }
}
