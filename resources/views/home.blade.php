@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Welcome to Bazooka</div>

                <div class="card-body">
                    <div class="text-right mb-5">
                        <a class="btn btn-outline-primary mt-3" href="{{ route('shops.create') }}">
                            New Shop
                        </a>
                        
                       
                    </div>

                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection