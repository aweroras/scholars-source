@extends('admin.layouts.users')

@section('content')
    @include('messages')
    <div class="d-flex align-items-center justify-content-between">
        <h1 class="mb-0">Customer Dashboard</h1>
    </div>
   
    <table class="table table-hover">
        <thead class="table-primary">
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Address</th>
                <th>Phone Number</th>
                <th>Status</th>
                <th>Deactivate</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td class="align-middle">{{ $user->name }}</td>
                    <td class="align-middle">{{ $user->user->email }}</td>
                    <td class="align-middle">{{ $user->Address }}</td>
                    <td class="align-middle">{{ $user->PhoneNumber }}</td>
                    <td class="align-middle">{{ $user->status }}</td>
                    <td class="align-middle"><a href="{{ route('users.deactivate', $user->user_id) }}">Deactivate</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination Links -->
    <div class="d-flex justify-content-center">
        {{ $users->links() }}
    </div>
@endsection
