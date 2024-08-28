@extends('/../layout')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2 class="text-center">Forgot Password</h2>
            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input id="email" type="email" class="form-control" name="email" required>
                    @error('email')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary btn-block">Send Password Reset Link</button>
            </form>
        </div>
    </div>
@endsection
