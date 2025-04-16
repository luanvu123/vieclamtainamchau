@extends('layout')

@section('content')
<style>
    .header {
        text-align: center;
        margin-bottom: 30px;
    }

    .header h1 {
        color: #e63946;
        font-size: 36px;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
        font-weight: bold;
        letter-spacing: 1px;
        margin-bottom: 20px;
    }

    .course-detail {
        background-color: white;
        border-radius: 8px;
        padding: 30px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        margin-bottom: 40px;
    }

    .course-detail img {
        max-width: 100%;
        border-radius: 8px;
        margin-bottom: 20px;
    }

    .course-description p {
        line-height: 1.8;
        font-size: 16px;
        color: #333;
        text-align: justify;
    }

    .course-actions {
        text-align: center;
        margin-top: 20px;
    }

    .course-actions .btn {
        margin: 0 10px;
    }
</style>

<!-- Section: Hotline -->
<div class="header">
    <h1>Chi tiết khóa học: {{ $training->name }}</h1>
</div>

<section class="hotlines-section">
    <div class="course-detail">
        <img src="{{ $training->image ? asset('storage/' . $training->image) : '/api/placeholder/600/400' }}" alt="{{ $training->name }}">
        <div class="course-description">
            {!! $training->description !!}
        </div>

        <div class="course-actions">
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#registerModal{{ $training->id }}">
                Đăng ký tư vấn
            </button>

        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="registerModal{{ $training->id }}" tabindex="-1" aria-labelledby="registerModalLabel{{ $training->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content" action="{{ route('candidate.site.language-training.register') }}" method="POST">
                @csrf
                <input type="hidden" name="language_training_id" value="{{ $training->id }}">
                <div class="modal-header">
                    <h5 class="modal-title" id="registerModalLabel{{ $training->id }}">Đăng ký tư vấn - {{ $training->name }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Họ và tên</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Số điện thoại</label>
                        <input type="text" class="form-control" name="phone" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="note" class="form-label">Ghi chú (tuỳ chọn)</label>
                        <textarea class="form-control" name="note" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Gửi yêu cầu</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
