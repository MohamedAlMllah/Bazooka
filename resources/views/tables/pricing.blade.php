@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{$table->name}} Pricing</div>

                <div class="card-body">
                    <form action="{{ route('shops.tables.update', [$shop->id, $table->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <h5 class="mb-1">Single Price</h5>
                        <div class="form-group input-group">
                            <input type="number" min="0.00" max="10000.00" step="0.25" class="form-control @error('singlePrice') is-invalid @enderror" value="{{old('singlePrice') ?? $table->singlePrice ?? '0.0'}}" name="singlePrice">
                            <div class="input-group-append">
                                <span class="input-group-text" id="basic-addon2">LE</span>
                            </div>
                        </div>
                        @error('singlePrice')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        @if ($table->type == 'ps')
                        <h5 class="mt-3">multiplayer Price</h5>
                        <div class="form-group input-group">
                            <input type="number" min="0.00" max="10000.00" step="0.25" class="form-control @error('multiplayerPrice') is-invalid @enderror" value="{{old('multiplayerPrice') ?? $table->multiplayerPrice ?? '0.0'}}" name="multiplayerPrice">
                            <div class="input-group-append">
                                <span class="input-group-text" id="basic-addon2">LE</span>
                            </div>
                        </div>
                        @error('multiplayerPrice')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        @endif

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