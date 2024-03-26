@extends('customer.layouts.app')
  
@section('title', 'Add Review')
  
@section('content')
@include('messages')

<body>
<div class="container mt-4">
    <div class="container">
        <form action="{{ route('reviews.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
              @method('post')
            <div class="form-group">
                <label for="rate">Rate: </label>
                <input type="text" class="form-control" name="rate" required>
            </div>
            <div class="form-group">
                <label for="comment">Comment: </label>
                <input type="text" class="form-control" name="comment" required>
            </div>
            <div class="form-group">
                <label for="image">Images: </label>
                <input type="file" class="form-control-file" name="image" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
</body>
@endsection
