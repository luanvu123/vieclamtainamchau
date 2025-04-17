@extends('layouts.manage')
@section('content')

    <div class="main-content">
        <h1>Danh sách xuất khẩu lao động</h1>

        <form method="GET" action="{{ route('employer.job-posting.export') }}" class="mb-3">
            <label for="status">Lọc theo trạng thái:</label>
            <select name="status" id="status" onchange="this.form.submit()">
                <option value="">-- Tất cả --</option>
                <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Hoạt động</option>
                <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Không hoạt động</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Chờ duyệt</option>
                <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Bị từ chối</option>
            </select>
        </form>

        @php
            $statusLabels = [
                'active' => 'Hoạt động',
                'inactive' => 'Không hoạt động',
                'pending' => 'Chờ duyệt',
                'rejected' => 'Bị từ chối',
            ];
        @endphp

        @if ($jobPostings->isNotEmpty())
            <table class="job-table" id="user-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tên tin đăng</th>
                        <th>Thời hạn</th>
                        <th>Lượt xem</th>
                        <th>Lượt ứng tuyển</th>
                        <th>Trạng thái</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($jobPostings as $key => $job)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $job->title }}</td>
                            <td>{{ $job->closing_date }}</td>
                            <td>{{ $job->views }}</td>
                            <td>
                                <a href="{{ route('employer.job-posting.applications', $job->id) }}" class="application-btn">
                                    CV ứng tuyển ({{ $job->applications->count() }})
                                </a>
                            </td>
                            <td>{{ $statusLabels[$job->status] ?? 'Không xác định' }}</td>
                            <td>
                                <a href="{{ route('employer.job-posting.edit', $job->id) }}" class="action-btn">Chỉnh sửa</a>
                                <form action="{{ route('employer.job-posting.destroy', $job->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="action-btn delete-btn">Xóa</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p style="text-align: center; font-size: 16px; color: gray;">Không có tin đăng nào.</p>
        @endif
    </div>

@endsection
