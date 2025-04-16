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

            .divider {
                display: flex;
                align-items: center;
                justify-content: center;
                margin-bottom: 30px;
            }

            .divider hr {
                width: 150px;
                border: 1px solid #0077b6;
            }

            .divider .icon {
                margin: 0 15px;
                color: #ffc107;
                font-size: 24px;
            }

            .courses-grid {
                display: grid;
                grid-template-columns: repeat(3, 1fr);
                gap: 20px;
            }

            .course-card {
                background-color: white;
                border-radius: 8px;
                overflow: hidden;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                transition: transform 0.3s ease;
            }

            .course-card:hover {
                transform: translateY(-5px);
            }

            .course-image {
                position: relative;
                height: 250px;
                overflow: hidden;
                background-color: #f8f9fa;
            }

            .course-image img {
                width: 100%;
                height: 100%;
                object-fit: cover;
            }

            .course-title {
                text-align: center;
                padding: 15px 10px;
            }

            .course-title h3 {
                color: #0077b6;
                font-size: 20px;
                margin-bottom: 15px;
            }

            .course-description {
                padding: 0 15px 20px;
                color: #333;
                font-size: 14px;
                line-height: 1.6;
                text-align: justify;
            }

            .course-label {
                font-size: 12px;
                color: #555;
                text-transform: uppercase;
                margin-bottom: 5px;
            }

            .chinese-course .course-title h3 {
                color: #e63946;
            }

            .taiwanese-course .course-title h3 {
                color: #fb8500;
            }

            .spanish-course .course-title h3 {
                color: #fb8500;
            }

            .course-image-overlay {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: url('/api/placeholder/400/320');
                background-size: cover;
            }

            .course-image-decoration {
                position: absolute;
                width: 100%;
                height: 100%;
                top: 0;
                left: 0;
                pointer-events: none;
            }

            /* Decorative elements */
            .decoration-circle {
                position: absolute;
                border-radius: 50%;
                border: 2px solid rgba(200, 200, 200, 0.3);
                width: 60px;
                height: 60px;
            }

            .decoration-square {
                position: absolute;
                width: 30px;
                height: 30px;
                border: 2px solid rgba(200, 200, 200, 0.3);
                transform: rotate(45deg);
            }

            .color-accent {
                position: absolute;
                width: 80px;
                height: 80px;
                border-radius: 0 0 0 15px;
                bottom: 0;
                right: 0;
                z-index: 2;
            }

            .chinese-basic .color-accent {
                background-color: #e63946;
            }

            .chinese-taiwan .color-accent {
                background-color: #0077b6;
            }

            .spanish .color-accent {
                background-color: #fb8500;
            }
        </style>
    <!-- Section: Hotline -->
      <div class="header">
        <h1>Đơn vị đào tạo ngôn ngữ của: {{ $type->name }}</h1>
    </div>

    <section class="hotlines-section">
        <div class="courses-grid">
            @forelse ($trainings as $training)
                <div class="course-card">
                    <div class="course-image">
                        <div class="course-image-decoration">
                            <div class="decoration-circle" style="top: 20px; right: 30px;"></div>
                            <div class="decoration-square" style="bottom: 50px; left: 40px;"></div>
                        </div>
                        <img src="{{ $training->image ? asset('storage/' . $training->image) : '/api/placeholder/400/320' }}" alt="{{ $training->name }}">
                    </div>
                    <div class="course-title">
                        <div class="course-label">KHÓA HỌC:</div>
                        <h3>{{ $training->name }}</h3>
                    </div>
                    <div class="course-description">
                        {!! Str::limit(strip_tags($training->description), 100) !!}
                    </div>
                    <div class="course-actions mt-2">
                        <a href="{{ route('site.language-training.detail', $training->slug) }}" class="btn btn-sm btn-primary">Xem chi tiết</a>
                        <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#registerModal{{ $training->id }}">
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
            @empty
                <p>Hiện chưa có khoá học nào thuộc đơn vị này.</p>
            @endforelse
        </div>

        <div class="mt-4">
            {{ $trainings->links() }}
        </div>
    </section>


@endsection
