@extends('layouts.layout_employer')

@section('title', 'Register')

@section('content')
<div class="auth-container">
    <div class="auth-card">
        <h1>Đăng kí nhà tuyển dụng</h1>

        <form method="POST" action="{{ route('employer.register.submit') }}" class="auth-form" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="name">Tên nhà tuyển dụng</label>
                <input type="text" name="name" id="name" required value="{{ old('name') }}">
                @error('name')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" required value="{{ old('email') }}">
                @error('email')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="phone">Số điện thoại công ty</label>
                <input type="tel" name="phone" id="phone" required value="{{ old('phone') }}">
                @error('phone')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="company_name">Tên công ty</label>
                <input type="text" name="company_name" id="company_name" required value="{{ old('company_name') }}">
                @error('company_name')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Mật khảu</label>
                <input type="password" name="password" id="password" required>
                @error('password')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation">Nhập lại mật khẩu</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required>
            </div>

            <button type="submit" class="btn-submit">Đăng kí</button>
        </form>

        <p class="auth-links">
            Bạn đã có tài khoản
            <a href="{{ route('employer.login') }}">Đăng nhập ngay</a>
        </p>
    </div>
</div>
