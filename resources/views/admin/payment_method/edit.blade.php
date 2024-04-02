@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h1>Edit Payment Method</h1>
    <form action="{{ route('admin.payment_method.update', $paymentMethod->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="payment_name">Payment Name</label>
            <input type="text" class="form-control" id="payment_name" name="payment_name" value="{{ $paymentMethod->payment_name }}" required>
        </div>
        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" class="form-control-file" id="image" name="image">
            <img src="{{ asset('images/' . $paymentMethod->image) }}" width="100" height="100" alt="{{ $paymentMethod->payment_name }}">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection