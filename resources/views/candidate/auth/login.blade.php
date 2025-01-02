@extends('layouts.layout_candidate')

@section('title', 'Đăng nhập ứng viên')

@section('content')
<div class="auth-container">
    <div class="container">
        <div class="auth-card">
            <div class="auth-header">
                <h2>Đăng nhập</h2>
                <p class="text-muted">Chào mừng bạn trở lại!</p>
            </div>

            {{-- <form method="POST" action="{{ route('candidate.login.submit') }}">
                @csrf

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="form-floating">
                    <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" required>
                    <label for="email"><i class="fas fa-envelope me-2"></i>Email</label>
                </div>

                <div class="form-floating">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                    <label for="password"><i class="fas fa-lock me-2"></i>Mật khẩu</label>
                </div>

                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" id="remember" name="remember">
                    <label class="form-check-label" for="remember">
                        Ghi nhớ đăng nhập
                    </label>
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-sign-in-alt me-2"></i>Đăng nhập
                </button>


            </form> --}}
              <div class="mt-3 text-center">
                    <a href="{{ route('candidate.auth.google') }}" class="btn btn-danger">
                        <i class="fab fa-google me-2"></i>Đăng ký bằng Google
                    </a>
                </div>
              <div class="auth-footer">
                    <p class="mb-2">
                        <a href="{{ route('candidate.password.request') }}">Quên mật khẩu?</a>
                    </p>
                    <p>
                        Chưa có tài khoản?
                        <a href="{{ route('candidate.register') }}">Đăng ký ngay</a>
                    </p>
                </div>
        </div>
    </div>
</div>
@endsection
