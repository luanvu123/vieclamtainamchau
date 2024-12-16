@extends('layouts.layout_candidate')

@section('title', 'Đặt lại mật khẩu')

@section('content')
<div class="auth-container">
    <h2>Đặt lại mật khẩu</h2>
    <form method="POST" action="{{ route('candidate.password.update') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <input type="hidden" name="email" value="{{ $email }}">
        <div class="form-group">
            <label for="password">Mật khẩu mới</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="password_confirmation">Xác nhận mật khẩu</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Đặt lại mật khẩu</button>
    </form>
</div>
@endsection
