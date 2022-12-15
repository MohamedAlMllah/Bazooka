@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                  <h3 class="mb-0 d-flex">
                    {{$shop->name}}&nbsp;	
                    <p style="font-size: 12px;"><a class="card link link-secondary border border-0 bg-light mt-2" data-bs-toggle="collapse" href="#collapseShopEdit" role="button" aria-expanded="false" aria-controls="collapseShopEdit">Edit</a></p>
                  </h3>
                </div>

                <div class="card-body">
                <div class="collapse" id="collapseShopEdit">
                  <div class="card card-body">
                    <form action="{{ route('shops.update', [$shop->id]) }}" method="POST" enctype="multipart/form-data">
                      @csrf
                      @method('PATCH')
                      <h5 class="mb-1">Name</h5>
                      <div class="form-group">
                          <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Enter Shop Name" value="{{old('name') ?? $shop->name ?? ''}}" name="name">
                      </div>
                      @error('name')
                      <div class="alert alert-danger">{{ $message }}</div>
                      @enderror

                      <h5 class="mb-1 mt-3">Address</h5>
                      <div class="form-group">
                          <input type="text" class="form-control @error('address') is-invalid @enderror" placeholder="Enter Shop Address" value="{{old('address') ?? $shop->address ?? ''}}" name="address">
                      </div>
                      @error('address')
                      <div class="alert alert-danger">{{ $message }}</div>
                      @enderror

                      <div class="form-group text-center mt-3">
                          <button type="submit" class="btn btn-outline-success" style="width: 40%">Save</button>
                      </div>
                    </form>
                  </div>
                </div>

                    <div class="text-center mb-3">
                      <div class="btn-group">
                        <a class="btn btn-outline-success mt-3" href="#">
                          Menu
                        </a>
                        <a class="btn btn-outline-warning mt-3" href="#">
                          Employees
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
                                  <a class="card-link link-danger border border-0 bg-white mr-n3" data-bs-toggle="collapse" href="#collapseDeleteTable{{$table->id}}" role="button" aria-expanded="false" aria-controls="collapseDeleteTable{{$table->id}}">Delete</a>
                                </div>
                                <div class="collapse" id="collapseDeleteTable{{$table->id}}">
                                  <div class="card card-body border border-0">
                                    Are you sure you want to delete this element?
                                    <div class="text-end">
                                      <div>
                                        <form action="{{ route('shops.tables.destroy', [$shop->id, $table->id]) }}" method="POST">
                                          @csrf
                                          @method('DELETE')
                                          <button class="card-link link-secondary border border-0 bg-white" type="button" data-bs-toggle="collapse" data-bs-target="#collapseDeleteTable{{$table->id}}" aria-expanded="false" aria-controls="collapseDeleteTable">Cancel</button>
                                          <button type="submit" class="card-link link-danger border border-0 bg-white mr-n3">&nbsp;&nbsp;&nbsp;Delete</button>
                                        </form>
                                      </div>
                                    </div>
                                  </div>
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