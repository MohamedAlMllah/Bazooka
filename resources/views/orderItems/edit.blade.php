@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Quantity</div>

                <div class="card-body">
                    <form action="{{ route('tables.items.orderItems.update', [$table->id, $item->id, $orderItem]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <div class="col-8">
                                <h5>Name</h5>
                                {{$item->name}}
                            </div>
                            <div class="col-4 text-center">
                                <h5 class="mb-1">Quantity</h5>
                                <div class="form-group input-group">
                                    <input type="number" min="0.00" max="10000.00" step="0.25" class="form-control @error('quantity') is-invalid @enderror" value="{{old('quantity') ?? $orderItem->quantity ?? ''}}" name="quantity">
                                </div>
                                @error('quantity')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-success mt-3 col-4">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection