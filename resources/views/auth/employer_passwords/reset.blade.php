@extends('layouts.layout_employer')

@section('title', 'Reset Password')

@section('content')
<div class="auth-container">
    <div class="auth-card">
        <h1>Reset Password</h1>

        <form method="POST" action="{{ route('employer.password.update') }}" class="auth-form">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">

            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email"
                       id="email"
                       name="email"
                       value="{{ $email ?? old('email') }}"
                       required
                       autocomplete="email"
                       autofocus>
                @error('email')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">New Password</label>
                <input type="password"
                       id="password"
                       name="password"
                       required
                       autocomplete="new-password">
                @error('password')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password-confirm">Confirm New Password</label>
                <input type="password"
                       id="password-confirm"
                       name="password_confirmation"
                       required
                       autocomplete="new-password">
            </div>

            <button type="submit" class="btn-submit">
                Reset Password
            </button>
        </form>

        <p class="auth-links">
            Remember your password?
            <a href="{{ route('employer.login') }}">Login here</a>
        </p>
    </div>
</div>
@endsection
