@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Welcome to Bazooka</div>

                <div class="card-body">
                    @can('isAdmin')
                    @include('home.admin')
                    @elsecan('isOwner')
                    @include('home.owner')
                    @elsecan('isEmployee')
                    @include('home.employee')
                    @endcan
                </div>
            </div>
        </div>
    </div>
</div>
@endsection