<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cập nhật trạng thái hồ sơ</title>
</head>

<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px;">
    <div
        style="max-width: 600px; margin: 0 auto; background-color: #ffffff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);">
        <img src="{{ asset('storage/' . $info->logo) }}" alt="Logo"
            style="max-width: 150px; display: block; margin: 0 auto 20px;">

        <p>Chào {{ $application->candidate->fullname_candidate }},</p>

        <p>Cảm ơn bạn đã dành thời gian tham gia ứng tuyển cho vị trí
            <strong>{{ $application->jobPosting->title }}</strong> tại
            <strong>{{ $application->jobPosting->company->name }}</strong>.
        </p>

        <p>Sau khi xem xét các hồ sơ ứng tuyển, Nhà tuyển dụng đã đánh giá CV của bạn là:
            <strong>{{ $statusMessage }}</strong>.
        </p>

        @if ($rating)
            <p>Điểm đánh giá CV của bạn: <strong>{{ $rating }}/5</strong></p>
        @endif

        <p style="text-align: center; margin-top: 20px;">
            <a href="{{ route('applications.showAppliedJobs') }}"
                style="background-color: #28a745; color: white; padding: 12px 24px; text-decoration: none; border-radius: 5px;">Xem
                chi tiết</a>
        </p>

        <p>Hãy giữ cho hồ sơ của bạn luôn cập nhật và bật trạng thái tìm việc để có thêm nhiều cơ hội từ các nhà tuyển
            dụng hàng đầu.</p>

        <p style="text-align: center;">
            <a href="{{ route('candidate.account') }}" style="text-decoration: none; color: #007bff;">Trang thái tìm
                việc</a> |
            <a href="{{ route('saved-jobs') }}" style="text-decoration: none; color: #007bff;">Tìm công việc phù hợp</a>
        </p>

        <footer style="text-align: center; margin-top: 30px; color: #888;">
            <p>{{ $info->copyright }}</p>
        </footer>
    </div>
</body>


</html>
