@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h3 class="mb-0">{{$shop->name}}</h3></div>

                <div class="card-body">
                    <div class="text-center mb-3">
                      <div class="btn-group">
                        <a class="btn btn-outline-success mt-3" href="#">
                          Menu
                        </a>
                        <a class="btn btn-outline-warning mt-3" href="#">
                          Hire Employee
                        </a>
                        <a class="btn btn-outline-primary mt-3" href="{{ route('shops.tables.create', [$shop->id]) }}">
                          New Table
                        </a>
                      </div>
                    </div>
 
                    @if($shopTables->count())
                    <h3 class="text-center mb-1">All Tables</h3>
                    <div class="container text-center">
                        <div class="row row-cols-3">
                            @foreach ($shopTables as $table)
                            <div class="mt-4">
                                <div class="card h-100">
                                    <h5 class="card-header">{{$table->name}}</h5>
                                    <div class="card-body">
                                        <p class="card-text">{{$table->description}}</p>
                                    </div>
                                    <div class="card-footer bg-white d-flex">
                                        <a href="{{ route('shops.tables.edit', [$shop->id, $table->id]) }}" class="card-link">Edit</a>
                                        @if($table->type != 'table')
                                        <a href="#" class="card-link">Price</a>
                                        @endif
                                        <form action="{{ route('shops.tables.destroy', [$shop->id, $table->id]) }}" method="POST">
                                          @csrf
                                          @method('DELETE')
                                          <button type="submit" class="card-link link-danger border border-0 bg-white mr-n3">&nbsp;&nbsp;&nbsp;Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="text-center mt-3">
                      <a class="btn btn-outline-secondary mt-3" href="#">
                        View As Employee
                      </a>
                    </div>
                    @else
                    <h5 class="mt-3"> No data to show here!</h5>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection