<?php

function denomination($balance){

    $balance_denomination_500_1 = $balance/500;
    	$balance_denomination_500 = floor($balance_denomination_500_1);

    	$balance_denomination_50_1 = ($balance - ($balance_denomination_500*500))/50;
    	$balance_denomination_50 = floor($balance_denomination_50_1);

    	$balance_denomination_20_1 = ($balance - (($balance_denomination_50*50) + ($balance_denomination_500*500)))/20;
    	$balance_denomination_20 = floor($balance_denomination_20_1);

    	$balance_denomination_10_1 = ($balance - (($balance_denomination_20*20) + ($balance_denomination_50*50) + ($balance_denomination_500*500)))/10;
    	$balance_denomination_10 = floor($balance_denomination_10_1);

    	$balance_denomination_5_1 = ($balance - (($balance_denomination_10*10) + ($balance_denomination_20*20) + ($balance_denomination_50*50) + ($balance_denomination_500*500)))/5;    		
    	$balance_denomination_5 = floor($balance_denomination_5_1);

    	$balance_denomination_2_1 = ($balance - (($balance_denomination_5*5) + ($balance_denomination_10*10) + ($balance_denomination_20*20) + ($balance_denomination_50*50) + ($balance_denomination_500*500)))/2;    		
    	$balance_denomination_2 = floor($balance_denomination_2_1);

    	$balance_denomination_1_1 = ($balance - (($balance_denomination_2*2) + ($balance_denomination_5*5) + ($balance_denomination_10*10) + ($balance_denomination_20*20) + ($balance_denomination_50*50) + ($balance_denomination_500*500)))/1;    	
    	$balance_denomination_1 = floor($balance_denomination_1_1);

    	$data = [
    		'balance_denomination_500' => $balance_denomination_500,
    		'balance_denomination_50' => $balance_denomination_50,
    		'balance_denomination_20' => $balance_denomination_20,
    		'balance_denomination_10' => $balance_denomination_10,
    		'balance_denomination_5' => $balance_denomination_5,
    		'balance_denomination_2' => $balance_denomination_2,
    		'balance_denomination_1' => $balance_denomination_1,
    	];
    	return $data;
}

function customFilter($parameters){
    
    $price = $parameters[0]->sellrows->map(function ($qry) {
        return collect($qry)->only(['price']);
    });

    $sku = $parameters[0]->sellrows->map(function ($qry) {
        return collect($qry)->only(['sku']);
    });

    $qty = $parameters[0]->sellrows->map(function ($qry) {
        return collect($qry)->only(['qty']);
    });

    $tax = $parameters[0]->sellrows->map(function ($qry) {
        return collect($qry)->only(['tax']);
    });

    $tax_amount = $parameters[0]->sellrows->map(function ($qry) {
        return collect($qry)->only(['tax_amount']);
    });

    $sub_total = $parameters[0]->sellrows->map(function ($qry) {
        return collect($qry)->only(['sub_total']);
    });

    $data = [
        'price' => $price,
        'sku' => $sku,
        'qty' => $qty,
        'tax' => $tax,
        'tax_amount' => $tax_amount,
        'sub_total' => $sub_total, 
    ];
    
    return $data;

}