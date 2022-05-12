<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Customers;
use App\Model\Sell;
use App\Model\SellRows;

use Illuminate\Support\Facades\Log;

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
        return view('home');
    }

    public function viewCustomers()
    {
        $data = Customers::paginate(1);
        return view('customers')->with(compact('data'));
    }

    public function viewCustomer(Request $request)
    {   
        $data = Sell::with('customer')->whereHas('customer', function($qry) use ($request){
                    $qry->where('id', $request->id);
                })->get();
        return view('customer')->with(compact('data'));
    }

    public function viewBill(Request $request)
    {    
        $sell = Sell::where('id', '=', $request->id)->with('sellrows')->with('customer')->get();

        $users = $sell[0]->sellrows->map(function ($user) {
          return collect($user)->only(['id']);
        });
        
        $data_new = customFilter($sell); 

        // Log::info('view bill 1' . json_encode($data_new1['price'], JSON_PRETTY_PRINT)); 
        
        $denomination = denomination(abs($sell[0]->balance_payable_to_customer));
        
        $balance_denomination_500 = $denomination['balance_denomination_500'];
        $balance_denomination_50 = $denomination['balance_denomination_50'];
        $balance_denomination_20 = $denomination['balance_denomination_20'];
        $balance_denomination_10 = $denomination['balance_denomination_10'];
        $balance_denomination_5 = $denomination['balance_denomination_5'];
        $balance_denomination_2 = $denomination['balance_denomination_2'];
        $balance_denomination_1 = $denomination['balance_denomination_1'];

        $data = [ 
            'bill_number' => $request->id,
            'email' => $sell[0]->customer->email,
            'price' => $data_new['price'],
            'sku' => $data_new['sku'],
            'qty' => $data_new['qty'],
            'tax' => $data_new['tax'],
            'tax_amount' => $data_new['tax_amount'],
            'sub_total' => $data_new['sub_total'],

            'total_price_without_tax' => $sell[0]->total_price_without_tax,
            'total_tax_payable' => $sell[0]->total_tax_payable, 
            'net_total' => $sell[0]->net_total, 
            'net_total_rounded_down' => $sell[0]->net_total_rounded_down,
            'balance_payable_to_customer' => $sell[0]->balance_payable_to_customer, 
            
            'denomination_500' => $balance_denomination_500,
            'denomination_50' => $balance_denomination_50,
            'denomination_20' => $balance_denomination_20,
            'denomination_10' => $balance_denomination_10,
            'denomination_5' => $balance_denomination_5,
            'denomination_2' => $balance_denomination_2,
            'denomination_1' => $balance_denomination_1, 

            'view' => true,
        ];

        return view('print')->with(compact('data'));

        // $data = Customers::find($request->id)->with('bills')->get();  
        // return view('customer')->with(compact('data'));
    }
}
