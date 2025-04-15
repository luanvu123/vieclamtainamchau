@extends('layouts.manage')
@section('content')
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


        <div class="main-content">

            <div class="saved-applications-container">
                <h2>Hồ sơ đã lưu</h2>

                @if ($savedApplications->isNotEmpty())
                    <table class="applications-table" id="user-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tên ứng viên</th>
                                <th>Vị trí ứng tuyển</th>
                                <th>Ngày nộp</th>
                                <th>CV</th>
                                <th>Giới thiệu</th>
                                <th>Trạng thái</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($savedApplications as $key=> $application)
                                <tr data-application-id="{{ $application->id }}">
                                    <td>{{ $key }}</td>
                                    <td>{{ $application->candidate->name }} -  {{ $application->candidate->email }}</td>

                                    <td>{{ $application->jobPosting->title }}</td>
                                    <td>{{ $application->created_at->format('d/m/Y H:i') }}</td>
                                    <td>
                                        <a href="{{ asset('storage/' . $application->cv_path) }}" target="_blank"
                                            class="view-cv-btn">
                                             CV
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
                                        <button onclick="toggleSave('{{ $application->id }}')" class="save-btn saved"
                                            data-application-id="{{ $application->id }}">
                                            Đã lưu
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="no-applications">Chưa có hồ sơ nào được lưu.</p>
                @endif

            </div>

        </div>
@endsection
