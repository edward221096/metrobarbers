<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class ChartController extends Controller
{
    public function totalsalesperservice(){
        $result = DB::table('sessions')
            ->Join('services', 'services.id', '=', 'sessions.service_id')
            ->select(DB::raw('sum(sessions.sales) as sales'),'services.service_name')
            ->groupBy('services.service_name')
            ->orderBy('sessions.sales', 'desc')
            ->get();

        return response()->json($result);
    }

    public function totalsalesperemployee(){
        $result = DB::table('sessions')
            ->Join('users', 'users.id', '=', 'sessions.employee_id')
            ->select(DB::raw('sum(sessions.sales) as sales'), 'users.name')
            ->whereIn('users.role', ['Barber', 'Receptionist'])
            ->groupBy('users.name')
            ->orderby('sessions.sales', 'desc')
            ->get();

        return response()->json($result);

    }

    public function totalsalesperday(){
        $result = DB::table('sessions')
            ->select(DB::raw('sum(sessions.sales) as sales, date(sessions.end_time) as date'))
            ->groupBy('date')
            ->orderby('date', 'asc')
            ->get();

        return response()->json($result);

    }
}
