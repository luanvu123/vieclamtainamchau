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
                <a href="{{ route('employer.saved-applications') }}" class="menu-item">
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
            <div class="applications-container">
                <h2>Danh sách ứng viên - {{ $jobPosting->title }}</h2>

                <div class="applications-table-container">
                    <table class="applications-table" id="user-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tên ứng viên</th>
                                <th>Email</th>
                                <th>Ngày nộp</th>
                                <th>CV</th>
                                <th>Giới thiệu</th>
                                <th>Trạng thái</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($applications as $application)
                                <tr data-application-id="{{ $application->id }}">
                                    <td>{{ $application->id }}</td>
                                    <td>{{ $application->candidate->name }}</td>
                                    <td>{{ $application->candidate->email }}</td>
                                    <td>{{ $application->created_at->format('d/m/Y H:i') }}</td>
                                    <td>
                                        <a href="{{ asset('storage/' . $application->cv_path) }}" target="_blank"
                                            class="view-cv-btn">
                                            Xem CV
                                        </a>
                                    </td>
                                    <td>
                                        @if ($application->introduction)
                                            <button onclick="showIntroduction('{{ $application->id }}')"
                                                class="view-intro-btn">
                                                Xem giới thiệu
                                            </button>
                                        @else
                                            <span class="no-intro">Không có</span>
                                        @endif
                                    </td>
                                    <td class="status-cell">
                                        <span class="status-badge status-{{ $application->status }}">
                                            {{ ucfirst($application->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <select class="status-select"
                                            onchange="updateStatus('{{ $application->id }}', this.value)">
                                            <option value="pending"
                                                {{ $application->status == 'pending' ? 'selected' : '' }}>
                                                Đang chờ
                                            </option>
                                            <option value="reviewed"
                                                {{ $application->status == 'reviewed' ? 'selected' : '' }}>
                                                Đã xem
                                            </option>
                                            <option value="accepted"
                                                {{ $application->status == 'accepted' ? 'selected' : '' }}>
                                                Chấp nhận
                                            </option>
                                            <option value="rejected"
                                                {{ $application->status == 'rejected' ? 'selected' : '' }}>
                                                Từ chối
                                            </option>
                                        </select>
                                        <button onclick="toggleSave('{{ $application->id }}')"
                                            class="save-btn {{ $application->saved ? 'saved' : '' }}"
                                            data-application-id="{{ $application->id }}">
                                            {{ $application->saved ? 'Đã lưu' : 'Lưu' }}
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="no-applications">
                                        Chưa có ứng viên nào ứng tuyển.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Introduction Modal -->
    <div id="introductionModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h3>Giới thiệu của ứng viên</h3>
            <div id="introductionText"></div>
        </div>
    </div>


    <style>
        .save-btn {
            padding: 6px 12px;
            border-radius: 4px;
            background-color: #fff;
            border: 1px solid #007bff;
            color: #007bff;
            cursor: pointer;
            margin-left: 8px;
            transition: all 0.3s ease;
        }

        .save-btn.saved {
            background-color: #007bff;
            color: #fff;
        }

        .save-btn:hover {
            background-color: #0056b3;
            border-color: #0056b3;
            color: #fff;
        }

        .applications-container {
            padding: 20px;
        }

        .applications-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .applications-table th,
        .applications-table td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }

        .applications-table th {
            background-color: #f5f5f5;
        }

        .view-cv-btn,
        .view-intro-btn {
            padding: 6px 12px;
            border-radius: 4px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border: none;
            cursor: pointer;
        }

        .status-badge {
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 0.9em;
        }

        .status-pending {
            background-color: #ffd700;
        }

        .status-reviewed {
            background-color: #87ceeb;
        }

        .status-accepted {
            background-color: #90ee90;
        }

        .status-rejected {
            background-color: #ffcccb;
        }

        .status-select {
            padding: 6px;
            border-radius: 4px;
            border: 1px solid #ddd;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 600px;
            border-radius: 8px;
        }

        .close {
            float: right;
            cursor: pointer;
            font-size: 28px;
        }
    </style>

    <script>
        function showIntroduction(applicationId) {
            const application = @json($applications);
            const intro = application.find(a => a.id == applicationId).introduction;
            document.getElementById('introductionText').innerText = intro;
            document.getElementById('introductionModal').style.display = 'block';
        }

        // Close modal
        document.querySelector('.close').onclick = function() {
            document.getElementById('introductionModal').style.display = 'none';
        }

        window.onclick = function(event) {
            if (event.target == document.getElementById('introductionModal')) {
                document.getElementById('introductionModal').style.display = 'none';
            }
        }

        function updateStatus(applicationId, newStatus) {
            fetch(`{{ url('employer/applications') }}/${applicationId}/status`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        status: newStatus
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Update status badge
                        const statusCell = document.querySelector(
                            `tr[data-application-id="${applicationId}"] .status-cell`);
                        statusCell.innerHTML = `
                <span class="status-badge status-${newStatus}">
                    ${newStatus.charAt(0).toUpperCase() + newStatus.slice(1)}
                </span>
            `;
                    } else {
                        alert('Có lỗi xảy ra khi cập nhật trạng thái');
                    }
                })
                .catch(error => {
                    alert('Có lỗi xảy ra, vui lòng thử lại');
                });
        }
    </script>
    <script>
        function toggleSave(applicationId) {
            fetch(`{{ url('employer/applications') }}/${applicationId}/toggle-save`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const btn = document.querySelector(`button[data-application-id="${applicationId}"]`);
                        if (data.saved) {
                            btn.classList.add('saved');
                            btn.innerText = 'Đã lưu';
                        } else {
                            btn.classList.remove('saved');
                            btn.innerText = 'Lưu hồ sơ';
                        }
                    } else {
                        alert('Có lỗi xảy ra khi lưu hồ sơ');
                    }
                })
                .catch(error => {
                    alert('Có lỗi xảy ra, vui lòng thử lại');
                });
        }
    </script>
@endsection
