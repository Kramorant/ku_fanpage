@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div class="container">
    <div class="row justify-content-center mt-4">
        <div class="col-md-5">
            <div class="card-ku p-4 rounded-3">
                <h2 class="fw-bold mb-4 text-center" style="color:var(--ku-accent)">
                    <i class="bi bi-person-plus-fill me-2"></i>Register
                </h2>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label text-secondary">Display Name</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                               value="{{ old('name') }}" required autofocus
                               placeholder="KaijuFan123">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-secondary">Email address</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                               value="{{ old('email') }}" required
                               placeholder="you@example.com">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-secondary">Password</label>
                        <input type="password" name="password"
                               class="form-control @error('password') is-invalid @enderror"
                               required placeholder="Min. 8 characters">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-secondary">Confirm Password</label>
                        <input type="password" name="password_confirmation" class="form-control"
                               required placeholder="Repeat password">
                    </div>

                    <button type="submit" class="btn btn-ku w-100 fw-bold">
                        <i class="bi bi-person-check-fill me-1"></i>Create Account
                    </button>
                </form>

                <p class="text-center text-secondary mt-3 mb-0">
                    Already have an account?
                    <a href="{{ route('login') }}" style="color:var(--ku-accent)">Login here</a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
