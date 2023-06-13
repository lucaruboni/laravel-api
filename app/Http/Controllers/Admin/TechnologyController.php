<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTechnologyRequest;
use App\Http\Requests\UpdateTechnologyRequest;
use App\Models\Technology;
use Illuminate\Support\Str;

class TechnologyController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $technologies = Technology::all();

        return view('admin.technologies.index', compact('technologies'));
    }

        /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTechnologyRequest $request)
    {

        $val_data = $request->validated();
        $val_data['slug'] = Str::slug($request->name);

        Technology::create($val_data);

        return to_route('admin.technologies.index')->with('message', 'Technology Created Successfully');
    }

        /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTechnologyRequest $request, Technology $technology)
    {
        //dd($request->all());
        $val_data = $request->validated();

        $val_data['slug'] = Str::slug($request->name);

        $technology->update($val_data);

        return to_route('admin.technologies.index')->with('message', 'Technology Updated Successfully');
    }

        /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Technology $technology)
    {
        $technology->delete();

        return to_route('admin.technologies.index')->with('message', 'Technology Deleted Successfully');
    }

}
