@extends('customer.layouts.profile')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center mb-4">
                <img src="{{ asset('customer_images/' . $customerInfo->image) }}" alt="User Image" class="rounded-circle" style="width: 100px; height: 100px;">
                <h3 class="mt-3">{{ $customerInfo->name }}</h3>
                
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 offset-md-3">
                <!-- Other user information as before -->
                <div class="form-group">
                <h5 class="mt-4">Email</h5>
                    <input type="text" class="form-control" id="email" value="{{ $email }}" readonly>
                </div>
                <div class="form-group">
                <h5 class="mt-4">Address</h5>
                    <input type="text" class="form-control" id="address" value="{{ $customerInfo->Address }}" readonly>
                </div>
                <div class="form-group">
                <h5 class="mt-4">Phone Number</h5>
                    <input type="text" class="form-control" id="phoneNumber" value="{{ $customerInfo->PhoneNumber }}" readonly>
                </div>
                <!-- Add more fields as needed -->
            </div>
        </div>
    </div>
@endsection
