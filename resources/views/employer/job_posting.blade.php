@extends('layout')
@section('content')
    <div class="container">
        <div class="sidebar">
            <div class="menu-section">
                <div class="menu-title">Quản lý đăng tuyển dụng</div>
                <a href="{{ route('employer.job-posting.create.form') }}" class="menu-item">
                    <i>+</i>
                    <span>Tạo tin tuyển dụng</span>
                </a>
                <a href="#" class="menu-item">
                    <i>📋</i>
                    <span>Quản lý tin đăng</span>
                </a>
                <a href="#" class="menu-item">
                    <i>📊</i>
                    <span>Chiến dịch tuyển dụng</span>
                </a>
            </div>

            <div class="menu-section">
                <div class="menu-title">Quản lý ứng viên</div>
                <a href="#" class="menu-item">
                    <i>👥</i>
                    <span>Hồ sơ ứng tuyển</span>
                </a>
                <a href="#" class="menu-item">
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
                    <tr>
                        <td>Thực Tập Lập Trình PHP</td>
                        <td>16/02/2022 - 20/10/2024</td>
                        <td>3223</td>
                        <td>200 CV ứng tuyển</td>
                        <td><button class="export-btn">Xuất bản</button></td>
                    </tr>
                    <!-- Additional rows would be dynamically added here -->
                </tbody>
            </table>

            <div class="pagination">
                <button class="page-btn">←</button>
                <button class="page-btn active">1</button>
                <button class="page-btn">2</button>
                <button class="page-btn">3</button>
                <button class="page-btn">→</button>
            </div>
        </div>
    </div>

    <script>
        // Add responsive menu toggle
        document.addEventListener('DOMContentLoaded', () => {
            // Sample data for demonstration
            const jobs = [
                {
                    title: 'Thực Tập Lập Trình PHP',
                    duration: '16/02/2022 - 20/10/2024',
                    views: 3223,
                    applications: '200 CV ứng tuyển'
                }
            ];

            // Populate table with sample data
            const tbody = document.querySelector('.job-table tbody');
            jobs.forEach(job => {
                const row = `
                    <tr>
                        <td>${job.title}</td>
                        <td>${job.duration}</td>
                        <td>${job.views}</td>
                        <td>${job.applications}</td>
                        <td><button class="export-btn">Xuất bản</button></td>
                    </tr>
                `;
                tbody.innerHTML += row;
            });

            // Add click handlers for pagination
            document.querySelectorAll('.page-btn').forEach(btn => {
                btn.addEventListener('click', () => {
                    document.querySelectorAll('.page-btn').forEach(b => b.classList.remove('active'));
                    btn.classList.add('active');
                });
            });
        });
    </script>
@endsection

