@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">New Table</div>

                <div class="card-body">
                    <form id="formEdit" action="{{ route('shops.categories.items.update', [$shop->id, $category->id, $item->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <input id="editButton" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Enter Category Name" value="{{old('name') ?? $item->name ?? ''}}" name="name">
                        </div>
                        @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <h5 class="mb-1">Price</h5>
                        <div class="form-group input-group">
                            <input type="number" min="0.00" max="10000.00" step="0.25" class="form-control @error('price') is-invalid @enderror" value="{{old('price') ?? $item->price ?? '0.0'}}" name="price">
                            <div class="input-group-append">
                                <span class="input-group-text" id="basic-addon2">LE</span>
                            </div>
                        </div>
                        @error('price')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <h5 class="mb-1">Description</h5>
                        <div class="form-group">
                            <textarea class="form-control @error('description') is-invalid @enderror" rows="1" placeholder="Enter description (Optional)" name="description">{{old('description') ?? $item->description ?? ''}}</textarea>
                        </div>
                        @error('description')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <div class="form-group text-center mt-3">
                            <button type="submit" class="btn btn-outline-success" style="width: 40%">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection