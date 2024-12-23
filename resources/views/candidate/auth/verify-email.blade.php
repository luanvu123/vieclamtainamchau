
@extends('layouts.layout_candidate')

@section('title', 'Xác thực email')

@section('content')
<div class="auth-container">
    <div class="container">
        <div class="auth-card">
            <div class="auth-header">
                <h2>Xác thực email</h2>
                <p class="text-muted">Vui lòng xác thực email của bạn để tiếp tục</p>
            </div>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="verification-content">
                <p>Link xác thực đã được gửi đến email của bạn.</p>
                <p>Nếu bạn chưa nhận được email, hãy nhấn nút bên dưới để gửi lại.</p>

                <form method="POST" action="{{ route('candidate.verification.send') }}">
                    @csrf
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-paper-plane me-2"></i>Gửi lại email xác thực
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
