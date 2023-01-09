@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Employment</div>
                <div class="card-body">
                    @if (session('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('error') }}
                    </div>
                    @endif
                    <div class="text-start mb-3">
                        <a href="{{ route('shops.edit', [$shop->id]) }}" class="btn btn-outline-secondary">Shop Managment</a>
                    </div>

                    <form action="{{ route('hire', [$shop->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <h5 class="mb-1">Search For User</h5>
                        <div class="form-group">
                            <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="E-mail" value="{{old('email')}}" name="email">
                        </div>
                        @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <div class="form-group text-center mt-3">
                            <button type="submit" class="btn btn-outline-success" style="width: 25%">Hire</button>
                        </div>
                    </form>

                    @if($employees->count())
                    <h1 class="text-center mt-5 mb-3">Employees</h1>
                    <table class="table text-center">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">E-mail</th>
                                <th scope="col">Details</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($employees as $employee)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $employee->name }}</td>
                                <td>{{ $employee->email }}</td>
                                <td>
                                    <a href="{{ route('fire', [$shop->id, $employee->id]) }}" onclick="$('#formFire').attr('action', this.href)" type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#fireModal">Fire</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>

                    </table>
                    @else
                    <h5 class="mt-3"> No employees yet!</h5>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@include('layouts.modals.fire')
@endsection