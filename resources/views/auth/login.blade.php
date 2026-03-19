@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="container">
    <div class="row justify-content-center mt-4">
        <div class="col-md-5">
            <div class="card-ku p-4 rounded-3">
                <h2 class="fw-bold mb-4 text-center" style="color:var(--ku-accent)">
                    <i class="bi bi-box-arrow-in-right me-2"></i>Login
                </h2>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label text-secondary">Email address</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                               value="{{ old('email') }}" required autofocus
                               placeholder="you@example.com">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-secondary">Password</label>
                        <input type="password" name="password"
                               class="form-control @error('password') is-invalid @enderror"
                               required placeholder="••••••••">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" name="remember" id="remember">
                        <label class="form-check-label text-secondary" for="remember">Remember me</label>
                    </div>

                    <button type="submit" class="btn btn-ku w-100 fw-bold">
                        <i class="bi bi-box-arrow-in-right me-1"></i>Login
                    </button>
                </form>

                <p class="text-center text-secondary mt-3 mb-0">
                    Don't have an account?
                    <a href="{{ route('register') }}" style="color:var(--ku-accent)">Register here</a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
