@extends('layout')

@section('title', 'Chỉnh sửa hồ sơ')

@section('content')
    <style>
        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        /* Container styling */
        /* Applications Container Styles */
        .applications-container {
            padding: 1.5rem;
            background-color: #f8f9fa;
            border-radius: 8px;
        }

        /* Card Styles */
        .applications-container .card {
            border: none;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .applications-container .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .applications-container .card-body {
            padding: 1.5rem;
        }

        .applications-container .card-title {
            color: #2d3436;
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        /* Company Info Styles */
        .applications-container .company-info {
            color: #636e72;
            font-size: 1rem;
        }

        /* Job Details Styles */
        .applications-container .job-details {
            padding: 1rem 0;
            border-top: 1px solid #edf2f7;
            border-bottom: 1px solid #edf2f7;
            margin: 1rem 0;
        }

        .applications-container .job-details i {
            color: #0984e3;
            margin-right: 0.5rem;
            width: 16px;
        }

        .applications-container .job-details p {
            margin-bottom: 0.5rem;
            color: #636e72;
            font-size: 0.95rem;
        }

        /* Application Info Styles */
        .applications-container .application-info {
            font-size: 0.95rem;
        }

        .applications-container .application-info p {
            margin-bottom: 0.75rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        /* Badge Styles */
        .applications-container .badge {
            padding: 0.5em 1em;
            font-weight: 500;
            font-size: 0.85rem;
            border-radius: 4px;
        }

        .applications-container .bg-warning {
            background-color: #ffd43b !important;
            color: #664d03;
        }

        .applications-container .bg-success {
            background-color: #40c057 !important;
            color: #ffffff;
        }

        .applications-container .bg-danger {
            background-color: #fa5252 !important;
            color: #ffffff;
        }

        /* Button Styles */
        .applications-container .view-cv-btn {
            display: inline-block;
            padding: 0.5rem 1rem;
            background-color: #4dabf7;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            margin-right: 1rem;
            transition: background-color 0.2s ease;
        }

        .applications-container .view-cv-btn:hover {
            background-color: #339af0;
            text-decoration: none;
            color: white;
        }

        .applications-container .btn-view-job {
            display: inline-block;
            padding: 0.5rem 1rem;
            background-color: #e9ecef;
            color: #495057;
            text-decoration: none;
            border-radius: 4px;
            transition: all 0.2s ease;
        }

        .applications-container .btn-view-job:hover {
            background-color: #dee2e6;
            color: #212529;
            text-decoration: none;
        }

        .applications-container .btn-view-job i {
            margin-right: 0.5rem;
        }

        /* Pagination Styles */
        .applications-container .pagination {
            margin-top: 2rem;
        }

        .applications-container .page-link {
            color: #0984e3;
            padding: 0.5rem 1rem;
            margin: 0 0.25rem;
            border-radius: 4px;
        }

        .applications-container .page-item.active .page-link {
            background-color: #0984e3;
            border-color: #0984e3;
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            .applications-container {
                padding: 1rem;
            }

            .applications-container .card-body {
                padding: 1rem;
            }

            .applications-container .job-details .row>div {
                margin-bottom: 0.5rem;
            }

            .applications-container .application-info {
                flex-direction: column;
            }

            .applications-container .view-cv-btn,
            .applications-container .btn-view-job {
                display: block;
                text-align: center;
                margin-bottom: 0.5rem;
            }
        }

        /* Alert Styles */
        .applications-container .alert {
            padding: 1rem;
            border-radius: 6px;
            margin-bottom: 0;
        }

        .applications-container .alert-info {
            background-color: #e7f5ff;
            border-color: #74c0fc;
            color: #1864ab;
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
                <a href="{{ route('candidate.applications') }}" class="menu-item">
                    <i>👥</i>
                    <span>Hồ sơ đã nộp</span>
                </a>
            </div>
        </div>
        @if ($applications->count() > 0)
            <div class="applications-container">
                <div class="row">
                    @foreach ($applications as $application)
                        <div class="col-md-12 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $application->jobPosting->title }}</h5>
                                    <div class="company-info mb-3">
                                        <strong>{{ $application->jobPosting->employer->company_name }}</strong>
                                    </div>
                                    <div class="job-details">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <p><i class="fas fa-map-marker-alt"></i>
                                                    {{ $application->jobPosting->location }}</p>
                                            </div>
                                            <div class="col-md-4">
                                                <p><i class="fas fa-dollar-sign"></i> {{ $application->jobPosting->salary }}
                                                </p>
                                            </div>
                                            <div class="col-md-4">
                                                <p><i class="fas fa-briefcase"></i> {{ $application->jobPosting->type }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="application-info mt-3">
                                        <p><strong>Trạng thái:</strong>
                                            <span
                                                class="badge {{ $application->status === 'pending' ? 'bg-warning' : ($application->status === 'accepted' ? 'bg-success' : 'bg-danger') }}">
                                                {{ ucfirst($application->status) }}
                                            </span>
                                        </p>
                                        <p><strong>Ngày ứng tuyển:</strong> {{ $application->created_at->format('d/m/Y') }}
                                        </p>
                                         <p><strong>Ngày cập nhật:</strong> {{ $application->updated_at->format('d/m/Y') }}
                                        </p>
                                        @if ($application->cv_path)
                                            <a href="{{ asset('storage/' . $application->cv_path) }}" target="_blank"
                                                class="view-cv-btn">
                                                Xem CV
                                            </a>
                                        @endif
                                        @if ($application->introduction)
                                            <p><strong>Giới thiệu:</strong> {{ $application->introduction }}</p>
                                        @endif

                                        <!-- Thêm nút xem chi tiết -->
                                        <a href="{{ route('job.show', $application->jobPosting->slug) }}"
                                            class="btn-view-job">
                                            <i class="fas fa-eye"></i> Xem chi tiết công việc
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="d-flex justify-content-center">
                    {{ $applications->links() }}
                </div>
            </div>
        @else
            <div class="alert alert-info">
                Bạn chưa ứng tuyển vào vị trí nào.
            </div>
        @endif
    </div>
@endsection
