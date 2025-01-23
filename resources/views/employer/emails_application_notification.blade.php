<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ứng viên đã ứng tuyển</title>
</head>
<body>
    <h1>Ứng viên đã ứng tuyển vào công việc của bạn</h1>
    <p>Xin chào,</p>
    <p>Ứng viên <strong>{{ $candidateName }}</strong> đã ứng tuyển vào công việc <strong>{{ $jobTitle }}</strong>.</p>
    <p>Bạn có thể xem CV của ứng viên tại đây: <a href="{{ $cvPath }}">Tải CV</a></p>
    <p>Trân trọng,</p>
    <p>Hệ thống tuyển dụng</p>
</body>
</html>
