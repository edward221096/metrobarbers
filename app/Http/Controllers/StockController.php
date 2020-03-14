<?php

namespace App\Http\Controllers;

use App\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
{
    public function index()
    {
        //displaying All Service Data

        $stock = DB::table('stocks')->paginate(5);

        return view('sidebar.stocks', compact('stock'));
    }

    public function store(Request $request)
    {
//        //Validation of the inputted data
//        $this->validate($request, [
//            'stock_item_name ' => 'required',
//            'quantity' => 'required',
//        ]);


        $stock = new Stock();
        $stock -> stock_item_name = request('stock_item_name');
        $stock -> quantity = request('quantity');
        $stock -> save();

        return back();

    }

    public function update(Request $request)
    {
//        //Validation of the inputted data
//        $this->validate($request, [
//            'stock_item_name ' => 'required',
//            'quantity' => 'required',
//        ]);

        $stock = Stock::findorfail(request()->stock_id);
        $stock -> update(request()->all());
        return back();
    }

    public function destroy($id)
    {
        if(Stock::count() > 1){
            Stock::destroy($id);
        }

        return redirect('/stocks');
    }
}
