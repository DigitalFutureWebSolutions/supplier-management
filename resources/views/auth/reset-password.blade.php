@extends('/../layout')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2 class="text-center">Reset Password</h2>
            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input id="email" type="email" class="form-control" name="email" required>
                </div>

                <div class="form-group">
                    <label for="password">New Password:</label>
                    <input id="password" type="password" class="form-control" name="password" required>
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Confirm New Password:</label>
                    <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required>
                </div>

                <button type="submit" class="btn btn-primary btn-block">Reset Password</button>
            </form>
        </div>
    </div>
@endsection
