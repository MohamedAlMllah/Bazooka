@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">
                    <h1>{{$table->name}}</h1>
                </div>

                <div class="card-body">
                    <div class="card col-lg-8 offset-lg-2">
                        <div class="card-header text-center"><b>Order</b></div>
                        <div class="card-body">
                            <div class="text-center mb-3">
                                <a href="{{ route('itemsList', [$table->id]) }}" class="btn btn-success">Add Item</a>
                            </div>
                            @if($currentOrder && $currentOrder->orderItems->count())
                            <table class="table text-center">
                                <thead>
                                    <tr>
                                        <th scope="col" class="col-2">Quantity</th>
                                        <th scope="col" class="col-2">Item</th>
                                        <th scope="col" class="col-2">Total</th>
                                        <th scope="col" class="col-5">Options</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($currentOrder->orderItems as $orderItem)
                                    <tr>
                                        <td>{{ $orderItem->quantity }}</td>
                                        <td>
                                            @if ($orderItem->is_sent)
                                            <b>{{ $orderItem->item->name }}</b>
                                            @else
                                            {{ $orderItem->item->name }}
                                            @endif
                                        </td>
                                        <td>{{ $orderItem->item->price*$orderItem->quantity }}</td>
                                        <td>
                                            @can('isOwner')
                                            <div class="btn-group">
                                                <a href="{{ route('tables.items.orderItems.edit', [$table->id, $orderItem->item_id, $orderItem->id]) }}" class="btn btn-outline-secondary">Edit</a>
                                                <a href="{{ route('tables.items.orderItems.destroy', [$table->id, $orderItem->item_id, $orderItem->id]) }}" onclick="$('#formDelete').attr('action', this.href)" type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">Delete</a>
                                            </div>
                                            @elsecan('isEmployee')
                                            @if ($orderItem->is_sent == false)
                                            <a href="{{ route('tables.items.orderItems.destroy', [$table->id, $orderItem->item_id, $orderItem->id]) }}" onclick="$('#formDelete').attr('action', this.href)" type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">Delete</a>
                                            @else
                                            -
                                            @endif
                                            @endcan
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <thead>
                                    <tr>
                                        <th colspan="2" scope="col" class="col-3">Total</th>
                                        <th scope="col" class="col-3">{{ $currentOrder->totalCash() }}</th>
                                        <th scope="col" class="col-4">
                                            <a class="btn btn-primary col-8" href="{{ route('sendOrderItems', [$table->id]) }}">send</a>
                                        </th>
                                    </tr>
                                </thead>
                            </table>
                            @else
                            <h5 class="mt-3">&nbsp;&nbsp;&nbsp; No Items In This Order.</h5>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('layouts.modals.delete')
@endsection