@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h1>Payment Methods</h1>
    <a href="{{ route('admin.payment_method.create') }}" class="btn btn-primary">Add New Payment Method</a>
    <table id="paymentMethodTable" class="table table-hover">
        <thead class="table-primary">
            <tr>
                <th>Images</th>
                <th>Payment Name</th>
                <th>Update</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($paymentMethods as $paymentMethod)
            <tr>
                <td class="align-middle">
                    @foreach(explode(',', $paymentMethod->image) as $imagePath)
                    <img src="{{ asset(trim($imagePath)) }}" alt="{{ $paymentMethod->name }}" width="150" height="150">
                    @endforeach
                </td>                
                <td class="align-middle">{{$paymentMethod->payment_name}}</td>
                
               
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection