@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header text-center">
                        <h4>InstaApp</h4>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="/login">
                            @csrf

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
                            </div>

                            <button type="submit" class="btn btn-primary w-100">Log In</button>
                        </form>

                        <div class="text-center mt-3">
                            Don't have an account? <a href="/register">Sign up</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection