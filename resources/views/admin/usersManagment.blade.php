@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Users Managment</div>
                <div class="card-body">
                    @if (session('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('error') }}
                    </div>
                    @endif

                    <form action="{{ route('findUser') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <h5 class="mb-1">Search For User</h5>
                        <div class="form-group">
                            <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="E-mail" value="{{old('email')}}" name="email">
                        </div>
                        @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <div class="form-group text-center mt-3">
                            <button type="submit" class="btn btn-outline-success col-3">Create Shop</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection