@extends('admin.layouts.app')

@section('content')
    @include('messages')
    <div class="d-flex align-items-center justify-content-between">
        <h1 class="mb-0">Customer Dashboard</h1>
    </div>
   
    <table id="user-table" class="table table-hover">
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
                    <td class="align-middle"><a href="{{ route('users.deactivate', $user->user_id) }}" onclick="return confirm('Are you sure you want to deactivate this account?')">Deactivate</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <script>
        $(document).ready(function() {
            $('#user-table').DataTable();
        });
    </script>
@endsection
