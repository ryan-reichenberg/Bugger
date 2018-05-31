<?php

namespace Bugger\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Bugger\Ticket;
use Bugger\User;
use Bugger\Project;

class TicketsController extends Controller
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
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){}
    public function createTicket($id)
    {
        $users = User::all();
        $project = Project::find($id);
        return View('tickets.create')->with('users', $users)->with('project', $project);
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
            'membersTickets.required' => 'You need to assign at least one member to this ticket',
        ];
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'membersTickets' => 'required',
        ], $messages);
        if ($validator->fails()) {
            return redirect()->route('tickets.create', ['id'=> 4])
                ->withErrors($validator)
                ->withInput();
        }
        $ticket = new Ticket;
        $ticket->name = $request->name;
        $ticket->priority = $request->priority;
        $ticket->description = $request->description;
        $ticket->project_id = $request->project_id;
        $ticket->save();
        if($request->members != ''){
            $user_ids = array_map('intval', explode(',', $request->members));
            $ticket->members()->sync($user_ids);
        }
        return redirect()->route('projects.show', ['id'=> $request->project_id]);



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
