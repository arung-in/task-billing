@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-2">
             <a href="{{ route('home') }}" class="btn btn-primary">Home</a>
             <br><br>
             <a href="{{ route('bill.create') }}" class="btn btn-primary">Create Bill</a>
             <br><br>
             <a href="{{ route('customers') }}" class="btn btn-primary">View Customers</a>
        </div>
        <div class="col-md-8">
            <div class="card">
               <div class="card-header"> <center>Invoice </center></div>

                <div class="card-body">
                    <div class="form-group row">
                    <label class="col-md-4 col-form-label text-md-left">{{ __('E-Mail Address') }}</label>

                    <label class="col-md-4 col-form-label text-md-left"><b>{{ $data['email'] }}</b></label>                     

                    <?php
                    if ($data['view']) {
                    ?>
                        <label class="col-md-2 col-form-label "><b>Bill No: </b></label>            
                    <?php
                        echo $data['bill_number'];
                    }
                    ?>
                    </div> 
                    <div class="form-group row">
                        <table class="col-md-12 text-center">
                            <tr>
                                <th>Product ID</th>
                                <th>Unit Price</th>
                                <th>QTY</th>
                                <th>TAX %</th>
                                <th>TAX AMOUNT</th>
                                <th>SUB TOTAL</th>
                            </tr>
                            <body>
                                <?php foreach ($data['sku'] as $key => $value) { ?>
                                <tr>
                                    <?php
                                    if ($data['view']) {
                                    ?>
                                    <td>{{ $value['sku'] }}</td>
                                    <td>{{ $data['price'][$key]['price'] }}</td>
                                    <td>{{ $data['qty'][$key]['qty'] }}</td>
                                    <td>{{ $data['tax'][$key]['tax'] }}</td>
                                    <td>{{ $data['tax_amount'][$key]['tax_amount'] }}</td>
                                    <td>{{ $data['sub_total'][$key]['sub_total'] }}</td>
                                    <?php    
                                    } else {
                                    ?>
                                    <td>{{ $value }}</td>
                                    <td>{{ $data['price'][$key] }}</td>
                                    <td>{{ $data['qty'][$key] }}</td>
                                    <td>{{ $data['tax'][$key] }}</td>
                                    <td>{{ $data['tax_amount'][$key] }}</td>
                                    <td>{{ $data['sub_total'][$key] }}</td>
                                    <?php    
                                    }
                                     ?>
                                    
                                </tr>
                                 <?php } ?>
                            </body>
                        </table>
                    </div>

                    <div class="form-group row">
                    <label class="col-md-9 col-form-label text-md-right">{{ __('Total price without tax') }}</label>

                    <label class="col-md-3 col-form-label text-md-right"><b>{{ $data['total_price_without_tax'] }}</b></label>                     
                    </div> 
                    <div class="form-group row">
                    <label class="col-md-9 col-form-label text-md-right">{{ __('Total tax payable') }}</label>

                    <label class="col-md-3 col-form-label text-md-right"><b>{{ $data['total_tax_payable'] }}</b></label>                     
                    </div>
                    <div class="form-group row">
                    <label class="col-md-9 col-form-label text-md-right">{{ __('Net Total') }}</label>

                    <label class="col-md-3 col-form-label text-md-right"><b>{{ $data['net_total'] }}</b></label>                     
                    </div> 
                    <div class="form-group row">
                    <label class="col-md-9 col-form-label text-md-right">{{ __('Rounded down value of Net Total') }}</label>

                    <label class="col-md-3 col-form-label text-md-right"><b>{{ $data['net_total_rounded_down'] }}</b></label>                     
                    </div> 
                    <div class="form-group row">
                    <label class="col-md-9 col-form-label text-md-right">{{ __('Balance payable to customer') }}</label>

                    <label class="col-md-3 col-form-label text-md-right"><b>{{ $data['balance_payable_to_customer'] }}</b></label>                     
                    </div> 
                </div>
                 <div class="card-footer">
                     <div class="form-group row">
                            <label for="denomination" class="col-md-4 col-form-label text-md-right">{{ __('Balance Denominations') }}</label>
                            
                            <label for="denominationa" class="col-md-4 col-form-label text-md-right">{{ __('500') }}</label>
                            <div class="col-md-2">
                                <label class="col-md-4 col-form-label text-md-right">{{ $data['denomination_500'] }}</label> 
                            </div> 
                        </div>

                        <div class="form-group row">                             
                            <label for="denominationb" class="col-md-8 col-form-label text-md-right">{{ __('50') }}</label>
                            <div class="col-md-2">
                               <label class="col-md-4 col-form-label text-md-right">{{ $data['denomination_50'] }}</label> 
                            </div> 
                        </div>

                        <div class="form-group row">                             
                            <label for="denominationc" class="col-md-8 col-form-label text-md-right">{{ __('20') }}</label>
                            <div class="col-md-2"> 
                                   <label class="col-md-4 col-form-label text-md-right">{{ $data['denomination_20'] }}</label>  
                            </div> 
                        </div>

                        <div class="form-group row">                             
                            <label for="denominationd" class="col-md-8 col-form-label text-md-right">{{ __('10') }}</label>
                            <div class="col-md-2"> 
                                   <label class="col-md-4 col-form-label text-md-right">{{ $data['denomination_10'] }}</label>  
                            </div> 
                        </div>

                        <div class="form-group row">                             
                            <label for="denominatione" class="col-md-8 col-form-label text-md-right">{{ __('5') }}</label>
                            <div class="col-md-2"> 
                               <label class="col-md-4 col-form-label text-md-right">{{ $data['denomination_5'] }}</label> 
                            </div>  
                        </div>

                        <div class="form-group row">                             
                            <label for="denominationf" class="col-md-8 col-form-label text-md-right">{{ __('2') }}</label>
                            <div class="col-md-2"> 
                                   <label class="col-md-4 col-form-label text-md-right">{{ $data['denomination_2'] }}</label> 
                                </div> 
                        </div>

                        <div class="form-group row">                             
                            <label for="denominationg" class="col-md-8 col-form-label text-md-right">{{ __('1') }}</label>
                            <div class="col-md-2"> 
                               <label class="col-md-4 col-form-label text-md-right">{{ $data['denomination_1'] }}</label> 
                            </div>  
                        </div> 

                 </div>
            </div>
        </div>
    </div>
</div>
@endsection
