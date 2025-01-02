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

                {{-- <form method="POST" action="{{ route('candidate.register.submit') }}">
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
                        <input type="text" class="form-control" id="name" name="name" placeholder="Họ và tên"
                            required>
                        <label for="name"><i class="fas fa-user me-2"></i>Họ và tên</label>
                    </div>

                    <div class="form-floating">
                        <input type="email" class="form-control" id="email" name="email"
                            placeholder="name@example.com" required>
                        <label for="email"><i class="fas fa-envelope me-2"></i>Email</label>
                    </div>

                    <div class="form-floating">
                        <input type="tel" class="form-control" id="phone" name="phone" placeholder="Số điện thoại"
                            required>
                        <label for="phone"><i class="fas fa-phone me-2"></i>Số điện thoại</label>
                    </div>

                    <div class="form-floating">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password"
                            required>
                        <label for="password"><i class="fas fa-lock me-2"></i>Mật khẩu</label>
                    </div>

                    <div class="form-floating">
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                            placeholder="Confirm Password" required>
                        <label for="password_confirmation"><i class="fas fa-lock me-2"></i>Xác nhận mật khẩu</label>
                    </div>

                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="terms" name="terms" required>
                        <label class="form-check-label" for="terms">
                            Tôi đồng ý với <a href="#">điều khoản sử dụng</a>
                        </label>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-user-plus me-2"></i>Đăng ký
                    </button>



                </form> --}}
                  <div class="auth-footer">
                        <p>
                            Đã có tài khoản?
                            <a href="{{ route('candidate.login') }}">Đăng nhập</a>
                        </p>
                    </div>
                <div class="mt-3 text-center">
                    <a href="{{ route('candidate.auth.google') }}" class="btn btn-danger">
                        <i class="fab fa-google me-2"></i>Đăng ký bằng Google
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
