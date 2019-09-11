<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Filesystem\Filesystem;


use App\Project;
use App\Services\Twitter;


class ProjectsController extends Controller
{
    //
    public function __construct() 
    {
        // this middleware will apply to all functions in the controller
        $this->middleware('auth');

        // below examples to control which functions are handled by auth middleware
        // $this->middleware('auth')->only(['index']);
        // $this->middleware('auth')->except(['show']);

    }
    public function index() 
    {
        auth()->id(); // returns user id
        auth()->user(); // returns user instance
        auth()->check(); // return boolean describe whether user is signed in
        auth()->guest(); // is the user a guest?

        // $projects =  Project::all();
        $projects =  Project::where('owner_id', auth()->id())->get();

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
        //$twitter = app('twitter');
        
        // dd($twitter);
        // abort_if();
        // abort_unless();
        // \Gate::allows();
        // abort_if (\Gate::denies('update', $project), 403);
        // abort_unless (\Gate::allows('update', $project), 403);
        // auth()->user()->can('update', $project);

        $this->authorize('update', $project);

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
        $this->authorize('update', $project);

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

        $attributes['owner_id'] = auth()->id();
        Project::create( $attributes );

        // $project = new Project();
        // $project->title = request('title');
        // $project->description = request('description');

        // $project->save();

        return redirect('/projects');

    }
}
