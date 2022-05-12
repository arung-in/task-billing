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
               <div class="card-header">{{ $data[0]->customer->email }} Bills</div>

                <div class="card-body"> 
                 <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Bill No.</th>
                            <th>Date</th>
                            <th>Bill Total</th>
                            <th width="300px;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(!empty($data) && $data->count())
                            @foreach($data as $key => $value)
                            <?php 
                                $date = \Carbon\Carbon::parse($value->created_at);
                            ?>
                        <tr>
                            <td>{{ $value->id }}</td>
                            <td>{{ $date->format('d-m-Y') }}</td>
                            <td>{{ $value->net_total_rounded_down }}</td>
                            <td>
                                <a href="/home/bills/{{$value->id}}" class="btn btn-primary btn-success">View</a> 
                            </td>
                        </tr>
                            @endforeach
                        @else
                        <tr>
                            <td colspan="10">There are no data.</td>
                        </tr>
                        @endif
                    </tbody>
                </table> 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection  