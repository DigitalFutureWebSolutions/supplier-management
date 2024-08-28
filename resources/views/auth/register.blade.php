@extends('/../layout')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2 class="text-center">Register</h2>
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-group">
                    <label for="name">Name:</label>
                    <input id="name" type="text" class="form-control" name="name" required autofocus>
                </div>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input id="email" type="email" class="form-control" name="email" required>
                </div>

                <div class="form-group">
                    <label for="username">Username:</label>
                    <input id="username" type="text" class="form-control" name="username" required>
                </div>

                <div class="form-group">
                    <label for="password">Password:</label>
                    <input id="password" type="password" class="form-control" name="password" required>
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Confirm Password:</label>
                    <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required>
                </div>

                <button type="submit" class="btn btn-primary btn-block">Register</button>
            </form>
        </div>
    </div>
@endsection
