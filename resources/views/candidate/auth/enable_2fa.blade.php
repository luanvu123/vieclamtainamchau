@extends('layouts.layout_candidate')

@section('content')
<div class="container">
    <h2>Kích hoạt Google Authenticator</h2>
    <p>Quét mã QR bên dưới bằng ứng dụng Google Authenticator:</p>
   <div>
    <p>Quét mã QR bên dưới bằng ứng dụng Google Authenticator:</p>
    <img src="{{ $qrCodeUrl }}" alt="QR Code">
    <p>Hoặc nhập mã này vào ứng dụng: {{ $secret }}</p>

    <form method="POST" action="{{ route('2fa.enable.post') }}">
        @csrf
        <div>
            <label>Nhập mã xác thực để xác nhận</label>
            <input type="text" name="one_time_password" required>
        </div>
        <button type="submit">Xác nhận</button>
    </form>
</div>
</div>
@endsection
