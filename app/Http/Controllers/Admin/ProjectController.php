<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use App\Models\Type;
use App\Models\Technology;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use \Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Auth::user()->projects()->with('technologies')->orderByDesc('id')->paginate(8);
       

        return view('admin.projects.project', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $types = Type::orderByDesc('id')->get();
        $technologies = Technology::orderByDesc('id')->get();
        return view('admin.projects.create', compact('types', 'technologies'));

        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProjectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectRequest $request)
    {
       // dd($request->all());
        $val_data = $request->validated();
        // generate the title slug
        $slug = Project::generateSlug($val_data['title']);
        //dd($slug);
        $val_data['slug'] = $slug;
        $val_data['user_id'] = Auth::id();


        if ($request->hasFile('cover_image')) {
            $image_path = Storage::put('uploads', $request->cover_image);
            $val_data['cover_image'] = $image_path;
        }

        // Create the new Post
        $new_project = Project::create($val_data);

                // Attach the checked technologies
                if ($request->has('technologies')) {
                    $new_project->technologies()->attach($request->technologies);
                }
        
        // redirect back
        return to_route('admin.projects.index')->with('message', 'project Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $types = Type::orderByDesc('id')->get();
        $technologies = Technology::orderByDesc('id')->get();

        if (Auth::id() === $project->user_id) {
            return view('admin.projects.edit', compact('project', 'types', 'technologies'));
        }
        abort(403);
        

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProjectRequest  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $val_data = $request->validated();

        $project->update($val_data);

        if ($request->hasFile('cover_image')) {

            if ($project->cover_image) {
                Storage::delete($project->cover_image);
            }

            $image_path = Storage::put('uploads', $request->cover_image);
            $val_data['cover_image'] = $image_path;
        }

        if ($request->has('technologies')) {
            $project->technologies()->sync($request->technologies);
        }

        return to_route('admin.projects.index')->with('message', 'project updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {

        
        if ($project->cover_image) {
            Storage::delete($project->cover_image);
        }
        
        $project->delete();
        return to_route('admin.projects.index')->with('message', 'project deleted');
    }
}
