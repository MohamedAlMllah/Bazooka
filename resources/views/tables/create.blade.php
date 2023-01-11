@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">New Table</div>

                <div class="card-body">
                    <form action="{{ route('shops.tables.store', [$shop->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <h5 class="mb-1">Name / ID</h5>
                        <div class="form-group">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Enter Table Name / ID" value="{{old('name')}}" name="name">
                        </div>
                        @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <h5 class="mb-1 mt-3">Type</h5>
                        <div class="form-group">
                            <select class="form-control @error('type') is-invalid @enderror" value="{{old('type')}}" name="type">
                                <option value="table" selected>Table</option>
                                <option value="computer">Personal Computer (PC)</option>
                                <option value="playstation">Playstation (PS)</option>
                            </select>
                        </div>
                        @error('type')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <h5 class="mb-1 mt-3">Description</h5>
                        <div class="form-group">
                            <textarea class="form-control @error('description') is-invalid @enderror" rows="2" placeholder="Enter description (Optional)" name="description">{{old('description')}}</textarea>
                        </div>
                        @error('description')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <div class="form-group text-center mt-5">
                            <button type="submit" class="btn btn-outline-success" style="width: 40%">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection