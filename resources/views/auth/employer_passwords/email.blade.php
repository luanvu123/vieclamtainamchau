@extends('layouts.layout_employer')

@section('title', 'Reset Password')

@section('content')
<div class="auth-container">
    <div class="auth-card">
        <h1>Reset Password</h1>

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('employer.password.email') }}" class="auth-form">
            @csrf

            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" name="email" id="email" required value="{{ old('email') }}">
                @error('email')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn-submit">Send Password Reset Link</button>
        </form>

        <p class="auth-links">
            Remember your password?
            <a href="{{ route('employer.login') }}">Login here</a>
        </p>
    </div>
</div>
