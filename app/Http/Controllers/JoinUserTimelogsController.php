<?php

namespace App\Http\Controllers;

use App\User;
use App\Timelogs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class JoinUserTimelogsController extends Controller
{
    public function index()
    {
        $employee = DB::table('users')
            ->leftJoin('timelogs', 'users.id', '=', 'timelogs.user_id')
            ->select('timelogs.id as tid', 'users.id as uid','users.name', 'users.role', 'timelogs.day', 'timelogs.status', 'timelogs.timein', 'timelogs.timeout')
            ->whereIn('users.role', ['Barber', 'Receptionist'])
            ->orderby('timelogs.id', 'desc')
            ->paginate(7);
        return view ('sidebar.employeestimeinout', compact('employee'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'id' => 'required',
            'status' => 'required'
        ]);

        $timelogs = new Timelogs();
        $timelogs->user_id = request('id');
        $timelogs->status = request('status');
        $timelogs->day = Carbon::now()->format('Y-m-d');
        $timelogs->timein = Carbon::now()->settimezone('GMT+8')->format('H:i:s');
        $timelogs->save();

        return redirect('/employeestimeinout');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Timelogs  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee = Timelogs::find($id);
        return view('sidebar.employeestimeinout', compact('employee', 'id'));
    }

    public function update($id){
            $employee = Timelogs::find($id);
            $employee->timeout = date('H:i:s',time());
            $employee->save();
            return redirect('/employeestimeinout');
    }
}//end of script
