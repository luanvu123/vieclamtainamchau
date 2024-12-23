@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="mt-4">Danh sách việc làm</h1>
            <h5 class="text-muted">Nhà tuyển dụng: {{ $employer->company_name }}</h5>
        </div>
        <div>
            <a href="{{ route('manage.employers.show', $employer->id) }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Quay lại
            </a>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Danh sách tin tuyển dụng
        </div>
        <div class="card-body">
            @if($jobPostings->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Tiêu đề</th>
                                <th>Thông tin</th>
                                <th>Yêu cầu</th>
                                <th>Phân loại</th>
                                <th>Trạng thái</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($jobPostings as $job)
                            <tr>
                                <td>
                                    <div class="fw-bold">{{ $job->title }}</div>
                                    <small class="text-muted">
                                        <i class="fas fa-clock"></i>
                                        Đăng ngày: {{ \Carbon\Carbon::parse($job->created_at)->format('d/m/Y') }}
                                    </small>
                                    @if($job->isHot)
                                        <span class="badge bg-danger ms-2">Hot</span>
                                    @endif
                                </td>
                                <td>
                                    <div><i class="fas fa-money-bill"></i> {{ $job->salary }}</div>
                                    <div><i class="fas fa-map-marker-alt"></i> {{ $job->city }}</div>
                                    <div><i class="fas fa-users"></i> SL: {{ $job->number_of_recruits }}</div>
                                    <div><i class="fas fa-calendar-alt"></i> Hạn: {{ \Carbon\Carbon::parse($job->closing_date)->format('d/m/Y') }}</div>
                                </td>
                                <td>
                                    <div><i class="fas fa-briefcase"></i> {{ $job->experience }}</div>
                                    <div><i class="fas fa-venus-mars"></i> {{ $job->sex }}</div>
                                    <div><i class="fas fa-user-graduate"></i> {{ $job->rank }}</div>
                                    <div class="mt-1">
                                        @foreach(explode(',', $job->skills_required) as $skill)
                                            <span class="badge bg-info">{{ trim($skill) }}</span>
                                        @endforeach
                                    </div>
                                </td>
                                <td>
                                    <div class="mb-1">
                                        @foreach($job->categories as $category)
                                            <span class="badge bg-primary">{{ $category->name }}</span>
                                        @endforeach
                                    </div>
                                    <div>
                                        @foreach($job->genres as $genre)
                                            <span class="badge bg-secondary">{{ $genre->name }}</span>
                                        @endforeach
                                    </div>
                                </td>
                                <td>
                                    <span class="badge {{ $job->status ? 'bg-success' : 'bg-danger' }}">
                                        {{ $job->status ? 'Đang hiển thị' : 'Đã ẩn' }}
                                    </span>
                                    <div class="mt-2">
                                        <small><i class="far fa-eye"></i> {{ $job->views }} lượt xem</small>
                                    </div>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="#" class="btn btn-primary btn-sm" title="Xem chi tiết">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="#" class="btn btn-warning btn-sm" title="Chỉnh sửa">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button" class="btn btn-danger btn-sm"
                                                data-bs-toggle="modal"
                                                data-bs-target="#deleteJobModal{{ $job->id }}"
                                                title="Xóa">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>

                                    <!-- Delete Modal -->
                                    <div class="modal fade" id="deleteJobModal{{ $job->id }}" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Xác nhận xóa</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Bạn có chắc chắn muốn xóa tin tuyển dụng "{{ $job->title }}" không?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                                                    <form action="#" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Xác nhận xóa</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-4">
                    {{ $jobPostings->links() }}
                </div>
            @else
                <div class="text-center py-4">
                    <i class="fas fa-folder-open fa-3x text-muted mb-3"></i>
                    <p class="text-muted">Chưa có tin tuyển dụng nào</p>
                </div>
            @endif
        </div>
    </div>
</div>

@push('styles')
<style>
    .badge {
        font-weight: 500;
    }

    .table > :not(caption) > * > * {
        vertical-align: middle;
    }

    .btn-group {
        gap: 0.25rem;
    }
</style>
@endpush
@endsection
