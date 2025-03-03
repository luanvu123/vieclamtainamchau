@extends('layout')

@section('title', 'Chỉnh sửa hồ sơ')

@section('content')
    <style>
        /* Style cho header thông báo */
        .p-4.border-b {
            border-bottom: 1px solid #e5e7eb;
            padding: 16px;
            margin-bottom: 8px;
        }

        /* Style cho thông báo */
        .text-gray-900 {
            color: #111827;
            font-size: 16px;
            font-weight: 500;
        }

        .text-gray-600 {
            color: #4B5563;
            font-size: 14px;
            line-height: 1.5;
        }

        /* Style cho nút Xóa */
        .xoa {
            color: #6B7280;
            font-size: 14px;
            padding: 4px 8px;
            border-radius: 4px;
            background: none;
            border: none;
            cursor: pointer;
        }

        .xoa:hover {
            color: #EF4444;
        }

        /* Style cho ngày thông báo */
        .notification-date {
            color: #6B7280;
            font-size: 14px;
            margin-top: 4px;
        }

        /* Container styling */
        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        /* Auth card styling */
        .auth-card {
            width: 100%;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 30px;
            max-width: 800px;
            margin: 40px auto;
        }

        /* Header styling */
        .auth-header {
            margin-bottom: 30px;
        }

        .auth-header h2 {
            color: #333;
            font-size: 24px;
            margin: 10px 0 0;
        }

        .header-icon {
            font-size: 32px;
            color: #dc3545;
            /* Changed to red */
            margin-bottom: 10px;
        }

        /* Form group styling */
        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #555;
        }

        .form-group label i {
            width: 20px;
            margin-right: 8px;
            color: #dc3545;
            /* Changed to red */
        }

        .checkbox-group {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .checkbox-group label {
            margin-bottom: 0;
        }

        .form-control {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
            transition: border-color 0.3s;
        }

        .form-control:focus {
            border-color: #dc3545;
            /* Changed to red */
            outline: none;
            box-shadow: 0 0 0 3px rgba(220, 53, 69, 0.25);
            /* Changed to red with opacity */
        }

        /* Checkbox styling */
        input[type="checkbox"] {
            width: 18px;
            height: 18px;
            margin-right: 8px;
            cursor: pointer;
        }

        /* File input styling */
        .form-control-file {
            padding: 8px 0;
        }

        /* Button styling */
        .btn {
            padding: 12px 24px;
            border-radius: 4px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn i {
            margin-right: 8px;
        }

        .btn-primary {
            background-color: #dc3545;
            /* Changed to red */
            border: none;
            color: white;
        }

        .btn-primary:hover {
            background-color: #c82333;
            /* Darker red for hover */
        }

        /* Alert styling */
        .alert {
            padding: 12px 20px;
            border-radius: 4px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .alert i {
            font-size: 18px;
        }

        .alert-success {
            background-color: #d4edda;
            border-color: #c3e6cb;
            color: #155724;
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .container {
                padding: 10px;
            }

            .auth-card {
                padding: 20px;
                margin: 20px auto;
            }

            .auth-header h2 {
                font-size: 20px;
            }

            .header-icon {
                font-size: 28px;
            }

            .form-group {
                margin-bottom: 15px;
            }

            .btn {
                width: 100%;
                padding: 10px 20px;
            }
        }

        @media (max-width: 480px) {
            .auth-card {
                padding: 15px;
                margin: 10px auto;
            }

            .header-icon {
                font-size: 24px;
            }

            .form-control {
                font-size: 14px;
                padding: 8px 10px;
            }

            .btn {
                font-size: 14px;
            }

            .form-group label i {
                width: 16px;
                font-size: 14px;
            }
        }

        /* Thêm vào file CSS của bạn */
        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .bg-white {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .divide-y>div {
            border-bottom: 1px solid #e5e7eb;
            padding: 16px;
        }

        .divide-y>div:last-child {
            border-bottom: none;
        }

        .text-xl {
            font-size: 20px;
            font-weight: 600;
            color: #111827;
        }

        /* Style cho thông báo chưa đọc */
        .bg-blue-50 {
            background-color: #f0f7ff;
        }

        /* Style cho nút xóa */
        .xoa-btn {
            color: #6B7280;
            font-size: 14px;
            padding: 4px 8px;
            border-radius: 4px;
            float: right;
        }

        .xoa-btn:hover {
            color: #EF4444;
        }

        /* Style cho ngày thông báo */
        .text-gray-500 {
            color: #6B7280;
            font-size: 14px;
            margin-top: 4px;
        }

        /* Style cho tiêu đề thông báo */
        .notification-title {
            font-size: 16px;
            font-weight: 500;
            color: #111827;
            margin-bottom: 4px;
        }

        /* Style cho button đánh dấu đã đọc */
        .mark-as-read-btn {
            background: none;
            border: none;
            color: #2563EB;
            font-size: 14px;
            cursor: pointer;
        }

        .mark-as-read-btn:hover {
            color: #1D4ED8;
        }

        /* Style cho phân trang */
        .pagination {
            display: flex;
            justify-content: center;
            gap: 8px;
            margin-top: 16px;
        }

        /* Responsive */
        @media (max-width: 640px) {
            .container {
                padding: 8px;
            }

            .flex {
                flex-direction: column;
            }

            .xoa-btn {
                margin-top: 8px;
            }
        }
    </style>
    <div class="container">

       <div class="sidebar">
            <div class="menu-title">Quản lý CV</div>
            <div class="menu-section">

                <a href="{{ route('candidate.cv.white') }}" class="menu-item">
                    <i>📄</i>
                    <span>Mẫu CV cổ điển</span>
                </a>
                <a href="{{ route('candidate.cv.black') }}" class="menu-item">
                    <i>📄</i>
                    <span>Mẫu CV hiện đại</span>
                </a>
                <a href="{{ route('candidate.cv.logistic') }}" class="menu-item">
                    <i>📄</i>
                    <span>Mẫu CV Xuất khẩu LD</span>
                </a>
            </div>

            <div class="menu-section">
                <div class="menu-title">Quản lý ứng tuyển</div>
                <a href="{{ route('candidate.profile.edit') }}" class="menu-item">
                    <i>📊</i>
                    <span>Cập nhật hồ sơ & CV</span>
                </a>
                <a href="{{ route('candidate.applications') }}" class="menu-item">
                    <i>👥</i>
                    <span>Hồ sơ đã nộp</span>
                </a>
                <a href="{{ route('news.home') }}" class="menu-item">
                    <i>❤️</i>
                    <span>Cẩm nang nghề nghiệp</span>
                </a>
                 <a href="{{ route('candidate.notifications') }}" class="menu-item">
                     <i>📋</i>
                     <span>Thông báo</span>
                 </a>
            </div>

        </div>

       <div class="main-content">
            <div class="bg-white rounded-lg shadow">
                <div class="p-4 border-b flex justify-between items-center">
                    <h2 class="text-xl font-semibold">Thông báo</h2>
                    <form action="{{ route('candidate.notifications.clear-all') }}" method="POST">
                        @csrf
                        <button type="submit" class="text-sm text-blue-600 hover:text-blue-800">
                            Đánh dấu tất cả là đã đọc
                        </button>
                    </form>
                </div>

                <div class="divide-y">
                    @forelse ($notifications as $notification)
                        <div class="p-4 hover:bg-gray-50 {{ $notification->is_read ? 'bg-white' : 'bg-blue-50' }}"
                            data-notification-id="{{ $notification->id }}">
                            <div class="flex justify-between items-start">
                                <div class="flex-1">
                                    <h3 class="font-medium text-gray-900">{{ $notification->title }}</h3>
                                    <p class="text-gray-600 mt-1">{{ $notification->message }}</p>
                                    <div class="mt-2 text-sm text-gray-500">
                                        {{ $notification->created_at->diffForHumans() }}
                                    </div>
                                </div>
                                @if (!$notification->is_read)
                                    <button class="mark-as-read-btn text-sm text-blue-600 hover:text-blue-800">
                                        Đánh dấu đã đọc
                                    </button>
                                @endif
                            </div>
                            @if ($notification->link)
                                <a href="{{ $notification->link }}"
                                    class="mt-2 inline-block text-sm text-blue-600 hover:text-blue-800">
                                    Xem chi tiết
                                </a>
                            @endif
                        </div>
                    @empty
                        <div class="p-4 text-center text-gray-500">
                            Không có thông báo nào
                        </div>
                    @endforelse
                </div>

                <div class="p-4">
                    {{ $notifications->links() }}
                </div>
            </div>
        </div>

        @push('scripts')
            <script>
                document.querySelectorAll('.mark-as-read-btn').forEach(btn => {
                    btn.addEventListener('click', async function() {
                        const notificationDiv = this.closest('[data-notification-id]');
                        const notificationId = notificationDiv.dataset.notificationId;

                        try {
                            const response = await fetch(
                                `/candidate/notifications/${notificationId}/mark-as-read`, {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                            .content
                                    }
                                });

                            if (response.ok) {
                                notificationDiv.classList.remove('bg-blue-50');
                                notificationDiv.classList.add('bg-white');
                                this.remove();
                            }
                        } catch (error) {
                            console.error('Error:', error);
                        }
                    });
                });
            </script>
        @endpush


    </div>
@endsection
