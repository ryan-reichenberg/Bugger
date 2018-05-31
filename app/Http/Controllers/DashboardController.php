<?php

namespace Bugger\Http\Controllers;

use Illuminate\Http\Request;
use Bugger\Ticket;
use Bugger\User;

class DashboardController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tickets = Ticket::all();
        $users = User::all();
        return view('dashboard')->with('tickets', $tickets)->with('users', $users);
    }
}
