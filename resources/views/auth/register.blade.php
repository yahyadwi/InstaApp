@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header text-center">
                        <h4>InstaApp</h4>
                        <p>Sign up to see photos from your friends.</p>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="/register">
                            @csrf

                            <div class="mb-3">
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                    placeholder="Full Name" value="{{ old('name') }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <input type="text" class="form-control @error('username') is-invalid @enderror"
                                    name="username" placeholder="Username" value="{{ old('username') }}" required>
                                @error('username')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                                    placeholder="Email" value="{{ old('email') }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    name="password" placeholder="Password" required>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <input type="password" class="form-control" name="password_confirmation"
                                    placeholder="Confirm Password" required>
                            </div>

                            <button type="submit" class="btn btn-primary w-100">Sign Up</button>
                        </form>

                        <div class="text-center mt-3">
                            Have an account? <a href="/login">Log in</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection