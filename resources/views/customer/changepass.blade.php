@extends('customer.layouts.profile')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h3 class="mt-3">Change Password</h3>
                <div class="card">
                    <div class="card-body">
                        <form id="passwordForm" method="post" action="{{ route('change.password') }}">
                            @csrf

                            <!-- Display errors -->
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="form-group">
                                <label for="current_password">{{ __('Current Password') }}</label>
                                <input type="password" class="form-control" name="current_password" required autocomplete="new-password">
                            </div>

                            <div class="form-group">
                                <label for="password">{{ __('New Password') }}</label>
                                <input type="password" class="form-control" name="password" required>
                            </div>

                            <div class="form-group">
                                <label for="password_confirmation">{{ __('Confirm New Password') }}</label>
                                <input type="password" class="form-control" name="password_confirmation" required>
                            </div>

                            <button type="button" class="btn btn-primary" style="font-size: 11px; padding: 15px 12px;" data-toggle="modal" data-target="#confirmModal">
                                {{ __('Update Password') }}
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="confirmModalLabel">Confirm Update</h5>
                                            <button type="button"  class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure you want to update your password?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" style="font-size: 13px; padding: 15px 20px;" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                            <button type="submit" style="font-size: 13px; padding: 15px 20px;" class="btn btn-primary">Confirm</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
