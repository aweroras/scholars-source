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
            <form method="post" action="{{ route('customer.editprofile.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="form-group">
                        <h5 class="mt-4">Email</h5>
                        <input type="text" class="form-control" id="email" name="email" value="{{ $email }}" required>
                    </div>
                    <div class="form-group">
                        <h5 class="mt-4">Name</h5>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $customerInfo->name }}" required>
                    </div>
                    
                    <div class="form-group">
                        <h5 class="mt-4">Address</h5>
                        <input type="text" class="form-control" id="address" name="address" value="{{ $customerInfo->Address }}" required>
                    </div>
                    <div class="form-group">
                        <h5 class="mt-4">Phone Number</h5>
                        <input type="text" class="form-control" id="phoneNumber" name="phone" value="{{ $customerInfo->PhoneNumber }}" required>
                    </div>
                    <div class="form-group">
                        <h5 class="mt-4">Profile Image</h5>
                        <input type="file" class="form-control" id="image" name="image">
                    </div>
                    <!-- Add more fields as needed -->
                    <div class="text-right mt-2">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
