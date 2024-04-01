@extends('customer.layouts.cart') 

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mb-5 mb-lg-0">
                <h3>Contact Details</h3>
                @if (session('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('error') }}
                    </div>
                @endif
                <form method="POST" action="{{ route('customer.placeorder') }}">
                @csrf
                <div class="mb-3">
                        <label for="customerName" class="form-label">Customer Name</label>
                        <input type="text" class="form-control" id="customerName" name="customerName" value="{{$customerInfo->name}}"  readonly>
                    </div>
                    <div class="mb-3">
                        <label for="phoneNumber" class="form-label">Phone Number</label>
                        <input type="text" class="form-control" id="phoneNumber" name="phoneNumber"  value="{{$customerInfo->PhoneNumber}}" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="shippingAddress" class="form-label">Address</label>
                        <input type="text" class="form-control" id="shippingAddress" name="shippingAddress" value="{{$customerInfo->Address}}" readonly>
                    </div>
                    <div class="mb-3 d-flex flex-column">
                    <label for="paymentMethod" class="form-label align-self-start">Payment Method</label>
                        <select class="form-control" id="paymentMethod" name="paymentMethod">
                            <option value="">Select a payment method</option>
                            <option value="creditCard">Cash on Delivery</option>
                        </select>
                    </div>
                    @foreach($cart as $item)
                        <input type="hidden" name="product_id[]" value="{{ $item->product->id }}">
                        <input type="hidden" name="quantity[]" value="{{ $item->quantity }}">
                    @endforeach
                    <input type="hidden" name="shippingFee" value="{{ $shippingFee }}">
                    <input type="hidden" name="totalAmount" value="{{ $subTotal + $shippingFee }}">

                    <button type="submit" class="btn_1 checkout_btn_1">Place Order</button>
                </form>
            </div>
            <div class="col-lg-6">
                <div class ="sub-title"> 
                    <h3>Order Summary</h3>
                </div>
            <div class="card cart-sumamry">
                <div class="card-body">
                @foreach($cart as $item)
                <div class="d-flex justify-content-between pb-2">
                  <div class ="h6"> {{$item->product->name}} X {{$item->quantity}} </div>
                  <div class ="h6"> {{ $item->product->price *$item->quantity}}</div>    

                  <input type="hidden" name="product_id[]" value="{{ $item->product->id }}">
                    <input type="hidden" name="quantity[]" value="{{ $item->quantity }}">
                </div>
                @endforeach

                <div class="d-flex justify-content-between summary-end">
                <div class ="h6"><strong>Subtotal</strong></div>
                <div class ="h6"><strong>₱{{ $subTotal }}</strong></div>
                </div>

                <div class="d-flex justify-content-between mt-2">
                <div class ="h6"><strong>Shipping Fee</strong></div>
                <div class ="h6"><strong>₱{{ $shippingFee }}</strong></div>
                </div>

                <div class="d-flex justify-content-between summary-end">
                <div class ="h6"><strong>Total Amount</strong></div>
                <div class ="h6"><strong>₱{{ $subTotal + $shippingFee  }}</strong></div>
                </div>

</div>
</div>


                    
                
@endsection
