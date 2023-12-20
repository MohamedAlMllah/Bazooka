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
                    <div class="text-start mb-3">
                        @can('isOwner')
                        <a href="{{ route('shops.show', [$table->shop_id]) }}" class="btn btn-outline-secondary">Back</a>
                        @elsecan('isEmployee')
                        <a href="{{ route('home') }}" class="btn btn-outline-secondary">Back</a>
                        @endcan
                    </div>

                    @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                    @endif

                    <div class="card mt-3 col-lg-8 offset-lg-2">
                        <div class="card-header text-center"><b>Time</b></div>
                        <div class="card-body">
                            @if(!$currentPeriod)
                            <form action="{{ route('tables.periods.store', [$table->id]) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="type" id="single" value="single" checked>
                                            <label class="form-check-label" for="single">
                                                Single
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="type" id="multiplayer" value="multiplayer">
                                            <label class="form-check-label" for="multiplayer">
                                                Multiplayer
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group text-center">
                                            <button type="submit" class="btn btn-success col-6 mt-2">Start</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            @else

                            <div class="text-center fs-1">
                                <span class="digit" id="hours">00</span>
                                <span class="txt">:</span>
                                <span class="digit" id="minutes">00</span>
                                <span class="txt">:</span>
                                <span class="digit" id="seconds">00</span>

                                <script>
                                    var hours = 00;
                                    var minutes = 00;
                                    var seconds = 00;
                                    var currentPeriod = <?php echo json_encode($currentPeriod); ?>;
                                    var currentPeriodCreatedAt = <?php echo json_encode($currentPeriod->created_at); ?>;
                                    currentPeriodCreatedAt = currentPeriodCreatedAt.replace('T', ' ');
                                    currentPeriodCreatedAt = currentPeriodCreatedAt.split(/[- :.]/);
                                    currentPeriodCreatedAt = new Date(Date.UTC(currentPeriodCreatedAt[0], currentPeriodCreatedAt[1] - 1, currentPeriodCreatedAt[2], currentPeriodCreatedAt[3], currentPeriodCreatedAt[4], currentPeriodCreatedAt[5]));

                                    function stopWatch() {
                                        if (currentPeriod) {
                                            var diffrent = Date.now() - currentPeriodCreatedAt;
                                            diffrent = diffrent / 1000 / 60; //in minutes
                                            hours = Math.floor(diffrent / 60);
                                            minutes = Math.floor(diffrent % 60);
                                            seconds = Math.floor((diffrent * 60) % 60);

                                            if (hours < 10) {
                                                hours = "0" + hours;
                                            }
                                            if (minutes < 10) {
                                                minutes = "0" + minutes;
                                            }
                                            if (seconds < 10) {
                                                seconds = "0" + seconds;
                                            }

                                            document.getElementById('hours').innerHTML = hours;
                                            document.getElementById('minutes').innerHTML = minutes;
                                            document.getElementById('seconds').innerHTML = seconds;

                                            setTimeout(stopWatch, 1000);
                                        }
                                    }
                                </script>
                            </div>

                            <form action="{{ route('tables.periods.update', [$table->id, $currentPeriod->id]) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                <div class="text-center">
                                    <div class="fs-3 mb-3">{{ $currentPeriod->type }}</div>
                                    <div class="btn-group">
                                        <button type="submit" class="btn btn-danger">End Time</button>
                                    </div>
                                </div>
                            </form>
                            @endif
                            @if ($currentOrder->finishedPeriods()->count())
                            <table class="table text-center mt-3">
                                <thead>
                                    <tr>
                                        <th class="col-3">Start</th>
                                        <th class="col-3">End</th>
                                        <th class="col-2">Time</th>
                                        <th class="col-2">Type</th>
                                        <th class="col-2">Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($currentOrder->finishedPeriods() as $period)
                                    <tr>
                                        <td>{{ $period->created_at->format('h:i a') }}</td>
                                        <td>{{ $period->end_at->format('h:i a') }}</td>
                                        <td>{{ $period->end_at->diff( $period->created_at )->format("%H:%I:%S") }}</td>
                                        <td>{{ $period->type }}</td>
                                        <td>{{ $period->price() }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <thead>
                                    <tr>
                                        <th class="border-bottom-0" colspan="4">Total</th>
                                        <th class="border-bottom-0">{{ $currentOrder->totalCashForPeriods() }}</th>
                                    </tr>
                                </thead>
                            </table>
                            @endif
                        </div>
                    </div>

                    <div class="card col-lg-8 offset-lg-2 mt-3">
                        <div class="card-header text-center"><b>Order</b></div>
                        <div class="card-body">
                            <div class="text-center mb-3">
                                <a href="{{ route('itemsList', [$table->id]) }}" class="btn btn-success">Add Item</a>
                            </div>
                            @if($currentOrder->orderItems->count())
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
                                            <p class="text-primary">{{ $orderItem->item->name }}</p>
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
                                        <th class="border-bottom-0" colspan="2" scope="col">Total</th>
                                        <th class="border-bottom-0" scope="col">{{ $currentOrder->totalCashForItems() }}</th>
                                        <th class="border-bottom-0" scope="col">
                                            <a class="btn btn-success {{ $currentOrder->notSentItems()->count() ? '' : 'disabled' }} col-8" href="{{ route('sendOrderItems', [$currentOrder->id]) }}">Send</a>
                                        </th>
                                    </tr>
                                </thead>
                            </table>
                            @else
                            <h5 class="mt-3">&nbsp;&nbsp;&nbsp; No Items In This Order.</h5>
                            @endif
                        </div>
                    </div>
                    <div class="card col-lg-8 offset-lg-2 mt-3">
                        <div class="card-header text-center"><b>Total</b></div>
                        <div class="card-body row fs-3">
                            <div class="col-8">
                                Total: {{ $currentOrder->totalCash() }}
                            </div>
                            <div class="col-4">
                                <a class="btn btn-primary col-8" href="{{ route('checkout', [$currentOrder->id]) }}">Checkout </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('layouts.modals.delete')
@endsection