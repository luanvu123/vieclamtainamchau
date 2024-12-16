@extends('layouts.layout_candidate')

@section('title', 'Quên mật khẩu')

@section('content')
<div class="auth-container">
    <div class="container">
        <div class="auth-card">
            <div class="auth-header">
                <h2>Quên mật khẩu?</h2>
                <p class="text-muted">Nhập email của bạn để nhận hướng dẫn đặt lại mật khẩu</p>
            </div>

            <form method="POST" action="{{ route('candidate.password.email') }}">
                @csrf

                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

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

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-paper-plane me-2"></i>Gửi liên kết đặt lại mật khẩu
                </button>

                <div class="auth-footer">
                    <p>
                        <a href="{{ route('candidate.login') }}">
                            <i class="fas fa-arrow-left me-2"></i>Quay lại đăng nhập
                        </a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
