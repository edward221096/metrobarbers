<?php

namespace App\Http\Controllers;

use App\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SessionController extends Controller
{
    public function index()
    {
        //displaying All Service Data

        $session = DB::table('sessions')
            ->rightJoin('users', 'users.id', '=', 'sessions.user_id')
            ->rightJoin('services', 'services.id', '=', 'sessions.service_id')
            ->rightJoin('vw_employee', 'vw_employee.id', '=', 'sessions.employee_id')
            ->select('sessions.id as SID', 'services.id as SERVID', 'users.name as customer_name',
                'vw_employee.name as employee_name', 'services.service_name',
                'sessions.start_time', 'sessions.end_time','services.cost', 'sessions.paid_amount', 'sessions.change_amount')
            ->where('users.role', '=', 'User')
            ->orderBy('sessions.id', 'desc')
            ->paginate(7);
        return view ('sidebar.sessions', compact('session'));
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'session_id' => 'required',
            'paid_amount' => 'required',
            'change_amount' => 'required',
            'cost' => 'required',
            'end_time' => 'required'
        ]);



        $session = Session::where('id',$request->session_id)
            ->update(['paid_amount'=>$request->paid_amount,
                'change_amount'=>$request->change_amount,
                'sales'=>$request->cost,
                'end_time'=> $request->end_time]);

        return back();

    }

    public function search(Request $request){
        $search = $request->get('search');

        //displaying All Service Data

        $session = DB::table('sessions')
            ->rightJoin('users', 'users.id', '=', 'sessions.user_id')
            ->rightJoin('services', 'services.id', '=', 'sessions.service_id')
            ->rightJoin('vw_employee', 'vw_employee.id', '=', 'sessions.employee_id')
            ->select('sessions.id as SID', 'services.id as SERVID', 'users.name as customer_name',
                'vw_employee.name as employee_name', 'services.service_name',
                'sessions.start_time', 'sessions.end_time','services.cost', 'sessions.paid_amount', 'sessions.change_amount')
            ->Where('users.name', 'like', '%'.$search.'%')
            ->WhereNotIn('users.role', ['Barbers', 'Receptionist'])
            ->paginate(7);
        return view ('sidebar.sessions', ['session' => $session]);
    }
}
