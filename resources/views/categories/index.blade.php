@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Menu Management</div>
                <div class="card-body">
                    @if (session('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('error') }}
                    </div>
                    @endif
                    <div class="text-center mt-3">
                        <div class="btn-group">
                            <a href="{{ route('shops.edit', [$shop->id]) }}" class="btn btn-outline-secondary">Shop Managment</a>
                            <a href="{{ route('menu', [$shop->id]) }}" class="btn btn-outline-warning">View Menu</a>
                            <a class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#createCategoryModal">New Category</a>
                        </div>
                    </div>

                    @if($categories->count())
                    <h1 class="text-center mt-3 mb-3">Categories</h1>
                    <table class="table text-center">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col" class="col-7">Name</th>
                                <th scope="col" class="col-4">Options</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>
                                    {{ $category->name }}


                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('shops.categories.items.index', [$shop->id, $category->id]) }}" class="btn btn-outline-primary">Items</a>
                                        <a class="btn btn-outline-secondary" data-bs-toggle="collapse" href="#collapseEdit{{$category->id}}" role="button" aria-expanded="false" aria-controls="collapseEdit{{$category->id}}">Edit</a>
                                        <a href="{{ route('shops.categories.destroy', [$shop->id, $category->id]) }}" onclick="$('#formDelete').attr('action', this.href)" type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">Delete</a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="border-0" colspan="4">
                                    <div class="collapse" id="collapseEdit{{$category->id}}">
                                        <div class="card card-body">
                                            <form id="formEdit" action="{{ route('shops.categories.update', [$shop->id, $category->id]) }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('PATCH')
                                                <div class="row">
                                                    <div class="col-8">
                                                        <div class="form-group">
                                                            <input id="editButton" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Enter Category Name" value="{{old('name') ?? $category->name ?? ''}}" name="name">
                                                        </div>
                                                        @error('name')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="text-center">
                                                            <button type="submit" class="btn btn-success">Save</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    @else
                    <h5 class="mt-3"> No categories yet!</h5>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@include('categories.create')
@include('categories.delete')
@endsection