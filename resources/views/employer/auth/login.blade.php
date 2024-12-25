@extends('layouts.layout_employer')

@section('title', 'Login')

@section('content')
<div class="auth-container">
    <div class="auth-card">
        <h1>Đăng nhập nhà tuyển dụng</h1>

        <form method="POST" action="{{ route('employer.login.submit') }}" class="auth-form">
            @csrf

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" required value="{{ old('email') }}">
                @error('email')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required>
                @error('password')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group remember-me">
                <label>
                    <input type="checkbox" name="remember"> Remember me
                </label>
                <a href="{{ route('employer.password.request') }}" class="forgot-password">
                    Forgot Password?
                </a>
            </div>

            <button type="submit" class="btn-submit">Đăng nhập</button>
        </form>

        <p class="auth-links">
            Bạn chưa có tài khoản?
            <a href="{{ route('employer.register') }}">Đăng kí ngay</a>
        </p>
    </div>
</div>
