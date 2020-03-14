<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customer = DB::table('users')
            ->select('id', 'name', 'role','address', 'email', 'username', 'phonenumber', 'gender', 'membership_type')
            ->where('role', '=', 'User')
            ->paginate(10);
        return view ('sidebar.customers', compact('customer'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function update(Request $request)
    {
        //Validation of the inputted data
        $this->validate($request, [
            'name' => 'required',
            'username' => 'required',
            'email' => 'required',
        ]);

        $customer = Customer::findorfail($request->customer_id);
        $customer -> update($request->all());
        return back();
    }

    public function destroy($id)
    {
        if(Customer::count() > 1){
            Customer::destroy($id);
        }

        return redirect('/employees');
    }
}
