@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{$category->name}}</div>

                <div class="card-body">
                    <div class="text-start mb-3">
                        <a href="{{ route('shops.categories.index', [$shop->id]) }}" class="btn btn-outline-secondary">Categories</a>
                    </div>
                    <form action="{{ route('shops.categories.items.store', [$shop->id,$category->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-3">
                                <h5 class="mb-1">Name</h5>
                                <div class="form-group">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Enter Name" value="{{old('name')}}" name="name">
                                </div>
                                @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-3">
                                <h5 class="mb-1">Price</h5>
                                <div class="form-group input-group">
                                    <input type="number" min="0.00" max="10000.00" step="0.25" class="form-control @error('price') is-invalid @enderror" value="{{old('price') ?? '0.0'}}" name="price">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2">LE</span>
                                    </div>
                                </div>
                                @error('price')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                            </div>
                            <div class="col-6">
                                <h5 class="mb-1">Description</h5>
                                <div class="form-group">
                                    <textarea class="form-control @error('description') is-invalid @enderror" rows="1" placeholder="Enter description (Optional)" name="description">{{old('description')}}</textarea>
                                </div>
                                @error('description')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group text-center mt-3">
                            <button type="submit" class="btn btn-outline-success" style="width: 25%">Add</button>
                        </div>
                    </form>
                    <hr>

                    @if($items->count())
                    <h3 class="text-center mt-3 mb-3">Items of : {{$category->name}}</h3>
                    <table class="table text-center">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col" class="col-2">Name</th>
                                <th scope="col" class="col-2">Price</th>
                                <th scope="col" class="col-4">Description</th>
                                <th scope="col" class="col-3">Options</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->price }}</td>
                                <td>{{ $item->description }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('shops.categories.items.edit', [$shop->id, $category->id, $item->id]) }}" class="btn btn-outline-secondary">Edit</a>
                                        <a href="{{ route('shops.categories.items.destroy', [$shop->id, $category->id, $item->id]) }}" onclick="$('#formDelete').attr('action', this.href)" type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">Delete</a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    @else
                    <h5 class="mt-3"> No items yet!</h5>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@include('layouts.modals.delete')
@endsection