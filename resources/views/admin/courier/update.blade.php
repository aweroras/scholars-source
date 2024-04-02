@extends('admin.layouts.app')
  
@section('title', 'Add Supplier')
  
@section('content')
@include('messages')
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-primary text-white">
            </div>
            <div class="card-body">
        <form action="{{ route('courier.edit', $courier->id) }}" method="post" enctype="multipart/form-data">
            @csrf 
            @method('PUT')
            <table class="table">
                <tbody>
                    <tr>
                        <td><label for="name">Courier Name</label></td>
                        <td><input type="text" value="{{$courier->courier_name}}" name="name" class="form-control"></td>
                    </tr>
                    <tr>
                        <td><label for="name">Branch</label></td>
                        <td><input type="text" value="{{$courier->branch}}" name="branch" class="form-control"></td>
                    </tr>
                    <tr>
                        <td><label for="image">Images</label></td>
                        <td><input type="file" name="image[]" class="form-control-file" multiple></td>
                    </tr>
                    <tr>
                        <td>
                            @foreach(explode(',', $courier->image) as $imagePath)
                            <img src="{{ asset(trim($imagePath)) }}" alt="{{ $courier->name }}" width="150" height="150">
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <button type="submit" class="btn btn-success">Submit</button>
        </form>
    </div>
</body>
    @endsection
