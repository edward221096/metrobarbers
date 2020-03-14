<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //displaying All User Data
        $users = DB::table('users')
            ->whereIn('Role', ['Barber', 'Receptionist'])
            ->paginate(5);

        return view('sidebar.employees', compact('users'));
    }

    public function search(Request $request)
    {
        if($request->ajax())
        {
            $output="";
            $employee=DB::table('users')->where('name','like','%'.$request->search."%")->get();

            if ($employee)
            {
                foreach($employee as $key => $employee){
                    $output='<tr>'.
                        '<td>.$employee->id</td>'.
                        '<td>.$employee->name</td>'.
                        '<td>.$employee->role</td>'.
                        '<td>.$employee->address</td>'.
                        '<td>.$employee->phonenumber</td>'.
                        '</tr>';
                }

                return Response($output);
            }
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Get the view of employee.blade.php
     return view('sidebar.employees');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validation of the inputted data
        $this->validate($request, [
            'name' => 'required',
            'email' => 'email|required',
            'username' => 'required',
            'password' => 'required|min:6',
            'role' => 'required'
        ]);
        //Get all the data in the textboxes
        $users = new User();

        $users->name = request('name');
        $users->email = request('email');
        $users->username = request('username');
        $users->role = request('role');
        $users->address = request('address');
        $users->phonenumber = request('phonenumber');
        $users->password = bcrypt(request('password'));
        //save to the database
        $users->save();

        //return the view after saving to sidebar.employees.blade.php
        return redirect('/employees');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //Validation of the inputted data
        $this->validate($request, [
            'name' => 'required',
            'email' => 'email|required',
            'username' => 'required',
            'role' => 'required'
        ]);

        $users = User::findorfail($request->employee_id);
        $users -> update($request->all());
        return back();
    }


    public function destroy($id)
    {

        if(User::count() > 1){
            User::destroy($id);
        }

        return redirect('/employees');

    }
}
