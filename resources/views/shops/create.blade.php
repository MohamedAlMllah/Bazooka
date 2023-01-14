@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">New Shop</div>

                <div class="card-body">
                    <form action="{{ route('shops.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" value="{{ session('ownerId') }}" name="ownerId">
                        <h5 class="mb-1">Name</h5>
                        <div class="form-group">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Enter Shop Name" value="{{old('name')}}" name="name">
                        </div>
                        @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <h5 class="mb-1 mt-3">Address</h5>
                        <div class="form-group">
                            <input type="text" class="form-control @error('address') is-invalid @enderror" placeholder="Enter Shop Address" value="{{old('address')}}" name="address">
                        </div>
                        @error('address')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <div class="form-group text-center mt-3">
                            <button type="submit" class="btn btn-outline-success" style="width: 40%">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection