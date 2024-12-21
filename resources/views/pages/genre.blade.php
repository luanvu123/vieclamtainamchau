@extends('layout')
@section('content')
    <section class="hero">
        <div class="search-bar">
            <input type="text" placeholder="Nhập từ khóa tìm kiếm">
            <input type="text" placeholder="Lựa chọn nghề nghiệp">
            <input type="text" placeholder="Nhập thị trường">
            <button class="search-btn">Tìm kiếm</button>
        </div>
    </section>

    <section class="stats">
        @foreach ($categories as $category)
            <div class="stat-item">
                <img src="{{ $category->image ? asset('storage/' . $category->image) : asset('frontend/img/default-category.png') }}"
                    alt="{{ $category->name }}">
                <p>{{ $category->name }}</p>
            </div>
        @endforeach
    </section>


    <section class="job-categories">
        <h1>Bài đăng tuyển dụng trong thể loại: {{ $genre->name }}</h1>

        @if ($genre->jobPostings->count() > 0)
             <div class="category-grid">
                @foreach ($genre->jobPostings as $job)
                     <div class="category-card">
                        @if ($job->employer && $job->employer->company_logo)
                            <img src="{{ asset('storage/' . $job->employer->company_logo) }}"
                                alt="{{ $job->employer->company_name }}"
                                onerror="this.src='{{ asset('frontend/img/company1.png') }}'">
                        @else
                            <img src="{{ asset('frontend/img/company1.png') }}" alt="Default Company Logo">
                        @endif
                         <div class="card-content">
                            <h3>{{ $job->title }}</h3>
                            <p>{{ $job->employer->company_name ?? 'Công ty TNHH' }}</p>
                            <p>Địa điểm: {{ $job->location ?? 'Không xác định' }}</p>
                            <p>Lương: {{ $job->salary ?? 'Thỏa thuận' }}</p>
                        </div>
                        <a href="{{ route('job.show', $job->slug) }}" class="btn btn-primary">Xem chi tiết</a>
                    </div>
                @endforeach
            </div>
        @else
            <p>Hiện tại không có bài đăng tuyển dụng nào trong thể loại này.</p>
        @endif
    </section>

    <section class="partners">
        <h2>CÁC ĐỐI TÁC</h2>
        <div class="partner-grid">
            <div class="partner-logo">
                <img src="{{ asset('frontend/img/company1.png') }}" alt="Partner Logo">
                <div class="partner-info">
                    <div class="position-count">
                        <i class="fas fa-briefcase"></i>
                        <span>51 vị trí đang tuyển</span>
                    </div>
                </div>
            </div>
            <div class="partner-logo">
                <img src="{{ asset('frontend/img/company1.png') }}" alt="Partner Logo">
                <div class="partner-info">
                    <div class="position-count">
                        <i class="fas fa-briefcase"></i>
                        <span>43 vị trí đang tuyển</span>
                    </div>
                </div>
            </div>
            <div class="partner-logo">
                <img src="{{ asset('frontend/img/company1.png') }}" alt="Partner Logo">
                <div class="partner-info">
                    <div class="position-count">
                        <i class="fas fa-briefcase"></i>
                        <span>37 vị trí đang tuyển</span>
                    </div>
                </div>
            </div>
            <div class="partner-logo">
                <img src="{{ asset('frontend/img/company1.png') }}" alt="Partner Logo">
                <div class="partner-info">
                    <div class="position-count">
                        <i class="fas fa-briefcase"></i>
                        <span>45 vị trí đang tuyển</span>
                    </div>
                </div>
            </div>
            <div class="partner-logo">
                <img src="{{ asset('frontend/img/company1.png') }}" alt="Partner Logo">
                <div class="partner-info">
                    <div class="position-count">
                        <i class="fas fa-briefcase"></i>
                        <span>39 vị trí đang tuyển</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="keywords-section">
        <h2>TỪ KHÓA TÌM VIỆC LÀM PHỔ BIẾN TẠI VIỆC LÀM NĂM CHÂU</h2>
        <div class="keywords-container">
            <div class="keyword-column">
                <h3>Việc làm theo ngành nghề</h3>
                <ul class="keyword-list">
                    <li>Lao động phổ thông</li>
                    <li>Công nhân sản xuất</li>
                    <li>Chăm sóc khách hàng</li>
                    <li>Kỹ sư</li>
                    <li>Cơ khí / Điện tử</li>
                    <li>An ninh - Bảo vệ</li>
                    <li>Chăm sóc khách hàng/ phục vụ - bưng bê</li>
                    <li>Thợ may</li>
                    <li>Khai thác nông lương - Khương phạt</li>
                    <li>Quản lý</li>
                    <li>Content Writer</li>
                </ul>
            </div>

            <div class="keyword-column">
                <h3>Việc làm tại quốc gia</h3>
                <ul class="keyword-list">
                    <li>Đài Loan</li>
                    <li>Singapore</li>
                    <li>Đức</li>
                    <li>Tây Ban Nha</li>
                    <li>Ba Lan</li>
                    <li>Hungary</li>
                    <li>Hà Lan</li>
                    <li>Bồ Đào Nha</li>
                    <li>Thụy Điển</li>
                    <li>Trung Quốc</li>
                    <li>Ả Rập</li>
                    <li>UAE</li>
                    <li>Kuwait</li>
                    <li>Vương Quốc Anh</li>
                    <li>Argentina</li>
                    <li>Canada</li>
                    <li>Estonia</li>
                    <li>Nhật Bản</li>
                    <li>Úc</li>
                </ul>
            </div>

            <div class="keyword-column">
                <h3>Việc làm phổ biến</h3>
                <ul class="keyword-list">
                    <li>Lao động phổ thông</li>
                    <li>Công nhân sản xuất</li>
                    <li>Chăm sóc khách hàng</li>
                    <li>Kỹ sư</li>
                    <li>Cơ khí / Điện tử</li>
                    <li>An ninh - Bảo vệ</li>
                    <li>Chăm sóc khách hàng/ phục vụ - bưng bê</li>
                    <li>Thợ may</li>
                    <li>Khai thác nông lương - Khương phạt</li>
                    <li>Quản lý</li>
                    <li>Content Writer</li>
                </ul>
            </div>
        </div>
    </section>
    <!-- End Cart Area  -->
@endsection
