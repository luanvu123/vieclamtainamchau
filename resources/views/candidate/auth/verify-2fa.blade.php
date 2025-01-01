@extends('layouts.layout_candidate')

@section('title', 'Đăng ký ứng viên')

@section('content')
    <div class="auth-container">
        <div class="container">
            <div class="auth-card">
                <div class="auth-header">
                    <h2>Đăng ký tài khoản</h2>
                    <p class="text-muted">Tạo tài khoản để bắt đầu tìm việc</p>
                </div>

             <form method="POST" action="{{ route('2fa.verify.post') }}">
    @csrf
    <div>
        <label>Nhập mã xác thực từ Google Authenticator</label>
        <input type="text" name="one_time_password" required>
    </div>
    <button type="submit">Xác thực</button>
</form>
                <div class="mt-3 text-center">
                    <a href="{{ route('candidate.auth.google') }}" class="btn btn-danger">
                        <i class="fab fa-google me-2"></i>Đăng ký bằng Google
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
