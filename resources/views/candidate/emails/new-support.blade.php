<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .content {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 5px;
            border: 1px solid #dee2e6;
        }
        .info-item {
            margin-bottom: 15px;
        }
        .label {
            font-weight: bold;
            color: #495057;
        }
        .value {
            margin-top: 5px;
        }
        .footer {
            margin-top: 20px;
            font-size: 0.9em;
            color: #6c757d;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>Thông báo: Có yêu cầu tư vấn mới</h2>
    </div>

    <div class="content">
        <div class="info-item">
            <div class="label">Loại tư vấn:</div>
            <div class="value">{{ $supportData['type_title'] }}</div>
        </div>

        <div class="info-item">
            <div class="label">Số điện thoại:</div>
            <div class="value">{{ $supportData['phone'] }}</div>
        </div>

        <div class="info-item">
            <div class="label">Email:</div>
            <div class="value">{{ $supportData['email'] }}</div>
        </div>

        <div class="info-item">
            <div class="label">Nội dung:</div>
            <div class="value">{{ $supportData['description_info'] }}</div>
        </div>

        <div class="info-item">
            <div class="label">Thời gian gửi:</div>
            <div class="value">{{ $supportData['created_at'] }}</div>
        </div>
    </div>

    <div class="footer">
        <p>Email này được gửi tự động từ hệ thống Việc làm tại Nam Châu</p>
    </div>
</body>
</html>
