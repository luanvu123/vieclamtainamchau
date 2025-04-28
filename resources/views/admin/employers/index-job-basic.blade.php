@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Danh sách Tin Tuyển dụng Cơ bản</h1>

        @if($jobPostings->isEmpty())
            <p>Hiện tại không có tin tuyển dụng cơ bản nào.</p>
        @else
            <table class="table" id="user-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tiêu đề</th>
                        <th>Nhà tuyển dụng</th>
                        <th>Ngày tạo</th>
                        <th>Trạng thái</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($jobPostings as $jobPosting)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $jobPosting->title }}
                                @if ($jobPosting->created_at >= \Carbon\Carbon::now()->subHours(2))
                                    <span class="badge badge-danger">New</span>
                                @endif
                            </td>
                            <td>{{ $jobPosting->employer->email }}</td>
                            <td>{{ $jobPosting->created_at->format('M d, Y') }}</td>
                            <td>
                                @if($jobPosting->status == 'active')
                                    <span class="badge badge-success">Active</span>
                                @elseif($jobPosting->status == 'inactive')
                                    <span class="badge badge-secondary">Inactive</span>
                                @elseif($jobPosting->status == 'pending')
                                    <span class="badge badge-warning">Pending</span>
                                @else
                                    <span class="badge badge-danger">Rejected</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('employer.admin.job-postings.edit', ['employerId' => $jobPosting->employer->id, 'jobPostingId' => $jobPosting->id]) }}" class="btn btn-primary btn-sm">Sửa</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
