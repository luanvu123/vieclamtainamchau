<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xác thực tài khoản</title>
</head>
<body>
    <p>Xin chào {{ $employerName }},</p>
<p>Vui lòng nhấn vào đường link dưới đây để xác thực tài khoản của bạn:</p>
<a href="{{ $verificationLink }}">Xác thực tài khoản</a>
<p>Cảm ơn!</p>

    <p>Nếu bạn không đăng ký tài khoản này, vui lòng bỏ qua email này.</p>
    <p>Trân trọng,<br>Đội ngũ hỗ trợ</p>
</body>
</html>
