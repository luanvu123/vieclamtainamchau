@extends('layout')
@section('content')

    <section class="hero">
        <div class="search-bar">
            <form action="{{ route('site.search') }}" method="GET">
                <input type="text" name="keyword" placeholder="Nhập từ khóa tìm kiếm" value="{{ request('keyword') }}">
                <select name="category">
                    <option value="">Lựa chọn nghề nghiệp</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->slug }}"
                            {{ request('category') == $category->slug ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                <select name="country">
                    <option value="">Tất cả các quốc gia</option>
                    @foreach ($countries as $country)
                        <option value="{{ $country->slug }}" {{ request('country') == $country->slug ? 'selected' : '' }}>
                            {{ $country->name }}
                        </option>
                    @endforeach
                </select>
               <button class="search-btn" type="submit">
    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <circle cx="11" cy="11" r="8"></circle>
        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
    </svg>
</button>

            </form>
        </div>
    </section>


    <section class="stats">
        @foreach ($categories as $categoryItem)
            <div class="stat-item">
                <a href="{{ route('category.show', $categoryItem->slug) }}">
                    <img src="{{ $categoryItem->image ? asset('storage/' . $categoryItem->image) : asset('frontend/img/default-category.png') }}"
                        alt="{{ $categoryItem->name }}">
                    <p>{{ $categoryItem->name }}</p>
                </a>
            </div>
        @endforeach
    </section>




    <section class="job-categories">
        @foreach ($genres as $genre)
            @if ($genre->jobPostings->count() > 0)
                <section class="job-categories">
                    <h2><a href="{{ route('genre.show', $genre->slug) }}">{{ $genre->name }}</a></h2>

                    <div class="category-grid">
                        @foreach ($genre->jobPostings as $job)
                            <div
                                class="category-card {{ $job->employer && $job->employer->IsHoteffect ? 'hot-effect' : '' }}">
                                @if ($job->employer && $job->employer->avatar)
                                    <a href="{{ route('job.show', $job->slug) }}">
                                        <img src="{{ asset('storage/' . $job->employer->avatar) }}"
                                            alt="{{ $job->employer->company_name }}"
                                            onerror="this.src='{{ asset('frontend/img/company1.png') }}'">
                                    </a>
                                @else
                                    <a href="{{ route('job.show', $job->slug) }}">
                                        <img src="{{ asset('frontend/img/company1.png') }}" alt="Default Company Logo">
                                    </a>
                                @endif

                                <div class="card-content">
                                    <h3>
                                        <a href="{{ route('job.show', $job->slug) }}">
                                            {{ Str::limit($job->title, 30) }}
                                        </a>
                                    </h3>
                                    <p>{{ $job->employer ? $job->employer->company_name : 'Công ty TNHH' }}</p>
                                    <span>
                                        @if ($job->countries->isNotEmpty())
                                            {{ $job->countries->pluck('name')->join(', ') }}
                                        @else
                                            Không xác định quốc gia
                                        @endif
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    @if ($genre->jobPostings->count() > 4)
                        <div class="view-more">
                            <a href="{{ route('genre.show', $genre->slug) }}" class="btn btn-outline">
                                Xem thêm {{ $genre->name }}
                            </a>

                        </div>
                    @endif
                </section>
            @endif
        @endforeach
    </section>

    <section class="job-categories2">
        <h2 class="section-title">Du học nghề</h2>
        <div class="slider-container">
            <div class="slider">
                @foreach ($studyAbroads as $study)
                    <div class="job-card">
                        <div class="job-image">
                            <img src="{{ asset('storage/' . $study->image) }}" alt="{{ $study->name }}">
                        </div>
                        <div class="job-content">
                            <div class="date">
                                <i class="far fa-calendar"></i>
                                {{ now()->locale('vi')->translatedFormat('j F, Y') }}
                            </div>

                            <h3>{{ $study->name }}</h3>
                            <div class="job-details">
                                {{ $study->short_detail }}

                            </div>
                            <div class="job-footer">
                                <span class="location">
                                    <i class="fas fa-map-marker-alt"></i>
                                    @foreach ($study->countries as $country)
                                        {{ $country->name }}@if (!$loop->last)
                                            ,
                                        @endif
                                    @endforeach
                                </span>
                                <div class="action-buttons">
                                    <button class="btn-participate" onclick="showRegisterPopup()">THAM GIA</button>
                                    <a href="{{ route('study-abroad.show', $study->slug) }}" class="btn-detail">XEM CHI
                                        TIẾT</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Slider Navigation -->
            <div class="slider-nav">
                @foreach ($studyAbroads as $key => $study)
                    <button class="nav-dot {{ $key === 0 ? 'active' : '' }}"></button>
                @endforeach
            </div>
        </div>
    </section>
    <div id="registerPopup" class="popup">
        <div class="popup-content">
            <span class="close-btn" onclick="closeRegisterPopup()">&times;</span>
            <h2>ĐĂNG KÝ TƯ VẤN</h2>
            <form id="registerForm" action="{{ route('register.consult') }}" method="POST">
                @csrf
                <div class="form-group">
                    <input type="text" name="name" placeholder="Họ và Tên" required>
                </div>
                <div class="form-group">
                    <input type="tel" name="phone" placeholder="Số điện thoại" required>
                </div>
                <div class="form-group">
                    <input type="text" name="address" placeholder="Địa chỉ của bạn">
                </div>
                <div class="form-group">
                    <select name="program" required>
                        <option value="">Tư vấn du học nghề</option>
                        @foreach ($studyAbroads as $study)
                            <option value="{{ $study->id }}">{{ $study->name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="submit-btn">XÁC NHẬN</button>
            </form>
        </div>
    </div>

    <!-- Detail Popup -->
    <div id="detailPopup" class="popup">
        <div class="popup-content detail-content">
            <span class="close-btn" onclick="closeDetailPopup()">&times;</span>
            <div id="detailContent"></div>
        </div>
    </div>
    <style>
        .btn-detail {
            display: inline-block;
            padding: 8px 15px;
            background-color: #007bff;
            color: white;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        .btn-detail:hover {
            background-color: #0056b3;
        }

        /* Popup Styles */
        .popup {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
        }

        .popup-content {
            position: relative;
            background-color: #fff;
            margin: 15% auto;
            padding: 20px;
            width: 90%;
            max-width: 500px;
            border-radius: 8px;
        }

        .detail-content {
            max-width: 800px;
            margin: 5% auto;
        }

        .close-btn {
            position: absolute;
            right: 20px;
            top: 10px;
            font-size: 24px;
            cursor: pointer;
            color: #666;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }

        .submit-btn {
            width: 100%;
            padding: 12px;
            background-color: #ff1f6d;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .btn-view {
            background: none;
            border: none;
            color: #666;
            cursor: pointer;
            font-size: 18px;
            padding: 5px;
        }

        .btn-view:hover {
            color: #ff1f6d;
        }

        .job-categories2 {
            padding: 60px 20px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .section-title {
            text-align: center;
            font-size: 24px;
            margin-bottom: 40px;
            font-weight: bold;
        }

        .slider-container {
            position: relative;
            overflow: hidden;
        }

        .slider {
            display: flex;
            transition: transform 0.5s ease;
            gap: 20px;
        }

        .job-card {
            flex: 0 0 calc(33.333% - 20px);
            min-width: calc(33.333% - 20px);
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .job-image {
            height: 200px;
            overflow: hidden;
        }

        .job-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .job-content {
            padding: 20px;
        }

        .date {
            color: #666;
            font-size: 14px;
            margin-bottom: 10px;
        }

        .job-content h3 {
            font-size: 18px;
            margin-bottom: 15px;
            font-weight: bold;
        }

        .job-details {
            list-style: none;
            padding: 0;
            margin-bottom: 20px;
        }

        .job-details li {
            margin-bottom: 10px;
            font-size: 14px;
            line-height: 1.4;
        }

        .job-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
        }

        .location {
            color: #666;
            font-size: 14px;
        }

        .btn-participate {
            background: #ff1f6d;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
        }

        .slider-nav {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 20px;
        }

        .nav-dot {
            width: 30px;
            height: 4px;
            background: #ccc;
            border: none;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .nav-dot.active {
            background: #ff1f6d;
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .job-card {
                flex: 0 0 calc(50% - 20px);
                min-width: calc(50% - 20px);
            }
        }

        @media (max-width: 768px) {
            .job-card {
                flex: 0 0 100%;
                min-width: 100%;
            }
        }
    </style>
    <script>
        function showRegisterPopup() {
            document.getElementById('registerPopup').style.display = 'block';
        }

        function closeRegisterPopup() {
            document.getElementById('registerPopup').style.display = 'none';
        }

        function showDetailPopup(studyId) {
            const popup = document.getElementById('detailPopup');
            const contentDiv = document.getElementById('detailContent');

            // Fetch study details
            fetch(`/study-abroad/${studyId}/details`)
                .then(response => response.json())
                .then(data => {
                    contentDiv.innerHTML = `
                <h2>${data.name}</h2>
                <div class="detail-image">
                    <img src="${data.image}" alt="${data.name}">
                </div>
                <div class="detail-info">
                    <h3>Chi tiết chương trình</h3>
                    ${data.description}

                </div>
            `;
                    popup.style.display = 'block';
                });
        }

        function closeDetailPopup() {
            document.getElementById('detailPopup').style.display = 'none';
        }

        // Close popups when clicking outside
        window.onclick = function(event) {
            const registerPopup = document.getElementById('registerPopup');
            const detailPopup = document.getElementById('detailPopup');
            if (event.target == registerPopup) {
                registerPopup.style.display = 'none';
            }
            if (event.target == detailPopup) {
                detailPopup.style.display = 'none';
            }
        }
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const slider = document.querySelector('.slider');
            const slides = document.querySelectorAll('.job-card');
            const dots = document.querySelectorAll('.nav-dot');
            let currentSlide = 0;
            let slideWidth;

            function updateSlideWidth() {
                if (window.innerWidth <= 768) {
                    slideWidth = slider.clientWidth;
                } else if (window.innerWidth <= 1024) {
                    slideWidth = slider.clientWidth / 2;
                } else {
                    slideWidth = slider.clientWidth / 3;
                }
            }

            function goToSlide(index) {
                updateSlideWidth();
                currentSlide = index;
                slider.style.transform = `translateX(-${currentSlide * slideWidth}px)`;

                // Update active dot
                dots.forEach((dot, i) => {
                    dot.classList.toggle('active', i === currentSlide);
                });
            }

            // Initialize dot navigation
            dots.forEach((dot, index) => {
                dot.addEventListener('click', () => goToSlide(index));
            });

            // Handle window resize
            window.addEventListener('resize', () => {
                updateSlideWidth();
                goToSlide(currentSlide);
            });

            // Initialize slider
            updateSlideWidth();
            goToSlide(0);

            // Optional: Auto-slide
            setInterval(() => {
                currentSlide = (currentSlide + 1) % dots.length;
                goToSlide(currentSlide);
            }, 5000);
        });
    </script>
    <section class="partners">
        <h2>CÁC ĐỐI TÁC</h2>
        <div class="partner-grid">
            @if ($employerIsPartner->count() > 0)
                @foreach ($employerIsPartner as $partner)
                    <div class="partner-logo">
                        <img src="{{ asset('storage/' . $partner->avatar) }}" alt="{{ $partner->company_name }}"
                            onerror="this.src='{{ asset('frontend/img/company1.png') }}'">
                        <div class="partner-info">
                            <h5>{{ $partner->company_name }}</h5>
                            <div class="position-count">
                                <i class="fas fa-briefcase"></i>
                                <span>{{ $partner->job_postings_count }} vị trí đang tuyển</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <p>Hiện tại chưa có đối tác nào.</p>
            @endif
        </div>
    </section>


    <section class="keywords-section">
        <h2>TỪ KHÓA TÌM VIỆC LÀM PHỔ BIẾN TẠI VIỆC LÀM NĂM CHÂU</h2>
        <div class="keywords-container">
            <div class="keyword-column">
                <h3>Việc làm theo ngành nghề</h3>
                <ul class="keyword-list">
                    @foreach ($categories as $categoryItem)
                        <li>
                            <a href="{{ route('category.show', $categoryItem->slug) }}">{{ $categoryItem->name }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="keyword-column">
                <h3>Việc làm tại quốc gia</h3>
                <ul class="keyword-list">
                    @foreach ($countries as $country)
                        <li>
                            <a href="{{ route('country.show', $country->slug) }}">{{ $country->name }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="keyword-column">
                <h3>Việc làm danh mục</h3>
                <ul class="keyword-list">
                    @foreach ($genres as $genre)
                        <li>
                            <a href="{{ route('genre.show', $genre->slug) }}">{{ $genre->name }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>

        </div>
    </section>
    <!-- End Cart Area  -->
@endsection
