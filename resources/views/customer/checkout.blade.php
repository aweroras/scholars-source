@extends('customer.layouts.cart') 

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mb-5 mb-lg-0">
                <h3>Shipping Address</h3>
                @if (session('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('error') }}
                    </div>
                @endif
                    <div class="mb-3">
                        <label for="shippingAddress" class="form-label">Address</label>
                        <input type="text" class="form-control" id="shippingAddress" name="shipping[address]" value="{{ old('shipping.address') }}">
                    </div>
                    <div class="mb-3">
                        <label for="shippingCity" class="form-label">City</label>
                        <input type="text" class="form-control" id="shippingCity" name="shipping[city]" value="{{ old('shipping.city') }}">
                    </div>
                    <div class="mb-3">
                        <label for="shippingPostalCode" class="form-label">Postal Code</label>
                        <input type="text" class="form-control" id="shippingPostalCode" name="shipping[postal_code]" value="{{ old('shipping.postal_code') }}">
                    </div>
                    <button type="submit" class="btn_1 checkout_btn_1">Update Shipping</button>
                </form>
            </div>
            <div class="col-lg-6">
                <div class ="sub-title">
                    <h3>Order Summary</h3>
                    @if (isset($cart) && count($cart) > 0)  
                </div>
                <div class="card cart-sumamry">
            <div class="card-body">
                @foreach($cart as $item)
                <div class="d-flex justify-content-between pb-2">
                    <div class ="h6"> {{$item->name}} X {{$item->qty}} </div>
                    <div class ="h6"> {{$item->price*$item->qty}}</div>
                    <div class ="h6"> Notebook x 1 </div>
                    <div class ="h6"> 150 </div>
                </div>
                </div>
                </div>
</div>
                    @endforeach
                    @endforelse
@endsection
