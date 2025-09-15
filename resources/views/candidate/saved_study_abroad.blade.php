@extends('layouts.layout_candidate_profile')

@section('content')
<style>
    .page-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 2rem 0;
        margin-bottom: 2rem;
        border-radius: 12px;
    }

    .page-header h1 {
        font-size: 2rem;
        font-weight: 700;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .page-header .count-badge {
        background: rgba(255,255,255,0.2);
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.9rem;
        font-weight: 600;
    }

    .table-container {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        overflow: hidden;
        margin-bottom: 2rem;
    }

    .study-abroad-table {
        width: 100%;
        border-collapse: collapse;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .study-abroad-table thead {
        background: linear-gradient(135deg, #f8fafc, #e2e8f0);
    }

    .study-abroad-table th {
        padding: 1rem;
        font-weight: 600;
        color: #374151;
        text-align: left;
        border-bottom: 2px solid #e5e7eb;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .study-abroad-table th:first-child {
        width: 60px;
        text-align: center;
    }

    .study-abroad-table td {
        padding: 1.2rem 1rem;
        border-bottom: 1px solid #f3f4f6;
        vertical-align: middle;
    }

    .study-abroad-table tbody tr {
        transition: all 0.3s ease;
    }

    .study-abroad-table tbody tr:hover {
        background: #f8fafc;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    }

    .row-number {
        background: linear-gradient(135deg, #3b82f6, #1d4ed8);
        color: white;
        width: 32px;
        height: 32px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 0.9rem;
        margin: 0 auto;
    }

    .study-image {
        width: 80px;
        height: 60px;
        object-fit: cover;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        transition: transform 0.3s ease;
    }

    .study-image:hover {
        transform: scale(1.05);
    }

    .study-name a {
        color: #1f2937;
        text-decoration: none;
        font-weight: 600;
        font-size: 1.1rem;
        transition: color 0.3s ease;
    }

    .study-name a:hover {
        color: #3b82f6;
    }

    .study-detail {
        color: #6b7280;
        font-size: 0.9rem;
        line-height: 1.5;
        max-width: 300px;
    }

    .country-flags {
        display: flex;
        gap: 6px;
        flex-wrap: wrap;
    }

    .country-flag {
        width: 30px;
        height: 20px;
        object-fit: cover;
        border-radius: 4px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.2);
        transition: transform 0.3s ease;
    }

    .country-flag:hover {
        transform: scale(1.1);
    }

    .date-saved {
        color: #6b7280;
        font-size: 0.9rem;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .date-saved::before {
        content: "📅";
        font-size: 1rem;
    }

    .action-buttons {
        display: flex;
        gap: 8px;
        justify-content: center;
    }

    .action-btn {
        width: 36px;
        height: 36px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
        text-decoration: none;
        font-size: 0.9rem;
    }

    .btn-register {
        background: linear-gradient(135deg, #10b981, #059669);
        color: white;
    }

    .btn-register:hover {
        background: linear-gradient(135deg, #059669, #047857);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.4);
    }

    .btn-save {
        background: linear-gradient(135deg, #ef4444, #dc2626);
        color: white;
    }

    .btn-save:hover {
        background: linear-gradient(135deg, #dc2626, #b91c1c);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.4);
    }

    .btn-save.saved {
        background: linear-gradient(135deg, #ef4444, #dc2626);
    }

    .btn-detail {
        background: linear-gradient(135deg, #3b82f6, #1d4ed8);
        color: white;
    }

    .btn-detail:hover {
        background: linear-gradient(135deg, #1d4ed8, #1e40af);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.4);
    }

    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
    }

    .empty-state i {
        color: #d1d5db;
        margin-bottom: 1.5rem;
    }

    .empty-state h3 {
        color: #374151;
        font-size: 1.5rem;
        margin-bottom: 1rem;
    }

    .empty-state p {
        color: #6b7280;
        font-size: 1.1rem;
        max-width: 500px;
        margin: 0 auto;
        line-height: 1.6;
    }

    .pagination-container {
        display: flex;
        justify-content: center;
        margin-top: 2rem;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .page-header {
            padding: 1.5rem 1rem;
        }

        .page-header h1 {
            font-size: 1.5rem;
        }

        .table-container {
            overflow-x: auto;
            margin: 0 -1rem 2rem -1rem;
            border-radius: 0;
        }

        .study-abroad-table th,
        .study-abroad-table td {
            padding: 0.8rem 0.5rem;
            font-size: 0.85rem;
        }

        .study-image {
            width: 60px;
            height: 45px;
        }

        .country-flag {
            width: 25px;
            height: 16px;
        }

        .action-btn {
            width: 32px;
            height: 32px;
            font-size: 0.8rem;
        }

        .empty-state {
            padding: 3rem 1rem;
        }
    }

    @media (max-width: 480px) {
        .study-abroad-table th:nth-child(3),
        .study-abroad-table td:nth-child(3) {
            display: none;
        }
    }
</style>


@if ($savedStudyAbroad->count() > 0)
    <div class="table-container">
        <table class="study-abroad-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Hình ảnh</th>
                    <th>Tên chương trình</th>
                    <th>Mô tả ngắn</th>
                    <th>Quốc gia</th>
                    <th>Ngày lưu</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($savedStudyAbroad as $index => $study)
                    <tr>
                        <td>
                            <div class="row-number">
                                {{ ($savedStudyAbroad->currentPage() - 1) * $savedStudyAbroad->perPage() + $index + 1 }}
                            </div>
                        </td>
                        <td>
                            <img src="{{ asset('storage/' . $study->image) }}" alt="{{ $study->name }}"
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
                                    <img src="{{ asset('storage/' . $country->image) }}" alt="{{ $country->name }}"
                                        title="{{ $country->name }}" class="country-flag">
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
                                <button class="action-btn btn-register" onclick="showRegisterPopup({{ $study->id }})"
                                    title="Đăng ký tư vấn" data-id="{{ $study->id }}">
                                    <i class="fas fa-user-plus"></i>
                                </button>
                                <button class="action-btn btn-save saved" onclick="toggleSaveStudyAbroad({{ $study->id }})"
                                    title="Bỏ lưu" data-id="{{ $study->id }}">
                                    <i class="fas fa-heart"></i>
                                </button>
                                <a href="{{ route('study-abroad.show', $study->slug) }}" class="action-btn btn-detail"
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
        <h3>Bạn chưa lưu chương trình du học nghề nào</h3>
        <p>Hãy duyệt qua các chương trình du học nghề và lưu lại những chương trình bạn quan tâm để theo dõi dễ dàng hơn.</p>
        <div style="margin-top: 2rem;">
            <a href="{{ route('study-abroad.index') }}" class="action-btn btn-detail" style="width: auto; padding: 12px 24px; text-decoration: none;">
                <i class="fas fa-search"></i>
                <span style="margin-left: 8px;">Khám phá ngay</span>
            </a>
        </div>
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
