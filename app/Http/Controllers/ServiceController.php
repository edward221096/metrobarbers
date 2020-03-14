<?php

namespace App\Http\Controllers;

use App\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServiceController extends Controller
{
    public function index()
    {
        //displaying All Service Data

        $service = DB::table('services')->get();

        return view('sidebar.services', compact('service'));
    }

    public function store(Request $request)
    {
        //Validation of the inputted data
        $this->validate($request, [
            'service_name' => 'required',
            'description' => 'required',
            'cost' => 'required',
            'image' => 'required'
        ]);

        $service = new service();
        $service->service_name = $request->input('service_name');
        $service->description = $request->input('description');
        $service->cost = $request->input('cost');

        If ($request->hasFile('image')){
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension(); //getting the image extensions
            $filename = time() . '.' . $extension;
            $file->move('uploads/service/', $filename);
            $service->image = $filename;
        } else {
            return $request;
            $service->image='';
        }
        $service->save();

        return back()->with('service', $service);
    }

    public function display(){
        $service = Service::all();
        return view('sidebar.services', compact('service'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function update(Request $request, $id){

        //Validation of the inputted data
        $this->validate($request, [
            'service_name' => 'required',
            'description' => 'required',
            'cost' => 'required',
            'image' => 'required'
        ]);

        $service = Service::findorfail($id);

        $service->service_name = $request->input('service_name');
        $service->description = $request->input('description');
        $service->cost = $request->input('cost');

        If ($request->hasFile('image')){
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension(); //getting the image extensions
            $filename = time() . '.' . $extension;
            $file->move('uploads/service/', $filename);
            $service->image = $filename;
        }
        $service->save();

        return redirect('/services')->with('service', $service);
    }

    public function destroy($id)
    {
        if(Service::count() > 1){
            Service::destroy($id);
        }

        return redirect('/services');
    }
}
