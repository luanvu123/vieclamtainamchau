@extends('layout')
@section('content')
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        .container {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 250px;
            background: #fff;
            padding: 20px;
            border-right: 1px solid #eee;
        }

        .main-content {
            flex: 1;
            padding: 20px;
            background: #f8f9fa;
        }

        .menu-item {
            display: flex;
            align-items: center;
            padding: 10px;
            margin: 5px 0;
            cursor: pointer;
            color: #333;
            text-decoration: none;
        }

        .menu-item i {
            margin-right: 10px;
            color: #ff0000;
        }

        .menu-section {
            margin: 15px 0;
        }

        .menu-title {
            font-weight: bold;
            margin: 10px 0;
            color: #333;
        }

        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .post-button {
            background: #ff0000;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
        }

        .filters {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }

        .filter-select {
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            min-width: 150px;
        }

        .job-table {
            width: 100%;
            border-collapse: collapse;
        }

        .job-table th {
            text-align: left;
            padding: 12px;
            background: #f8f9fa;
            border-bottom: 2px solid #dee2e6;
        }

        .job-table td {
            padding: 12px;
            border-bottom: 1px solid #dee2e6;
        }

        .export-btn {
            color: #ff0000;
            border: 1px solid #ff0000;
            background: white;
            padding: 5px 15px;
            border-radius: 4px;
            cursor: pointer;
        }

        .pagination {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 20px;
        }

        .page-btn {
            padding: 5px 10px;
            border: 1px solid #dee2e6;
            border-radius: 4px;
            cursor: pointer;
        }

        .page-btn.active {
            background: #ff0000;
            color: white;
            border-color: #ff0000;
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
                border-right: none;
                border-bottom: 1px solid #eee;
            }

            .filters {
                flex-wrap: wrap;
            }

            .job-table {
                display: block;
                overflow-x: auto;
            }
        }
    </style>

    <div class="container">
        <div class="sidebar">
            <div class="menu-section">
                <div class="menu-title">Quản lý đăng tuyển dụng</div>
                <a href="#" class="menu-item">
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

