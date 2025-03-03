@extends('layout')

@section('content')
 <style>
        .btn-detail {
            display: inline-block;
            padding: 8px 15px;
            background-color: #007bff;
            color: white;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        .btn-detail:hover {
            background-color: #0056b3;
        }

        /* Popup Styles */
        .popup {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
        }

        .popup-content {
            position: relative;
            background-color: #fff;
            margin: 15% auto;
            padding: 20px;
            width: 90%;
            max-width: 500px;
            border-radius: 8px;
        }

        .detail-content {
            max-width: 800px;
            margin: 5% auto;
        }

        .close-btn {
            position: absolute;
            right: 20px;
            top: 10px;
            font-size: 24px;
            cursor: pointer;
            color: #666;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }

        .submit-btn {
            width: 100%;
            padding: 12px;
            background-color: #ff1f6d;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .btn-view {
            background: none;
            border: none;
            color: #666;
            cursor: pointer;
            font-size: 18px;
            padding: 5px;
        }

        .btn-view:hover {
            color: #ff1f6d;
        }

        .job-categories2 {
            padding: 60px 20px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .section-title {
            text-align: center;
            font-size: 24px;
            margin-bottom: 40px;
            font-weight: bold;
        }

        .slider-container {
            position: relative;
            overflow: hidden;
        }

        .slider {
            display: flex;
            transition: transform 0.5s ease;
            gap: 20px;
        }

        .job-card {
            flex: 0 0 calc(33.333% - 20px);
            min-width: calc(33.333% - 20px);
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .job-image {
            height: 200px;
            overflow: hidden;
        }

        .job-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .job-content {
            padding: 20px;
        }

        .date {
            color: #666;
            font-size: 14px;
            margin-bottom: 10px;
        }

        .job-content h3 {
            font-size: 18px;
            margin-bottom: 15px;
            font-weight: bold;
        }

        .job-details {
            list-style: none;
            padding: 0;
            margin-bottom: 20px;
        }

        .job-details li {
            margin-bottom: 10px;
            font-size: 14px;
            line-height: 1.4;
        }

        .job-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
        }

        .location {
            color: #666;
            font-size: 14px;
        }

        .btn-participate {
            background: #ff1f6d;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
        }

        .slider-nav {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 20px;
        }

        .nav-dot {
            width: 30px;
            height: 4px;
            background: #ccc;
            border: none;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .nav-dot.active {
            background: #ff1f6d;
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .job-card {
                flex: 0 0 calc(50% - 20px);
                min-width: calc(50% - 20px);
            }
        }

        @media (max-width: 768px) {
            .job-card {
                flex: 0 0 100%;
                min-width: 100%;
            }
        }
    </style>
    <div class="container">
        <div class="sidebar">
            <div class="menu-title">Quản lý CV</div>
            <div class="menu-section">

                <a href="{{ route('candidate.cv.white') }}" class="menu-item">
                    <i>📄</i>
                    <span>Mẫu CV cổ điển</span>
                </a>
                <a href="{{ route('candidate.cv.black') }}" class="menu-item">
                    <i>📄</i>
                    <span>Mẫu CV hiện đại</span>
                </a>
                <a href="{{ route('candidate.cv.logistic') }}" class="menu-item">
                    <i>📄</i>
                    <span>Mẫu CV Xuất khẩu LD</span>
                </a>
            </div>

            <div class="menu-section">
                <div class="menu-title">Quản lý ứng tuyển</div>
                <a href="{{ route('candidate.profile.edit') }}" class="menu-item">
                    <i>📊</i>
                    <span>Cập nhật hồ sơ & CV</span>
                </a>
                <a href="{{ route('candidate.applications') }}" class="menu-item">
                    <i>👥</i>
                    <span>Hồ sơ đã nộp</span>
                </a>
                <a href="{{ route('candidate.saved.jobs') }}" class="menu-item">
                    <i>❤️</i>
                    <span>Hồ sơ đã lưu</span>
                </a>
                <a href="{{ route('candidate.notifications') }}" class="menu-item">
                    <i>📋</i>
                    <span>Thông báo</span>
                </a>
                  <a href="{{ route('candidate.saved.study.abroad') }}" class="menu-item">
                    <i>❤️</i>
                    <span>Du học nghề đã lưu</span>
                </a>
            </div>

        </div>
        @if ($savedStudyAbroad->count() > 0)
            <div class="main-content">
                <div class="row">

                    @foreach ($savedStudyAbroad as $study)
                        <div class="job-card">
                            <div class="job-image">
                                <img src="{{ asset('storage/' . $study->image) }}" alt="{{ $study->name }}">
                            </div>
                            <div class="job-content">
                                <div class="date">
                                    <i class="far fa-calendar"></i>
                                    {{ now()->locale('vi')->translatedFormat('j F, Y') }}
                                </div>

                                <h3>{{ $study->name }}
                                </h3>
                                <div class="job-details">
                                    {{ $study->short_detail }}

                                </div>
                                <div class="job-footer">
                                    <span class="location">
                                        <i class="fas fa-map-marker-alt"></i>
                                        @foreach ($study->countries as $country)
                                            {{ $country->name }}@if (!$loop->last)
                                                ,
                                            @endif
                                        @endforeach
                                    </span>
                                    <div class="action-buttons">
                                        <button class="btn-participate" onclick="showRegisterPopup()">THAM GIA</button>


                                        <a href="{{ route('study-abroad.show', $study->slug) }}" class="btn-detail">XEM CHI
                                            TIẾT</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
            <div class="pagination-container mt-4">
                {{ $savedStudyAbroad->links() }}
            </div>
        @else
            <div class="empty-state">
                <i class="far fa-heart fa-4x"></i>
                <h3>Bạn chưa lưu du học nghề nào</h3>

            </div>
        @endif
    </div>
@endsection
