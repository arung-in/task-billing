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
               <div class="card-header">Billing</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('bill.save') }}" name="add_product" id="add_product">
                        @csrf
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email ID" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row"> 

                        <table class="table table-bordered" id="dynamic_field">  
                        <tr>  
                        <td class="col-md-5 col-form-label">
                            <select id="sku[]" class="form-control js-example-basic-single" name="sku[]" required autofocus>
                                  <option value="">--Select--</option>
                                    @<?php foreach ($products as $key => $value): ?>
                                    <option value="<?php echo $value->id ?>"><?php echo $value->sku ?></option>
                                    <?php endforeach ?>                                  
                            </select>  
                        <td>
                            <input id="qty[]" type="number" class="form-control" name="qty[]" value="" placeholder="Qty" required autofocus>
                        </td>
                        <!-- <td>
                            <input id="price[]" class="form-control" name="price[]" value="" placeholder="Price" readonly="true">
                        </td> -->
                        <td><button type="button" name="add" id="add" class="btn btn-success">Add More</button></td>  
                        </tr>  

                        </table>   

                        </div>
                        <!-- <div class="form-group row">
                            <label for="denomination" class="offset-md-6 col-md-2 col-form-label text-md-right">{{ __('Bill Total') }}</label>

                            <input id="price[]" class="form-control col-md-2" name="price[]" value="" placeholder="Price" readonly="true">
                        </div> -->

                        <div class="form-group row">
                            <label for="denomination" class="col-md-4 col-form-label text-md-right">{{ __('Denominations') }}</label>
                            
                            <label for="denominationa" class="col-md-4 col-form-label text-md-right">{{ __('500') }}</label>
                            <div class="col-md-2">
                                <input id="denominationa" type="number" class="form-control @error('denominationa') is-invalid @enderror" name="denominationa" value="{{ old('denominationa') }}"  autocomplete="denominationa" placeholder="Count" autofocus>
                                @error('denominationa')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div> 
                        </div>

                        <div class="form-group row">                             
                            <label for="denominationb" class="col-md-8 col-form-label text-md-right">{{ __('50') }}</label>
                            <div class="col-md-2">
                                <input id="denominationb" type="number" class="form-control @error('denominationb') is-invalid @enderror" name="denominationb" value="{{ old('denominationb') }}"  autocomplete="denominationb" placeholder="Count" autofocus>
                                @error('denominationb')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div> 
                        </div>

                        <div class="form-group row">                             
                            <label for="denominationc" class="col-md-8 col-form-label text-md-right">{{ __('20') }}</label>
                            <div class="col-md-2">
                                <input id="denominationc" type="number" class="form-control @error('denominationc') is-invalid @enderror" name="denominationc" value="{{ old('denominationc') }}"  autocomplete="denominationc" placeholder="Count" autofocus>
                                @error('denominationc')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div> 
                        </div>

                        <div class="form-group row">                             
                            <label for="denominationd" class="col-md-8 col-form-label text-md-right">{{ __('10') }}</label>
                            <div class="col-md-2">
                                <input id="denominationd" type="number" class="form-control @error('denominationd') is-invalid @enderror" name="denominationd" value="{{ old('denominationd') }}"  autocomplete="denominationd" placeholder="Count" autofocus>
                                @error('denominationd')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div> 
                        </div>

                        <div class="form-group row">                             
                            <label for="denominatione" class="col-md-8 col-form-label text-md-right">{{ __('5') }}</label>
                            <div class="col-md-2">
                                <input id="denominatione" type="number" class="form-control @error('denominatione') is-invalid @enderror" name="denominatione" value="{{ old('denominatione') }}"  autocomplete="denominatione" placeholder="Count" autofocus>
                                @error('denominatione')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div> 
                        </div>

                        <div class="form-group row">                             
                            <label for="denominationf" class="col-md-8 col-form-label text-md-right">{{ __('2') }}</label>
                            <div class="col-md-2">
                                <input id="denominationf" type="number" class="form-control @error('denominationf') is-invalid @enderror" name="denominationf" value="{{ old('denominationf') }}"  autocomplete="denominationf" placeholder="Count" autofocus>
                                @error('denominationf')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div> 
                        </div>

                        <div class="form-group row">                             
                            <label for="denominationg" class="col-md-8 col-form-label text-md-right">{{ __('1') }}</label>
                            <div class="col-md-2">
                                <input id="denominationg" type="number" class="form-control @error('denominationg') is-invalid @enderror" name="denominationg" value="{{ old('denominationg') }}"  autocomplete="denominationg" placeholder="Count" autofocus>
                                @error('denominationg')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div> 
                        </div> 

                         <div class="form-group row">                             
                            <label for="denominationg" class="col-md-8 col-form-label text-md-right">{{ __('Cash') }}</label>
                            <div class="col-md-2">
                                <input id="cash" type="number" class="form-control @error('cash') is-invalid @enderror" name="cash" value="{{ old('cash') }}"  autocomplete="cash" placeholder="Cash" autofocus>
                                @error('cash')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div> 
                        </div> 

                        <div class="form-group row mb-0">
                            <div class="col-md-2 offset-md-6">
                                 <a href="{{ route('home') }}" class="btn btn-info">{{ __('Cancel') }}</a> 
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-success">
                                    {{ __('Generate Bill') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript">

    $(document).ready(function(){      
  
      var i=1;  
      $('#add').click(function(){  
           i++;  
           $('#dynamic_field').append('<tr id="row'+i+'" class="dynamic-added"><td  class="col-md-6 col-form-label"><select id="sku[]" class="form-control js-example-basic-single" name="sku[]" required autofocus><option value="">--Select--</option><?php foreach ($products as $key => $value): ?><option value="<?php echo $value->id ?>"><?php echo $value->sku ?></option><?php endforeach ?></select></td><td><input id="qty[]" type="number" class="form-control" name="qty[]" placeholder="Qty" required autofocus></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');  
      });  
      $(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove();  
      });   
      $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
       

      function printErrorMsg (msg) {
         $(".print-error-msg").find("ul").html('');
         $(".print-error-msg").css('display','block');
         $(".print-success-msg").css('display','none');
         $.each( msg, function( key, value ) {
            $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
         });
      }
    });  
</script> 