@extends('layout')

@section('title', 'Chỉnh sửa hồ sơ')

@section('content')
    <style>
        /* Container styling */
        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .menu-title {
            font-size: 16px;
            font-weight: 600;
            color: #333;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }

        .menu-section {
            margin-bottom: 25px;
        }

        .menu-item {
            display: flex;
            align-items: center;
            padding: 12px 15px;
            color: #555;
            text-decoration: none;
            border-radius: 8px;
            margin-bottom: 5px;
            transition: all 0.3s ease;
        }

        .menu-item:hover {
            background: #f5f5f5;
            color: #2563eb;
        }

        .menu-item i {
            margin-right: 12px;
            font-size: 18px;
        }

        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-3px);
        }

        .card-title {
            color: #1a1a1a;
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 15px;
        }

        .company-info {
            color: #666;
            font-size: 15px;
        }

        .job-details {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            margin: 15px 0;
        }

        .job-details i {
            color: #2563eb;
            margin-right: 8px;
        }

        .application-info {
            border-top: 1px solid #eee;
            padding-top: 15px;
        }

        .badge {
            padding: 8px 15px;
            font-weight: 500;
            border-radius: 6px;
        }

        .btn-view-job {
            background: #ee0505;
            color: white;
            padding: 8px 20px;
            border-radius: 6px;
            text-decoration: none;
            display: inline-block;
            margin-top: 15px;
            transition: background 0.3s ease;
        }

        .btn-view-job:hover {
            background: #e93306;
            color: white;
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .container {
                padding: 10px;
            }

            .auth-card {
                padding: 20px;
                margin: 20px auto;
            }

            .auth-header h2 {
                font-size: 20px;
            }

            .header-icon {
                font-size: 28px;
            }

            .form-group {
                margin-bottom: 15px;
            }

            .btn {
                width: 100%;
                padding: 10px 20px;
            }
        }

        .card {
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .card-title {
            color: #2c3e50;
            font-weight: bold;
        }

        .company-info {
            color: #7f8c8d;
        }

        .badge {
            padding: 8px 12px;
            border-radius: 4px;
        }

        .job-details i {
            margin-right: 8px;
            color: #3498db;
        }

        @media (max-width: 480px) {
            .auth-card {
                padding: 15px;
                margin: 10px auto;
            }

            .header-icon {
                font-size: 24px;
            }

            .form-control {
                font-size: 14px;
                padding: 8px 10px;
            }

            .btn {
                font-size: 14px;
            }

            .form-group label i {
                width: 16px;
                font-size: 14px;
            }
        }
    </style>
    <div class="container">
        <div class="sidebar">
            <div class="menu-title">Quản lý CV</div>
            <div class="menu-section">

                <a href="{{ route('candidate.cv.white')}}" class="menu-item">
                     <i>📄</i>
                     <span>Mẫu CV cổ điển</span>
                 </a>
                  <a href="{{ route('candidate.cv.black')}}" class="menu-item">
                     <i>📄</i>
                     <span>Mẫu CV hiện đại</span>
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
