@extends('layouts.app')

@section('title', 'Xuất Khẩu Lao Động')

@section('content_header')
    <h1>Danh sách Bài đăng Xuất khẩu Lao động</h1>
@stop

@section('content')
  <h1>Danh sách Bài đăng Xuất khẩu Lao động</h1>
    @if($jobPostings->isEmpty())
        <div class="alert alert-info">Hiện tại không có bài đăng xuất khẩu lao động nào.</div>
    @else
        <table class="table table-bordered table-hover" id="user-table">
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
                        <td>
                            {{ $jobPosting->title }}
                            @if($jobPosting->created_at >= \Carbon\Carbon::now()->subHours(2))
                                <span class="badge badge-danger">Mới</span>
                            @endif
                        </td>
                        <td>{{ $jobPosting->employer->email ?? 'N/A' }}</td>
                        <td>{{ $jobPosting->created_at->format('d/m/Y H:i') }}</td>
                        <td>
                            @switch($jobPosting->status)
                                @case('active') <span class="badge badge-success">Hoạt động</span> @break
                                @case('inactive') <span class="badge badge-secondary">Tạm ngưng</span> @break
                                @case('pending') <span class="badge badge-warning">Chờ duyệt</span> @break
                                @default <span class="badge badge-danger">Từ chối</span>
                            @endswitch
                        </td>
                      <td>
    <a href="{{ route('labor-exports.edit', $jobPosting->id) }}" class="btn btn-sm btn-primary">Sửa</a>
</td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@stop
