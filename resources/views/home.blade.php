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
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
