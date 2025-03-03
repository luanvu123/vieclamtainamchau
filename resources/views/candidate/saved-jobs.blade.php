<!-- Trong file resources/views/candidate/saved-jobs.blade.php -->
@extends('candidate.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Tin tuyển dụng đã lưu</div>

                <div class="card-body">
                    @if($savedJobs->count() > 0)
                        <div class="job-listings">
                            @foreach($savedJobs as $job)
                                <div class="job-item">
                                    <div class="job-details">
                                        <h3><a href="{{ route('job.detail', $job->slug) }}">{{ $job->title }}</a></h3>
                                        <div class="company">{{ $job->employer->company_name }}</div>
                                        <div class="location">{{ $job->location }}</div>
                                        <div class="salary">{{ $job->salary }}</div>
                                        <div class="posted-date">Ngày đăng: {{ $job->created_at->format('d/m/Y') }}</div>
                                    </div>
                                    <div class="job-actions">
                                        <button class="apply-btn" onclick="window.location.href='{{ route('job.detail', $job->slug) }}'">Xem chi tiết</button>
                                        <button class="save-job-btn saved" id="saveJobBtn_{{ $job->id }}" onclick="saveJob({{ $job->id }})">
                                            <i class="fas fa-heart"></i> Đã yêu thích
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="pagination-container mt-4">
                            {{ $savedJobs->links() }}
                        </div>
                    @else
                        <div class="empty-state">
                            <i class="far fa-heart fa-4x"></i>
                            <h3>Bạn chưa lưu tin tuyển dụng nào</h3>
                            <p>Hãy duyệt qua các tin tuyển dụng và lưu lại những tin bạn quan tâm.</p>
                            <a href="{{ route('jobs') }}" class="btn btn-primary">Tìm việc ngay</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function saveJob(jobId) {
        axios.post('/save-job/' + jobId)
            .then(function (response) {
                if (response.data.saved) {
                    document.getElementById('saveJobBtn_' + jobId).innerHTML = '<i class="fas fa-heart"></i> Đã yêu thích';
                    document.getElementById('saveJobBtn_' + jobId).classList.add('saved');
                } else {
                    // Nếu đang ở trang danh sách đã lưu, có thể ẩn item đã bỏ lưu
                    if (window.location.pathname === '/saved-jobs') {
                        document.getElementById('saveJobBtn_' + jobId).closest('.job-item').remove();

                        // Nếu không còn tin tuyển dụng nào, hiển thị trạng thái trống
                        if (document.querySelectorAll('.job-item').length === 0) {
                            document.querySelector('.job-listings').innerHTML = `
                                <div class="empty-state">
                                    <i class="far fa-heart fa-4x"></i>
                                    <h3>Bạn chưa lưu tin tuyển dụng nào</h3>
                                    <p>Hãy duyệt qua các tin tuyển dụng và lưu lại những tin bạn quan tâm.</p>
                                    <a href="{{ route('jobs') }}" class="btn btn-primary">Tìm việc ngay</a>
                                </div>
                            `;
                        }
                    } else {
                        document.getElementById('saveJobBtn_' + jobId).innerHTML = '<i class="far fa-heart"></i> Thêm yêu thích';
                        document.getElementById('saveJobBtn_' + jobId).classList.remove('saved');
                    }
                }
            })
            .catch(function (error) {
                console.error(error);
            });
    }
</script>

<style>
    .job-item {
        border: 1px solid #eee;
        padding: 15px;
        margin-bottom: 15px;
        border-radius: 5px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .job-details h3 {
        margin-bottom: 5px;
    }

    .job-details h3 a {
        color: #333;
        text-decoration: none;
    }

    .job-details .company {
        font-weight: bold;
        color: #666;
    }

    .job-details .location, .job-details .salary, .job-details .posted-date {
        font-size: 0.9em;
        color: #777;
        margin-top: 3px;
    }

    .job-actions {
        display: flex;
        gap: 10px;
    }

    .empty-state {
        text-align: center;
        padding: 30px;
        color: #666;
    }

    .empty-state i {
        margin-bottom: 15px;
        color: #ddd;
    }

    .empty-state h3 {
        margin-bottom: 10px;
    }

    .empty-state p {
        margin-bottom: 20px;
    }
</style>
@endsection
