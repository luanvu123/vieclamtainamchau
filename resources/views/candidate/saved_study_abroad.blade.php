@extends('layouts.layout_candidate_profile')

@section('content')
<style>
    .table-container {
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        margin: 20px 0;
    }

    .study-abroad-table {
        width: 100%;
        border-collapse: collapse;
        margin: 0;
    }

    .study-abroad-table th {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 15px 12px;
        text-align: left;
        font-weight: 600;
        font-size: 14px;
        border: none;
    }

    .study-abroad-table td {
        padding: 15px 12px;
        border-bottom: 1px solid #eee;
        vertical-align: middle;
        font-size: 14px;
    }

    .study-abroad-table tr:hover {
        background-color: #f8f9fa;
    }

    .study-image {
        width: 80px;
        height: 60px;
        object-fit: cover;
        border-radius: 6px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .study-name {
        font-weight: 600;
        color: #333;
        margin-bottom: 5px;
        line-height: 1.4;
    }

    .study-name a {
        color: #333;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .study-name a:hover {
        color: #667eea;
    }

    .study-detail {
        color: #666;
        font-size: 13px;
        line-height: 1.4;
        max-width: 300px;
    }

    .country-flags {
        display: flex;
        gap: 5px;
        flex-wrap: wrap;
    }

    .country-flag {
        width: 24px;
        height: 16px;
        object-fit: cover;
        border-radius: 2px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
    }

    .action-buttons {
        display: flex;
        gap: 8px;
        justify-content: center;
    }

    .action-btn {
        background: transparent;
        border: 1px solid #ddd;
        border-radius: 5px;
        padding: 8px 10px;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        min-width: 36px;
        height: 36px;
    }

    .action-btn i {
        font-size: 16px;
    }

    .btn-register:hover {
        background-color: #4CAF50;
        color: white;
        border-color: #4CAF50;
    }

    .btn-detail:hover {
        background-color: #2196F3;
        color: white;
        border-color: #2196F3;
    }

    .btn-save:hover {
        background-color: #ff5252;
        color: white;
        border-color: #ff5252;
    }

    .btn-save.saved {
        background-color: #ff5252;
        color: white;
        border-color: #ff5252;
    }

    .date-saved {
        color: #666;
        font-size: 13px;
        white-space: nowrap;
    }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        margin: 20px 0;
    }

    .empty-state i {
        color: #ddd;
        margin-bottom: 20px;
    }

    .empty-state h3 {
        color: #666;
        margin-bottom: 10px;
    }

    .pagination-container {
        display: flex;
        justify-content: center;
        margin: 20px 0;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .study-abroad-table {
            font-size: 12px;
        }

        .study-abroad-table th,
        .study-abroad-table td {
            padding: 10px 8px;
        }

        .study-image {
            width: 60px;
            height: 45px;
        }

        .action-buttons {
            flex-direction: column;
            gap: 5px;
        }

        .action-btn {
            min-width: 30px;
            height: 30px;
            padding: 5px;
        }
    }
</style>

@if ($savedStudyAbroad->count() > 0)
    <div class="table-container">
        <table class="study-abroad-table">
            <thead>
                <tr>
                    <th>Hình ảnh</th>
                    <th>Tên chương trình</th>
                    <th>Mô tả ngắn</th>
                    <th>Quốc gia</th>
                    <th>Ngày lưu</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($savedStudyAbroad as $study)
                    <tr>
                        <td>
                            <img src="{{ asset('storage/' . $study->image) }}"
                                 alt="{{ $study->name }}"
                                 class="study-image">
                        </td>
                        <td>
                            <div class="study-name">
                                <a href="{{ route('study-abroad.show', $study->slug) }}">
                                    {{ $study->name }}
                                </a>
                            </div>
                        </td>
                        <td>
                            <div class="study-detail">
                                {{ Str::limit($study->short_detail, 100) }}
                            </div>
                        </td>
                        <td>
                            <div class="country-flags">
                                @foreach ($study->countries as $country)
                                    <img src="{{ asset('storage/' . $country->image) }}"
                                         alt="{{ $country->name }}"
                                         title="{{ $country->name }}"
                                         class="country-flag">
                                @endforeach
                            </div>
                        </td>
                        <td>
                            <div class="date-saved">
                                {{ now()->locale('vi')->translatedFormat('j/m/Y') }}
                            </div>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <button class="action-btn btn-register"
                                        onclick="showRegisterPopup({{ $study->id }})"
                                        title="Đăng ký"
                                        data-id="{{ $study->id }}">
                                    <i class="fas fa-user-plus"></i>
                                </button>
                                <button class="action-btn btn-save saved"
                                        onclick="toggleSaveStudyAbroad({{ $study->id }})"
                                        title="Đã lưu"
                                        data-id="{{ $study->id }}">
                                    <i class="fas fa-heart"></i>
                                </button>
                                <a href="{{ route('study-abroad.show', $study->slug) }}"
                                   class="action-btn btn-detail"
                                   title="Xem chi tiết">
                                    <i class="fas fa-info-circle"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="pagination-container">
        {{ $savedStudyAbroad->links() }}
    </div>
@else
    <div class="empty-state">
        <i class="far fa-heart fa-4x"></i>
        <h3>Bạn chưa lưu du học nghề nào</h3>
        <p>Hãy duyệt qua các chương trình du học và lưu lại những chương trình bạn quan tâm.</p>
    </div>
@endif

<script>
    window.toggleSaveStudyAbroad = function (studyAbroadId) {
        fetch(`/candidate/save-study-abroad/${studyAbroadId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const saveBtn = document.querySelector(`.btn-save[data-id="${studyAbroadId}"]`);
                if (data.saved) {
                    saveBtn.innerHTML = '<i class="fas fa-heart"></i>';
                    saveBtn.classList.add('saved');
                    saveBtn.title = 'Đã lưu';
                } else {
                    // Nếu bỏ lưu, có thể reload trang hoặc ẩn row
                    location.reload();
                }
            }
        })
        .catch(error => {
            console.error('Lỗi:', error);
            alert('Có lỗi xảy ra khi lưu chương trình du học.');
        });
    };

    function showRegisterPopup(studyAbroadId) {
        const popup = document.getElementById('registerPopup');
        const form = document.getElementById('registerForm');

        if (popup && form) {
            const actionRoute = `/candidate/register-study-abroad/${studyAbroadId}`;
            form.action = actionRoute;
            popup.style.display = 'block';
        }
    }

    function closeRegisterPopup() {
        const popup = document.getElementById('registerPopup');
        if (popup) {
            popup.style.display = 'none';
        }
    }
</script>

@endsection
