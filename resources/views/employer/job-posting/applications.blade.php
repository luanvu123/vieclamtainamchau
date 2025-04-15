@extends('layouts.manage')

@section('content')


        <div class="main-content">

            <div class="applications-container">
                <h2>Danh sách ứng viên - {{ $jobPosting->title }}</h2>

                <div class="applications-table-container">
                    @if ($applications->count())
                        <table class="applications-table" id="user-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tên ứng viên</th>

                                    <th>Thông tin</th>
                                    <th>Ngày nộp</th>
                                    <th>CV</th>
                                    <th>Giới thiệu</th>
                                    <th>Trạng thái</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($applications as $key => $application)
                                    <tr data-application-id="{{ $application->id }}">
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $application->candidate->name }}</td>

                                        <td>
                                            <button class="info-btn"
                                                onclick="showCandidateInfo('{{ $application->candidate->id }}')">Chi
                                                tiết</button>
                                            <div id="candidateInfo{{ $application->candidate->id }}" class="candidate-info-popup">
                                                <div class="info-content">
                                                    <span class="close-info">&times;</span>
                                                    <h3>Thông tin ứng viên</h3>
                                                    <div class="info-grid">
                                                        <div class="info-item">
                                                            <strong>Số điện thoại:</strong>
                                                            {{ $application->candidate->phone ?? 'Không có' }}
                                                        </div>
                                                        <div class="info-item">
                                                            <strong>Ngày sinh:</strong>
                                                            {{ $application->candidate->dob ? date('d/m/Y', strtotime($application->candidate->dob)) : 'Không có' }}
                                                        </div>
                                                        <div class="info-item">
                                                            <strong>Giới tính:</strong>
                                                            {{ $application->candidate->gender ?? 'Không có' }}
                                                        </div>
                                                        <div class="info-item">
                                                            <strong>Địa chỉ:</strong>
                                                            {{ $application->candidate->address ?? 'Không có' }}
                                                        </div>
                                                        <div class="info-item">
                                                            <strong>Kỹ năng:</strong>
                                                            {{ $application->candidate->skill ?? 'Không có' }}
                                                        </div>
                                                        <div class="info-item">
                                                            <strong>Vị trí:</strong>
                                                            {{ $application->candidate->position ?? 'Không có' }}
                                                        </div>
                                                        <div class="info-item">
                                                            <strong>Level hiện tại:</strong>
                                                            {{ $application->candidate->level ?? 'Không có' }}
                                                        </div>
                                                        <div class="info-item">
                                                            <strong>Level mong muốn:</strong>
                                                            {{ $application->candidate->desired_level ?? 'Không có' }}
                                                        </div>
                                                        <div class="info-item">
                                                            <strong>Lương mong muốn:</strong>
                                                            {{ $application->candidate->desired_salary ?? 'Không có' }}
                                                        </div>
                                                        <div class="info-item">
                                                            <strong>Trình độ học vấn:</strong>
                                                            {{ $application->candidate->education_level ?? 'Không có' }}
                                                        </div>
                                                        <div class="info-item">
                                                            <strong>Kinh nghiệm:</strong>
                                                            {{ $application->candidate->years_of_experience ?? 'Không có' }}
                                                            năm
                                                        </div>
                                                        <div class="info-item">
                                                            <strong>Hình thức làm việc:</strong>
                                                            {{ $application->candidate->working_form ?? 'Không có' }}
                                                        </div>
                                                        @if ($application->candidate->linkedin)
                                                            <div class="info-item">
                                                                <strong>LinkedIn:</strong> <a
                                                                    href="{{ $application->candidate->linkedin }}" target="_blank">Xem
                                                                    profile</a>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $application->created_at->format('d/m/Y H:i') }}</td>
                                        <td>
                                            <a href="{{ asset('storage/' . $application->cv_path) }}" target="_blank"
                                                class="view-cv-btn">
                                                CV
                                            </a>
                                        </td>
                                        <td>
                                            @if ($application->introduction)
                                                <button onclick="showIntroduction('{{ $application->id }}')" class="view-intro-btn">
                                                    Xem
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
                                                <option value="pending" {{ $application->status == 'pending' ? 'selected' : '' }}>Đang
                                                    chờ
                                                </option>
                                                <option value="reviewed" {{ $application->status == 'reviewed' ? 'selected' : '' }}>Đã
                                                    xem
                                                </option>
                                                <option value="accepted" {{ $application->status == 'accepted' ? 'selected' : '' }}>
                                                    Chấp nhận
                                                </option>
                                                <option value="rejected" {{ $application->status == 'rejected' ? 'selected' : '' }}>Từ
                                                    chối
                                                </option>
                                            </select>
                                            <button onclick="toggleSave('{{ $application->id }}')"
                                                class="save-btn {{ $application->saved ? 'saved' : '' }}"
                                                data-application-id="{{ $application->id }}">
                                                {{ $application->saved ? 'Đã lưu' : 'Lưu' }}
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="no-applications">Chưa có ứng viên nào ứng tuyển.</p>
                    @endif

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

        /* Main table styling */
        .job-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .job-table thead {
            background-color: #f6f9fc;
        }

        .job-table th {
            padding: 15px;
            text-align: left;
            font-weight: 600;
            color: #344767;
            border-bottom: 1px solid #e9ecef;
        }

        .job-table td {
            padding: 12px 15px;
            border-bottom: 1px solid #e9ecef;
            color: #495057;
            vertical-align: middle;
        }

        .job-table tbody tr:hover {
            background-color: #f8f9fa;
        }

        .job-table tbody tr:last-child td {
            border-bottom: none;
        }

        /* Status badges */
        .status-badge {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
            text-align: center;
            min-width: 80px;
        }

        .status-pending {
            background-color: #FFF4DE;
            color: #FF9800;
        }

        .status-reviewed {
            background-color: #E8F5FF;
            color: #2196F3;
        }

        .status-accepted {
            background-color: #E5F9F0;
            color: #4CAF50;
        }

        .status-rejected {
            background-color: #FEEBEF;
            color: #F44336;
        }

        /* Buttons styling */
        .view-cv-btn,
        .view-intro-btn,
        .info-btn {
            padding: 6px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: 500;
            transition: all 0.3s ease;
            font-size: 13px;
        }

        .view-cv-btn {
            background-color: #6c63ff;
            color: white;
            text-decoration: none;
            display: inline-block;
        }

        .view-cv-btn:hover {
            background-color: #5a52d5;
        }

        .view-intro-btn {
            background-color: #4caf50;
            color: white;
        }

        .view-intro-btn:hover {
            background-color: #3e9142;
        }

        .info-btn {
            background-color: #2196F3;
            color: white;
        }

        .info-btn:hover {
            background-color: #0b7dda;
        }

        .no-intro {
            color: #aaa;
            font-style: italic;
        }

        /* Status select and save button */
        .status-select {
            padding: 6px 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-right: 10px;
            color: #495057;
            background-color: #fff;
        }

        .save-btn {
            padding: 6px 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            background-color: #f8f9fa;
            color: #6c757d;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .save-btn.saved {
            background-color: #e5f9f0;
            color: #4CAF50;
            border-color: #4CAF50;
        }

        .save-btn:hover {
            background-color: #e9ecef;
        }

        .save-btn.saved:hover {
            background-color: #d7f2e3;
        }

        /* Modal styling */
        .modal,
        .candidate-info-popup {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content,
        .info-content {
            background-color: #fff;
            margin: 10% auto;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            width: 60%;
            max-width: 700px;
            position: relative;
        }

        .close,
        .close-info {
            position: absolute;
            right: 20px;
            top: 15px;
            color: #aaa;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover,
        .close-info:hover {
            color: #333;
        }

        /* Filter section styling */
        .filter-container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            padding: 20px;
            margin-bottom: 20px;
        }

        .filter-container h3 {
            margin-top: 0;
            margin-bottom: 15px;
            color: #344767;
            font-size: 18px;
        }

        .filter-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 15px;
        }

        .filter-item {
            margin-bottom: 10px;
        }

        .filter-item label {
            display: block;
            margin-bottom: 5px;
            font-weight: 500;
            color: #495057;
            font-size: 14px;
        }

        .filter-select,
        .filter-input {
            width: 100%;
            padding: 8px 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            color: #495057;
            background-color: #fff;
        }

        .filter-buttons {
            display: flex;
            gap: 10px;
            align-items: flex-end;
        }

        .filter-btn {
            padding: 8px 15px;
            border: none;
            border-radius: 4px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            flex: 1;
        }

        .filter-btn.apply {
            background-color: #6c63ff;
            color: white;
        }

        .filter-btn.apply:hover {
            background-color: #5a52d5;
        }

        .filter-btn.reset {
            background-color: #f8f9fa;
            color: #6c757d;
            border: 1px solid #ddd;
        }

        .filter-btn.reset:hover {
            background-color: #e9ecef;
        }

        /* Candidate info popup styling */
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-top: 15px;
        }

        .info-item {
            padding: 10px;
            background-color: #f8f9fa;
            border-radius: 4px;
        }

        .info-item strong {
            color: #344767;
        }

        /* No applications message */
        .no-applications {
            padding: 30px;
            text-align: center;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            color: #6c757d;
            font-size: 16px;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .job-table {
                display: block;
                overflow-x: auto;
            }

            .modal-content,
            .info-content {
                width: 90%;
            }

            .info-grid {
                grid-template-columns: 1fr;
            }

            .filter-grid {
                grid-template-columns: 1fr;
            }
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
        document.querySelector('.close').onclick = function () {
            document.getElementById('introductionModal').style.display = 'none';
        }

        window.onclick = function (event) {
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
    <script>
        document.querySelectorAll('.view-cv-btn').forEach(btn => {
            btn.addEventListener('click', async function (e) {
                // Không chặn hành vi mặc định của thẻ a để vẫn mở CV trong tab mới

                const row = this.closest('tr');
                const statusSelect = row.querySelector('.status-select');
                const statusBadge = row.querySelector('.status-badge');

                // Chỉ cập nhật nếu status là pending
                if (statusSelect.value === 'pending') {
                    try {
                        const applicationId = row.querySelector('.save-btn').dataset.applicationId;

                        const response = await fetch('/employer/applications/update-view', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector(
                                    'meta[name="csrf-token"]').content
                            },
                            body: JSON.stringify({
                                id: applicationId
                            })
                        });

                        const data = await response.json();

                        if (data.success) {
                            // Cập nhật UI
                            statusSelect.value = 'reviewed';
                            statusBadge.className = 'status-badge status-reviewed';
                            statusBadge.textContent = 'Reviewed';
                        } else {
                            console.error(data.message);
                        }
                    } catch (error) {
                        console.error('Lỗi:', error);
                    }
                }
            });
        });
    </script>
    <script>
        // Show candidate detailed information
        function showCandidateInfo(candidateId) {
            const infoPopup = document.getElementById(`candidateInfo${candidateId}`);
            infoPopup.style.display = 'block';
        }

        // Close modals when clicking on X
        document.addEventListener('DOMContentLoaded', function () {
            // Close introduction modal
            const closeIntro = document.querySelector('#introductionModal .close');
            if (closeIntro) {
                closeIntro.addEventListener('click', function () {
                    document.getElementById('introductionModal').style.display = 'none';
                });
            }

            // Close all candidate info popups
            const closeInfoButtons = document.querySelectorAll('.close-info');
            closeInfoButtons.forEach(button => {
                button.addEventListener('click', function () {
                    this.closest('.candidate-info-popup').style.display = 'none';
                });
            });

            // Close modals when clicking outside
            window.addEventListener('click', function (event) {
                if (event.target.classList.contains('modal') || event.target.classList.contains(
                    'candidate-info-popup')) {
                    event.target.style.display = 'none';
                }
            });

            // Setup filter functionality
            setupFilters();
        });
    </script>
@endsection
