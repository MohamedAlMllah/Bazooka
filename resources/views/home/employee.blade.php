@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0 d-flex">
                        {{$employedAtShop->name}}
                    </h3>
                </div>

                <div class="card-body">
                    @if($employedAtShop->tables->count())
                    <h3 class="text-center mb-3">All Tables</h3>
                    <div class="container text-center">
                        <div class="row row-cols-lg-3 row-cols-sm-2">
                            @foreach ($employedAtShop->tables as $table)
                            <div class="mb-4">
                                <div class="card h-100">
                                    <h5 class="card-header">{{$table->name}}</h5>
                                    <div class="card-body">
                                        <p class="card-text">{{$table->description}}</p>
                                    </div>
                                    <div class="card-footer bg-white text-center">
                                        <a href="{{ route('orderCheck', [$table->id]) }}" class="card-link">Details</a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @else
                    <h5 class="mt-3"> No data to show here!</h5>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@include('layouts.modals.delete')
@endsection