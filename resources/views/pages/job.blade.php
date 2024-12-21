@extends('layout')

@section('content')
    <style>
        .job-card {
            background: white;
            border-radius: 8px;
            padding: 20px;
            max-width: 1200px;
            margin: 0 auto;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .company-logo {
            width: 100px;
            margin-bottom: 15px;
        }

        .job-header {
            margin-bottom: 20px;
        }

        .company-name {
            color: #666;
            font-size: 14px;
            margin-bottom: 8px;
        }

        .job-title {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .job-meta {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
            margin-bottom: 20px;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #666;
            font-size: 14px;
        }

        .meta-item img {
            width: 20px;
            height: 20px;
        }

        .first-apply {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #ff6b00;
            font-size: 14px;
            margin-bottom: 20px;
        }

        .buttons {
            display: flex;
            gap: 15px;
            margin-bottom: 30px;
        }

        .apply-btn {
            background: #4527a0;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 500;
        }

        .save-btn {
            background: none;
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 6px;
            cursor: pointer;
        }

        .tabs {
            display: flex;
            gap: 20px;
            border-bottom: 1px solid #eee;
            margin-bottom: 20px;
        }

        .tab {
            padding: 10px 0;
            color: #666;
            cursor: pointer;
        }

        .tab.active {
            color: #4527a0;
            border-bottom: 2px solid #4527a0;
        }

        .info-section {
            margin-bottom: 30px;
        }

        .info-section h2 {
            font-size: 18px;
            margin-bottom: 15px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 20px;
        }

        .info-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 15px;
            background: #f8f8ff;
            border-radius: 6px;
        }

        .info-item img {
            width: 24px;
            height: 24px;
        }

        .job-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 30px;
        }

        .job-tag {
            color: #4527a0;
            text-decoration: none;
            font-size: 14px;
        }

        .job-description {
            color: #333;
            line-height: 1.6;
        }

        .job-description h2 {
            font-size: 18px;
            margin: 25px 0 15px;
        }

        .job-description ul {
            list-style-type: none;
            padding-left: 20px;
        }

        .job-description li {
            margin-bottom: 10px;
            position: relative;
        }

        .job-description li::before {
            content: "-";
            position: absolute;
            left: -20px;
        }

        @media (max-width: 768px) {
            .job-meta {
                flex-direction: column;
                gap: 10px;
            }

            .buttons {
                flex-direction: column;
            }

            .apply-btn,
            .save-btn {
                width: 100%;
            }
        }
    </style>
    <div class="job-card">
        <img src="{{ asset('storage/' . $jobPosting->employer->logo) }}" alt="{{ $jobPosting->employer->name }}"
            class="company-logo">

        <div class="job-header">
            <div class="company-name">{{ $jobPosting->employer->name }}</div>
            <h1 class="job-title">{{ $jobPosting->title }}</h1>

            <div class="job-meta">
                <div class="meta-item">
                    <img src="{{ asset('frontend/img/dollar-svgrepo-com.png') }}" alt="salary">
                    {{ $jobPosting->salary }}
                </div>
                <div class="meta-item">
                    <img src="{{ asset('frontend/img/alarm-svgrepo-com.png') }}" alt="deadline">
                    Hạn nộp hồ sơ: {{ \Carbon\Carbon::parse($jobPosting->closing_date)->format('d/m/Y') }}
                </div>
                <div class="meta-item">
                    <img src="{{ asset('frontend/img/map-location-pin-svgrepo-com.png') }}" alt="location">
                    {{ $jobPosting->location }}
                </div>
            </div>

            <div class="buttons">
                <a href="{{ $jobPosting->application_email_url }}" class="apply-btn">Nộp hồ sơ</a>
                <button class="save-btn">♡ Lưu</button>
            </div>
        </div>

        <div class="tabs">
            <div class="tab active">Chi tiết tuyển dụng</div>
            <div class="tab">Công ty</div>
        </div>

        <div class="info-section">
            <h2>Thông tin chung</h2>
            <div class="info-grid">
                <div class="info-item">
                    <img src="{{ asset('frontend/img/date-svgrepo-com.png') }}" alt="calendar">
                    <div>
                        <div>Ngày đăng</div>
                        <strong>{{ \Carbon\Carbon::parse($jobPosting->created_at)->format('d/m/Y') }}</strong>
                    </div>
                </div>
                <div class="info-item">
                    <img src="{{ asset('frontend/img/ladder-svgrepo-com.png') }}" alt="level">
                    <div>
                        <div>Cấp bậc</div>
                        <strong>{{ $jobPosting->rank }}</strong>
                    </div>
                </div>
                <div class="info-item">
                    <img src="{{ asset('frontend/img/number-5-svgrepo-com.png') }}" alt="headcount">
                    <div>
                        <div>Số lượng tuyển</div>
                        <strong>{{ $jobPosting->number_of_recruits }}</strong>
                    </div>
                </div>
                <div class="info-item">
                    <img src="{{ asset('frontend/img/time-svgrepo-com.png') }}" alt="type">
                    <div>
                        <div>Hình thức làm việc</div>
                        <strong>{{ $jobPosting->type }}</strong>
                    </div>
                </div>
                <div class="info-item">
                    <img src="{{ asset('frontend/img/age-21-svgrepo-com.png') }}" alt="age">
                    <div>
                        <div>Độ tuổi</div>
                        <strong>{{ $jobPosting->age_range }}</strong>
                    </div>
                </div>
                <div class="info-item">
                    <img src="{{ asset('frontend/img/university-svgrepo-com.png') }}" alt="experience">
                    <div>
                        <div>Yêu cầu kinh nghiệm</div>
                        <strong>{{ $jobPosting->experience }}</strong>
                    </div>
                </div>
            </div>

            <div class="job-tags">
                @foreach (explode(',', $jobPosting->tags) as $tag)
                    <a href="#" class="job-tag">{{ $tag }}</a>
                @endforeach
            </div>

            <div class="job-description">
                <h2>Mô tả công việc</h2>
                {!! nl2br(e($jobPosting->description)) !!}

                <h2>Yêu cầu công việc</h2>
                {!! nl2br(e($jobPosting->skills_required)) !!}
            </div>
        </div>
    </div>
@endsection
