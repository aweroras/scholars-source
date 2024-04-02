@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h1>Add New Payment Method</h1>
    <form action="{{ route('admin.payment_method.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="payment_name">Payment Name</label>
            <input type="text" class="form-control" id="payment_name" name="payment_name" required>
        </div>
        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" class="form-control-file" id="image" name="image" multiple required>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection