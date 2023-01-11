@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{$table->name}}</div>

                <div class="card-body">
                    <form action="{{ route('shops.tables.update', [$shop->id, $table->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <h5 class="mb-1">Table Name / ID</h5>
                        <div class="form-group">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Enter Table Name / ID" value="{{old('name') ?? $table->name ?? ''}}" name="name">
                        </div>
                        @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <h5 class="mb-1 mt-3">Type</h5>
                        <div class="form-group">
                            <select class="form-control @error('type') is-invalid @enderror" value="{{old('type')}}" name="type">
                                <option value="table" {{ $table->type == "table" ? 'selected' : '' }}>Table</option>
                                <option value="computer" {{ $table->type == "computer" ? 'selected' : '' }}>Personal Computer (PC)</option>
                                <option value="playstation" {{ $table->type == "playstation" ? 'selected' : '' }}>Playstation (PS)</option>
                            </select>
                        </div>
                        @error('type')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <h5 class="mb-1 mt-3">Description</h5>
                        <div class="form-group">
                            <textarea class="form-control @error('description') is-invalid @enderror" rows="2" placeholder="Enter description (Optional)" name="description">{{old('description') ?? $table->description ?? ''}}</textarea>
                        </div>
                        @error('description')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <div class="form-group text-center mt-5">
                            <button type="submit" class="btn btn-outline-success" style="width: 40%">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection