<?php

namespace App\Http\Controllers;

use App\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //displaying All Service Data

        $service = DB::table('services')->get();

        return view('home', compact('service'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'userid' => 'required',
            'servid' => 'required',
            'emp_id' => 'required',
            'datetime' => 'required'
        ]);

        $session = new Session();
        $session->user_id = $request->input('userid');
        $session->service_id = $request->input('servid');
        $session->employee_id = $request->input('emp_id');
        $session->start_time = $request->input('datetime');
        $session->save();

        return back();
    }
}
