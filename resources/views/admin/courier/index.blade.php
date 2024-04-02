@extends('admin.layouts.app')

@section('content')
@include('messages')
<div class="d-flex align-items-center justify-content-between">
    <h1 class="mb-0">Couriers</h1>
    <div>
        <a href="{{ route('courier.create') }}" class="btn btn-primary">Create Courier</a>
        <form action="{{ route('courier.restoreAll') }}" method="POST" style="display: inline;">
            @csrf
            <button type="submit" onclick="return confirm('Are you sure you want to restore all soft deleted couriers?')" class="btn btn-success">Restore All</button>
        </form>
    </div>
</div>
<table id="supplierTable" class="table table-hover">
    <thead class="table-primary">
        <tr>
            <th>Images</th>
            <th>Courier Name</th>
            <th>Branch</th>
            <th>Update</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($couriers as $courier)
        <tr>
            <td class="align-middle">
                @foreach(explode(',', $courier->image) as $imagePath)
                <img src="{{ asset(trim($imagePath)) }}" alt="{{ $courier->courier_name }}" width="150" height="150">
                @endforeach
            </td>                
            <td class="align-middle">{{$courier->courier_name}}</td>
            <td class="align-middle">{{$courier->branch}}</td>
            <td class="align-middle"><a href="{{route('courier.update', $courier->id)}}">Update</a></td>
            <td class="align-middle">
                <form action="{{ route('courier.delete', $courier->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Are you sure you want to delete this courier?')" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<!-- DataTables Initialization Script -->
<script>
    $(document).ready(function () {
        $('#supplierTable').DataTable();
    });
</script>
@endsection
