<?php

namespace Bugger\Http\Controllers;

use Illuminate\Http\Request;
use Bugger\User;
use Bugger\Project;
use Illuminate\Support\Facades\Validator;

class ProjectsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $users = User::all();
        return View('projects.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        return View('projects.create')->with('users', $users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messages = [
            'members.required' => 'You need to assign at least one member to this project',
        ];
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
        ], $messages);

        if ($validator->fails()) {
            return redirect()->route('projects.create')
                ->withErrors($validator)
                ->withInput();
        }
        $project = new Project;
        $project->name = $request->name;
        $project->description = $request->description;
        $project->save();
        if($request->members != ''){
            $user_ids = array_map('intval', explode(',', $request->members));
            $project->members()->sync($user_ids);
        }
        redirect('projects');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $project = Project::find($id);
        $users = User::all();
        return view('projects.show')->with('project', $project)->with('users', $users);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project = Project::find($id);
        $users = User::all();
        return view('projects.edit')->with('project', $project)->with('users', $users);
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
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('projects.edit')
                ->withErrors($validator)
                ->withInput();
        }
        $project = Project::find($id);
        $project->name = $request->name;
        $project->description = $request->description;
        $project->save();
        return redirect()->route('projects')->with('alert-info','Successfully updated project information');

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
    public function addMember(Request $request){
        $project = Project::find($request->project_id);
        if($request->members != ''){
            $user_ids = array_map('intval', explode(',', $request->members));
            $project->members()->sync($user_ids, false);
        }
        return redirect()->route('projects.show', ['id'=>$request->project_id]);
    }
    public function removeMember($project_id, $user_id){
        $project = Project::find($project_id);
        $project->members()->detach($user_id);
        foreach($project->tickets as $ticket){
            $ticket->members()->detach($user_id);
        }
        return redirect()->route('projects.show', ['id'=>$project_id])->with('alert-info','Successfully unassigned member');
    }
}
