@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Order Management</div>
                <div class="card-body">
                    @if (session('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('error') }}
                    </div>
                    @endif

                    @if($categories->count())
                    <h1 class="text-center mt-3 mb-3">Menu</h1>

                    @foreach ($categories as $category)
                    <h4>{{ $category->name }}</h4>
                    @if($category->items->count())
                    <table class="table text-center">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col" class="col-3">Name</th>
                                <th scope="col" class="col-3">Price</th>
                                <th scope="col" class="col-4">Options</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($category->items as $item)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->price }}</td>
                                <td>
                                    <a class="btn btn-success" href="{{ route('tables.items.orderItems.create', [$table->id, $item->id]) }}">Add Item</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <h5 class="mt-3">&nbsp;&nbsp;&nbsp; No Items In This Category.</h5>
                    @endif
                    @endforeach

                    @else
                    <h5 class="mt-3"> No Categories To Show.</h5>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection