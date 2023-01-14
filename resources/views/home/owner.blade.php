@if($shops->count())
<h1 class="text-center mb-5">My Shops</h1>
<table class="table text-center">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Address</th>
            <th scope="col">Details</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($shops as $shop)
        <tr>
            <td>{{ $loop->index + 1 }}</td>
            <td>{{ $shop->name }}</td>
            <td>{{ $shop->address }}</td>
            <td>
                <div class="btn-group">
                    <a class="btn btn-outline-success" href="{{ route('shops.edit', [$shop->id]) }}">
                        Manage
                    </a>
                    <a class="btn btn-outline-primary" href="#">
                        Show
                    </a>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>

</table>
@else
<h5 class="mt-3"> No data to show here!</h5>
@endif