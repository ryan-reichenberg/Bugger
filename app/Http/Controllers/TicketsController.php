<?php

namespace Bugger\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Bugger\Ticket;
use Bugger\User;
use Bugger\Project;
use Bugger\Tag;

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
            return redirect()->route('tickets.create', ['id'=> $request->project_id])
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
        $ticket = Ticket::find($id);
        $users = User::all();
        $tags = Tag::all()->diff($ticket->tags);
        return view('tickets.show')->with('ticket', $ticket)->with('users', $users)->with('tags', $tags);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ticket = Ticket::find($id);
        $users = User::all();
        return View('tickets.edit')->with('ticket', $ticket)->with('users', $users);
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
            return redirect()->route('tickets.edit')
                ->withErrors($validator)
                ->withInput();
        }
        $ticket = Ticket::find($id);
        $ticket->name = $request->name;
        $ticket->description = $request->description;
        $ticket->save();
        return redirect()->route('tickets.show',$ticket)->with('alert-info','Successfully updated ticket information');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ticket = Ticket::find($id);
        $project_id = $ticket->project->id;
        $ticket->delete();
        return redirect()->route('projects.show', $project_id)->with('alert-info','Successfully deleted ticket');
    }
    public function addMember(Request $request){
        $ticket = Ticket::find($request->ticket_id);
        if($request->members != ''){
            $user_ids = array_map('intval', explode(',', $request->members));
            $ticket->members()->sync($user_ids, false);
        }
        return redirect()->route('tickets.show', ['id'=>$request->ticket_id]);
    }
    public function removeMember($ticket_id, $user_id){
        $ticket = Ticket::find($ticket_id);
        $ticket->members()->detach($user_id);
        return redirect()->route('tickets.show', ['id'=>$ticket_id])->with('alert-info','Successfully unassigned member');
    }
    public function changePriority(Request $request){
        $ticket = Ticket::find($request->ticket_id);
        if( $ticket->priority == $request->priority){
            return redirect()->route('tickets.show', ['id'=>$request->ticket_id])->withErrors(['Cannot update priority']);
        }else {
            $ticket->priority = $request->priority;
            $ticket->save();
            return redirect()->route('tickets.show', ['id' => $request->ticket_id])->with('alert-info', 'Successfully updated priority');
        }
    }
    public function addTags(Request $request){
        $ticket = Ticket::find($request->ticket_id);
        $ticket->tags()->sync($request->input('tags'), false);
        return redirect()->route('tickets.show', ['id'=>$request->ticket_id])->with('alert-info','Successfully added tags');
    }
    public function removeTag($ticket_id, $tag_id){
            $ticket = Ticket::find($ticket_id);
            $ticket->tags()->detach($tag_id);
            return redirect()->route('tickets.show', ['id'=>$ticket_id])->with('alert-info','Successfully removed tag');
    }
    public function selfAssign($ticket_id, $user_id){
        $ticket = Ticket::find($request->ticket_id);
        $ticket->members()->attach($user_id);
        return redirect()->route('tickets.show', ['id'=>$ticket_id])->with('alert-info','Successfully removed tag');
    }
    public function closeTicket($ticket_id){
        $ticket = Ticket::find($ticket_id);
        $ticket->closed = true;
        $ticket->save();
        return redirect()->route('tickets.show', ['id'=>$ticket_id])->with('alert-info','Successfully closed ticket');
    }
    public function openTicket($ticket_id){
        $ticket = Ticket::find($ticket_id);
        $ticket->closed = false;
        $ticket->save();
        return redirect()->route('tickets.show', ['id'=>$ticket_id])->with('alert-info','Successfully opened ticket');
    }
}
