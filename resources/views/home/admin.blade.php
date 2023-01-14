<div class="text-end mb-5">
    <a class="btn btn-outline-primary mt-3" href="{{ route('usersManagment') }}">
        Users Managment
    </a>
</div>
@if($shops->count())
<h1 class="text-center mb-5">All Shops</h1>
<table class="table text-center">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">owner E-Mail</th>
            <th scope="col">Options</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($shops as $shop)
        <tr>
            <td>{{ $loop->index + 1 }}</td>
            <td>{{ $shop->name }}</td>
            <td>{{ $shop->owner->email }}</td>
            <td>
                <div class="btn-group">
                    <a class="btn btn-outline-success" href="#">
                        Manage
                    </a>
                    <a href="{{ route('shops.destroy', [$shop->id]) }}" onclick="$('#formDelete').attr('action', this.href)" type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">Delete</a>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>

</table>
@else
<h5 class="mt-3"> No data to show here!</h5>
@endif
@include('layouts.modals.delete')