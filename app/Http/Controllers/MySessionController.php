<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MySessionController extends Controller
{
    public function index(){
        //displaying All Service Data

        $session = DB::table('sessions')
            ->rightJoin('users', 'users.id', '=', 'sessions.user_id')
            ->rightJoin('services', 'services.id', '=', 'sessions.service_id')
            ->rightJoin('vw_employee', 'vw_employee.id', '=', 'sessions.employee_id')
            ->select('sessions.id as SID', 'services.id as SERVID', 'users.name as customer_name',
                'vw_employee.name as employee_name', 'services.service_name',
                'sessions.start_time', 'sessions.end_time','services.cost', 'sessions.paid_amount', 'sessions.change_amount')
            ->where('users.role', '=', 'User')
            ->where('users.name', '=', Auth::User()->name)
            ->orderby('sessions.start_time', 'desc')
            ->paginate(7);
        return view ('sidebar.mysessions', compact('session'));
    }
}
