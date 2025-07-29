@extends('layouts.layout_candidate_profile')

@section('title', 'Chỉnh sửa hồ sơ')

@section('content')


        @if ($applications->count() > 0)
            <div class="main-content">
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
                                                <p><i class="fas fa-dollar-sign"></i>
                                                    {{ $application->jobPosting->salary }}
                                                </p>
                                            </div>
                                            <div class="col-md-4">
                                                <p><i class="fas fa-briefcase"></i> {{ $application->jobPosting->type }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="application-info mt-3">
                                       <p><strong>Trạng thái:</strong>
    <span class="badge {{
        $application->status === 'pending' ? 'bg-warning text-dark' :
        ($application->status === 'reviewed' ? 'bg-info text-white' :
        ($application->status === 'accepted' ? 'bg-success text-white' : 'bg-danger text-white'))
    }}">
        @switch($application->status)
            @case('pending')
                🕐 Đang chờ duyệt
                @break
            @case('reviewed')
                👀 Đã xem
                @break
            @case('accepted')
                ✅ Đã chấp nhận
                @break
            @case('rejected')
                ❌ Đã từ chối
                @break
            @default
                {{ ucfirst($application->status) }}
        @endswitch
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
                                        <a href="{{ route('candidate.job.show', $application->jobPosting->slug) }}"
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

@endsection
