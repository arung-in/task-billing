<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Model\Product;
use App\Model\Sell;
use App\Model\SellRows;
use App\Model\Customers;
use Notification;
use App\Notifications\SellNotification;
use App\User;

use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;

class BillingController extends Controller
{ 
 

    public function createBill()
    {    	
    	$products = Product::get(['id', 'sku']);
    	// Log::info('create' . json_encode($products, JSON_PRETTY_PRINT));
    	return view('billing')->with(compact('products'));
    }

    public function taxCalculation($price, $qty, $tax)
    {
    	$tax = round( (($price*$tax)/100)*$qty, 2);
    	return $tax;
    }

    public function subTotalCalculation($price, $qty, $tax)
    {
    	$sub_total = round( ($price*$qty) + $tax, 2);
    	return $sub_total;
    }

    public function rowCalculations($pass_parameters, $value, $qty)
    {
 

    	$denomination_500 = $pass_parameters['denomination_500'];
    	$denomination_50 = $pass_parameters['denomination_50'];
    	$denomination_20 = $pass_parameters['denomination_20'];
    	$denomination_10 = $pass_parameters['denomination_10'];
    	$denomination_5 = $pass_parameters['denomination_5'];
    	$denomination_2 = $pass_parameters['denomination_2'];
    	$denomination_1 = $pass_parameters['denomination_1'];

   		$total_payment = $pass_parameters['total_payment'];

    	$products = Product::where('id', $value)->get(['id', 'sku', 'price', 'tax']);
    	$price = $products[0]->price;
    	$sku = $products[0]->sku;
    	$tax = $products[0]->tax;
    	$quantity = $qty;

    	$tax_amount = $this->taxCalculation($price, $quantity, $tax);
    	$sub_total = $this->subTotalCalculation($price, $quantity, $tax_amount);
		
		// Log::info('save 2' . json_encode($products, JSON_PRETTY_PRINT));

    	$response = [
    		'price' => $price,
    		'sku' => $sku,
	    	'tax' => $tax,
	    	'quantity' => $quantity,
	    	'tax_amount' => $tax_amount,
	    	'sub_total' => $sub_total,
    	];
    	return $response;
    }
    public function saveBill(Request $request)
    {

    	
    	$request->validate([
            'email' => 'required|string|email',
            'cash' => 'required',
            // 'sku' => 'required|string',
            // 'qty' => 'required',
        ]);

    	$denomination_500 = 0;
    	$denomination_50 = 0;
    	$denomination_20 = 0;
    	$denomination_10 = 0;
    	$denomination_5 = 0;
    	$denomination_2 = 0;
    	$denomination_1 = 0;

    	$req_1 = $request->denominationa ?? 0;
	    $req_2 = $request->denominationb ?? 0;
	    $req_3 = $request->denominationc ?? 0;
	    $req_4 = $request->denominationd ?? 0;
	    $req_5 = $request->denominatione ?? 0;
	    $req_6 = $request->denominationf ?? 0;
	    $req_7 = $request->denominationc ?? 0;

	    $denomination_500 = $req_1*500;
	    $denomination_50 = $req_2*50;
	    $denomination_20 = $req_3*20;
	    $denomination_10 = $req_4*10;
	    $denomination_5 = $req_5*5;
	    $denomination_2 = $req_6*2;
	    $denomination_1 = $req_7*1;

	    // $total_payment = $denomination_500 + $denomination_50 + $denomination_20 + $denomination_10 + $denomination_5 + $denomination_2 + $denomination_1;

	    $total_payment = $request->cash;

    	$pass_parameters = [
    		
    		'req_1' => $req_1,
    		'req_2' => $req_2,
    		'req_3' => $req_3,
    		'req_4' => $req_4,
    		'req_5' => $req_5,
    		'req_6' => $req_6,
    		'req_7' => $req_7,

    		'denomination_500' => $denomination_500,
    		'denomination_50' => $denomination_50,
    		'denomination_20' => $denomination_20,
    		'denomination_10' => $denomination_10,
    		'denomination_5' => $denomination_5,
    		'denomination_2' => $denomination_2,
    		'denomination_1' => $denomination_1,

    		'total_payment' => $total_payment,
    	];

    	$skus = array();
    	$sub_total = array();
    	$price = array();
    	$sku = array();
    	$tax = array();
    	$tax_amount = array();
    	$quantity = array();
    	$total_sub_total = 0;
    	$total_price_without_tax = 0;
    	$total_tax_payable = 0;

    	foreach ($request->sku as $key => $value) {
    		$skus[] = $value;
    		$qty = $request->qty[$key];
    		$response = $this->rowCalculations($pass_parameters, $value, $qty);
    		$sub_total[] = $response['sub_total'];
    		$total_sub_total = $total_sub_total + $response['sub_total'];
    		$price[] = $response['price'];
    		$sku[] = $response['sku'];
    		$tax[] = $response['tax'];
    		$tax_amount[] = $response['tax_amount'];
    		$quantity[] = $qty;
    		$total_price_without_tax = $total_price_without_tax + round($qty*$response['price'],2);
    		$total_tax_payable = $total_tax_payable + $response['tax_amount'];
    		// Log::info('save' . json_encode($request->qty[$key], JSON_PRETTY_PRINT));
    	}
    	
    	$balance_without_abs = floor($total_payment - $total_sub_total);
    	$balance = abs(floor($total_payment - $total_sub_total));

    	$denomination = denomination($balance);

    	$balance_denomination_500 = $denomination['balance_denomination_500'];
    	$balance_denomination_50 = $denomination['balance_denomination_50'];
    	$balance_denomination_20 = $denomination['balance_denomination_20'];
    	$balance_denomination_10 = $denomination['balance_denomination_10'];
    	$balance_denomination_5 = $denomination['balance_denomination_5'];
    	$balance_denomination_2 = $denomination['balance_denomination_2'];
    	$balance_denomination_1 = $denomination['balance_denomination_1'];

    	$data = [ 
    		'email' => $request->email,
            'price' => $price,
            'sku' => $sku,
            'qty' => $quantity,
            'tax' => $tax,
            'tax_amount' => $tax_amount,
            'sub_total' => $sub_total,

            'total_price_without_tax' => $total_price_without_tax,
            'total_tax_payable' => $total_tax_payable, 
            'net_total' => $total_sub_total,
            'net_total_rounded_down' => floor($total_sub_total),
            'balance_payable_to_customer' => $balance_without_abs,
            
            'denomination_500' => $balance_denomination_500,
            'denomination_50' => $balance_denomination_50,
            'denomination_20' => $balance_denomination_20,
            'denomination_10' => $balance_denomination_10,
            'denomination_5' => $balance_denomination_5,
            'denomination_2' => $balance_denomination_2,
            'denomination_1' => $balance_denomination_1,

            'view' => false,
        ];

        // Log::info('create' . json_encode($data, JSON_PRETTY_PRINT));

        $details = [
            'greeting' => 'Hello ' . $request->email,
            'body' => 'Your purchase/sales order Rs.' . floor($total_sub_total) . ' is completed',
            'thanks' => 'Thank you for testing the Mallow Mini Project!',
            'actionText' => 'View My Site',
            'actionURL' => 'http://arung.in'
        ];  
 		
        $customer = (new Customers())->where([ ['email', '=', $request->email] ])->first();
        if (!$customer) {
        	 $save_customer = (new Customers())->fill([
        	 	'email' => $request->email,
        	 ]);
        	 $save_customer->save();
        	 $customer_id = $save_customer->id;

        	 $save_sales = (new Sell())->fill([
        	 	'customer_id' => $customer_id, 
        	 	'cash' => $total_payment, 
        	 	'total_price_without_tax' => $total_price_without_tax, 
        	 	'total_tax_payable' => $total_tax_payable, 
        	 	'net_total' => $total_sub_total, 
        	 	'net_total_rounded_down' => floor($total_sub_total), 
        	 	'balance_payable_to_customer' => $balance_without_abs,
        	 ]);
        	 $save_sales->save();

        	 foreach ($sku as $key => $value) {
        	 	$save_sell_rows = (new SellRows())->fill([
	        	 	'sell_id' => $save_sales->id,
	        	 	'sku' => $value,
	        	 	'qty' => $quantity[$key], 
	        	 	'price' => $price[$key], 
	        	 	'tax' => $tax[$key],
	        	 	'tax_amount' => $tax_amount[$key], 
	        	 	'sub_total' => $sub_total[$key],
	        	 ]);
        	 	$save_sell_rows->save();
        	 }
        	 
        } else {
        	 $customer_id = $customer->id;
        	 $save_sales = (new Sell())->fill([
        	 	'customer_id' => $customer_id,  
        	 	'cash' => $total_payment, 
        	 	'total_price_without_tax' => $total_price_without_tax, 
        	 	'total_tax_payable' => $total_tax_payable, 
        	 	'net_total' => $total_sub_total, 
        	 	'net_total_rounded_down' => floor($total_sub_total), 
        	 	'balance_payable_to_customer' => $balance_without_abs,
        	 ]);
        	 $save_sales->save();

        	 foreach ($sku as $key => $value) {
        	 	$save_sell_rows = (new SellRows())->fill([
	        	 	'sell_id' => $save_sales->id,
	        	 	'sku' => $value,
	        	 	'qty' => $quantity[$key], 
	        	 	'price' => $price[$key], 
	        	 	'tax' => $tax[$key],
	        	 	'tax_amount' => $tax_amount[$key], 
	        	 	'sub_total' => $sub_total[$key],
	        	 ]);
        	 	$save_sell_rows->save();
        	 }
        }
        
        Notification::route('mail' , $request->email)->notify(new SellNotification($details));
  
    	return view('print')->with(compact('data'));
    } 

}
