@extends('layout')
@section('content')
    <div class="container">
        <div class="sidebar">
            <div class="menu-section">
                <div class="menu-title">Quản lý đăng tuyển dụng</div>
                <a href="{{ route('employer.job-posting.create') }}" class="menu-item">
                    <i>+</i>
                    <span>Tạo tin tuyển dụng</span>
                </a>
                <a href="{{ route('employer.job-posting.index') }}" class="menu-item">
                    <i>📋</i>
                    <span>Quản lý tin đăng</span>
                </a>
                <a href="{{ route('employer.services') }}" class="menu-item">
                    <i>📊</i>
                    <span>Mua dịch vụ</span>
                </a>
            </div>

            <div class="menu-section">
                <div class="menu-title">Quản lý ứng viên</div>
                <a href="#" class="menu-item">
                    <i>👥</i>
                    <span>Hồ sơ ứng tuyển</span>
                </a>
                <a href="{{ route('employer.job-posting.find-candidate') }}" class="menu-item">
                    <i>🔍</i>
                    <span>Tìm ứng viên mới</span>
                </a>
            </div>
        </div>

        <div class="main-content">
            <div class="top-bar">
                <h2>Quản lý tin đăng</h2>
                <button class="post-button">+ Đăng tin ngay</button>
            </div>

            <div class="filters">
                <select class="filter-select">
                    <option>Tất cả tin đăng</option>
                </select>
                <select class="filter-select">
                    <option>Tất cả trạng thái</option>
                </select>
                <select class="filter-select">
                    <option>Tất cả loại tin</option>
                </select>
                <select class="filter-select">
                    <option>Tất cả nguồn tin</option>
                </select>
            </div>

            <table class="job-table">
                <thead>
                    <tr>
                        <th>Tên tin đăng</th>
                        <th>Thời hạn</th>
                        <th>Lượt xem</th>
                        <th>Lượt ứng tuyển</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($jobPostings as $job)
                        <tr>
                            <td>{{ $job->title }}</td>
                            <td>{{ $job->closing_date }}</td>
                            <td>{{ $job->views }}</td>
                            <td>
                                <a href="{{ route('employer.job-posting.applications', $job->id) }}"
                                    class="application-btn">
                                    CV ứng tuyển ({{ $job->applications->count() }})
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('employer.job-posting.edit', $job->id) }}" class="action-btn">Chỉnh
                                    sửa</a>
                                <form action="{{ route('employer.job-posting.destroy', $job->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="action-btn delete-btn">Xóa</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align: center;">Không có tin đăng nào.</td>
                        </tr>
                    @endforelse
                </tbody>

            </table>


        </div>
    </div>
@endsection
