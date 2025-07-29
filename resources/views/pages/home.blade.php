@extends('layout')
@section('content')

    <section class="hero">
        <div class="search-bar">
            <form action="{{ route('site.search') }}" method="GET">
                <div class="search-input-container">
                    <input type="text" name="keyword" id="searchInput" placeholder="Nhập từ khóa tìm kiếm"
                        value="{{ request('keyword') }}" autocomplete="off">
                    <ul id="search-suggestions" class="search-suggestions"></ul>
                </div>
                <select name="category">
                    <option value="">Lựa chọn nghề nghiệp</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->slug }}" {{ request('category') == $category->slug ? 'selected' : '' }}>
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
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
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





    @php $bgIndex = 0; @endphp
    @foreach ($genres as $genre)
        @php
            $jobs = $paginatedJobsByGenre[$genre->id] ?? collect();
        @endphp

        @if ($jobs->count() > 0)
            <section class="job-categories bg-{{ $bgIndex }}">
                <h2>
                    <a href="{{ route('genre.show', $genre->slug) }}">
                        {{ $genre->name }}

                    </a>
                </h2>

                <div class="category-grid">
                    @foreach ($jobs as $job)
                        <div class="job-card {{ $job->service_type === 'Tin đặc biệt' ? 'hot-job' : '' }}">
                            <div class="job-card-content">
                                <!-- Logo và thông tin chính -->
                                <div class="job-header">
                                    <div class="company-logo">
                                        @if ($job->employer && $job->employer->avatar)
                                            <a href="{{ route('candidate.job.show', $job->slug) }}">
                                                <img src="{{ asset('storage/' . $job->employer->avatar) }}"
                                                    alt="{{ $job->employer->company_name }}"
                                                    onerror="this.src='{{ asset('frontend/company1.png') }}'">
                                            </a>
                                        @else
                                            <a href="{{ route('candidate.job.show', $job->slug) }}">
                                                <img src="{{ asset('frontend/company1.png') }}" alt="Default Company Logo">
                                            </a>
                                        @endif
                                    </div>

                                    <div class="job-info">
                                        <h3 class="job-title">
                                            <a href="{{ route('candidate.job.show', $job->slug) }}" title="{{ $job->title }}">
                                                {{ Str::limit($job->title, 30) }}
                                                @if ($job->service_type === 'Tin đặc biệt')
                                                    <span class="hot-icon">🔥</span>
                                                @endif
                                            </a>
                                        </h3>

                                        <p class="company-name">
                                            {{ $job->employer ? $job->employer->company_name : 'Công ty TNHH' }}
                                        </p>

                                        <div class="job-meta">
                                            @if ($job->salary)
                                                <span class="salary">{{ $job->salary }}</span>
                                            @endif

                                            @if ($job->countries->isNotEmpty())
                                                <span class="location">{{ $job->countries->pluck('name')->join(', ') }}</span>
                                            @else
                                                <span class="location">Không xác định quốc gia</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="job-actions">
                                        <button class="save-job-btn" data-job-id="{{ $job->id }}">
                                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2">
                                                <path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>

                                <!-- Thông tin bổ sung -->
                                <div class="job-details">
                                    <div class="job-tags">
                                        @if ($job->type)
                                            <span class="job-tag job-type">{{ $job->type }}</span>
                                        @endif

                                        @if ($job->experience)
                                            <span class="job-tag experience">{{ $job->experience }}</span>
                                        @endif

                                        <span class="job-tag time-posted">
                                            {{ $job->created_at->diffForHumans() }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Hiển thị phân trang -->
                <div class="pagination-container">
                    {{ $jobs->appends(request()->except('genre_' . $genre->id))->links() }}
                </div>

                @if ($jobs->total() > 12)
                    <div class="view-more">
                        <a href="{{ route('genre.show', $genre->slug) }}" class="btn btn-outline">
                            Xem thêm {{ $genre->name }}
                        </a>
                    </div>
                @endif
            </section>

            @php $bgIndex++; @endphp
        @endif
    @endforeach






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

                            <h3>{{ $study->name }}

                            </h3>

                            <div class="job-details">
                                {{ $study->short_detail }}
                            </div>

                            <div class="job-footer">
                                <span class="location">
                                    @foreach ($study->countries as $country)
                                        <img src="{{ asset('storage/' . $country->image) }}" alt="{{ $country->name }}"
                                            class="country-flag">@if (!$loop->last) @endif
                                    @endforeach
                                </span>

                                <div class="action-buttons">
                                    <button class="btn-participate" onclick="showRegisterPopup({{ $study->id }})"
                                        data-id="{{ $study->id }}">
                                        <i class="fas fa-user-plus fa-lg"></i>
                                    </button>
                                    <button class="save-btn" onclick="toggleSaveStudyAbroad({{ $study->id }})"
                                        data-id="{{ $study->id }}">
                                        <i class="far fa-heart fa-lg"></i>
                                    </button>
                                    <a href="{{ route('study-abroad.show', $study->slug) }}" class="btn-detail">
                                        <i class="fas fa-info-circle fa-lg"></i>
                                    </a>
                                </div>
                            </div>

                            <style>
                                .job-footer {
                                    display: flex;
                                    justify-content: space-between;
                                    align-items: center;
                                    margin-top: 15px;
                                }

                                .location {
                                    display: flex;
                                    gap: 5px;
                                }

                                .country-flag {
                                    width: 24px;
                                    height: 16px;
                                    object-fit: cover;
                                    vertical-align: middle;
                                }

                                .action-buttons {
                                    display: flex;
                                    gap: 10px;
                                }

                                .action-buttons button,
                                .action-buttons a {
                                    background: transparent;
                                    border: 1px solid #ddd;
                                    border-radius: 5px;
                                    padding: 8px 12px;
                                    cursor: pointer;
                                    transition: all 0.3s ease;
                                    display: flex;
                                    align-items: center;
                                    justify-content: center;
                                }

                                .action-buttons i {
                                    font-size: 18px;
                                    width: 20px;
                                    height: 20px;
                                    display: flex;
                                    align-items: center;
                                    justify-content: center;
                                }

                                .btn-participate:hover {
                                    background-color: #4CAF50;
                                    color: white;
                                    border-color: #4CAF50;
                                }

                                .btn-detail:hover {
                                    background-color: #2196F3;
                                    color: white;
                                    border-color: #2196F3;
                                }

                                .save-btn:hover {
                                    background-color: #ff5252;
                                    color: white;
                                    border-color: #ff5252;
                                }

                                .save-btn.saved {
                                    background-color: #ff5252;
                                    color: white;
                                    border-color: #ff5252;
                                }

                                .save-btn.processing {
                                    opacity: 0.7;
                                    pointer-events: none;
                                }
                            </style>
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

    <!-- ✅ Popup Form -->
    <div id="registerPopup" class="popup" style="display: none;">
        <div class="popup-content">
            <span class="close-btn" onclick="closeRegisterPopup()">&times;</span>
            <h2>ĐĂNG KÝ TƯ VẤN</h2>
            <form id="registerForm" method="POST">
                @csrf
                <div class="form-group">
                    <input type="text" name="name" placeholder="Họ và tên" required>
                </div>
                <div class="form-group">
                    <input type="text" name="phone" placeholder="Số điện thoại" required>
                </div>
                <div class="form-group">
                    <input type="text" name="address" placeholder="Địa chỉ">
                </div>
                <button type="submit" class="submit-btn">Xác nhận</button>
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
        .country-flag {
            width: 24px;
            height: 16px;
            object-fit: cover;
            vertical-align: middle;
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



        .job-categories.bg-0 {
            background-color: #f5f5f5;
        }

        .job-categories.bg-1 {
            background-color: #ced2d3;
        }

        .job-categories.bg-2 {
            background-color: #fff8e1;
        }

        .job-categories.bg-3 {
            background-color: #e8f5e9;
        }

        .job-categories.bg-4 {
            background-color: #ede7f6;
        }

        /* Nếu có nhiều hơn 5 genres, dùng % để lặp lại */
        .job-categories.bg-5,
        .job-categories.bg-6,
        .job-categories.bg-7 {
            background-color: #fce4ec;
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
    <style>
        /* Job Card Styles */
        .category-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(400px, 1fr));
            gap: 16px;
            margin: 20px 0;
            margin-left: 8rem;
            margin-right: 8rem;
        }

        .job-card {
            background: white;
            border-radius: 8px;
            border: 1px solid #e5e5e5;
            padding: 16px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .job-card:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border-color: #d0d0d0;
        }

        /* Hot Job Effect */
        .job-card.hot-job {
            border-left: 4px solid #ff4757;
            background: linear-gradient(135deg, #fff 0%, #fff5f5 100%);
            position: relative;
        }

        .job-card.hot-job::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 0;
            height: 0;
            border-left: 20px solid transparent;
            border-top: 20px solid #ff4757;
        }

        .job-card.hot-job::after {
            content: 'HOT';
            position: absolute;
            top: 2px;
            right: 2px;
            color: white;
            font-size: 8px;
            font-weight: bold;
            transform: rotate(45deg);
            transform-origin: center;
        }

        /* Job Header */
        .job-header {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            margin-bottom: 12px;
        }

        .company-logo {
            flex-shrink: 0;
            width: 60px;
            height: 60px;
            border-radius: 8px;
            overflow: hidden;
            border: 1px solid #e5e5e5;
            background: white;
        }

        .company-logo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .job-info {
            flex: 1;
            min-width: 0;
        }

        .job-title {
            margin: 0 0 6px 0;
            font-size: 16px;
            font-weight: 600;
            line-height: 1.3;
            color: #333;
        }

        .job-title a {
            color: inherit;
            text-decoration: none;
            display: block;
        }

        .job-title a:hover {
            color: #2563eb;
        }

        .hot-icon {
            font-size: 14px;
            margin-left: 6px;
            animation: hotBounce 2s infinite;
        }

        .company-name {
            margin: 0 0 8px 0;
            font-size: 14px;
            color: #666;
            font-weight: 400;
        }

        .job-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            font-size: 14px;
        }

        .salary {
            color: #2563eb;
            font-weight: 600;
        }

        .location {
            color: #666;
        }

        /* Job Actions */
        .job-actions {
            flex-shrink: 0;
        }

        .save-job-btn {
            background: none;
            border: 1px solid #e5e5e5;
            border-radius: 6px;
            padding: 8px;
            cursor: pointer;
            color: #666;
            transition: all 0.2s ease;
        }

        .save-job-btn:hover {
            background: #f8fafc;
            color: #2563eb;
            border-color: #2563eb;
        }

        .save-job-btn.saved {
            background: #2563eb;
            color: white;
            border-color: #2563eb;
        }

        /* Job Details */
        .job-details {
            margin-top: 12px;
            padding-top: 12px;
            border-top: 1px solid #f0f0f0;
        }

        .job-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .job-tag {
            background: #f1f5f9;
            color: #475569;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 500;
        }

        .job-tag.job-type {
            background: #dbeafe;
            color: #1e40af;
        }

        .job-tag.experience {
            background: #dcfce7;
            color: #166534;
        }

        .job-tag.time-posted {
            background: #f3f4f6;
            color: #6b7280;
        }

        /* Hot Badge for Genre Title */
        .hot-badge {
            background: linear-gradient(45deg, #ff6b6b, #ff4757);
            color: white;
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: bold;
            margin-left: 8px;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
            animation: hotPulse 2s infinite;
        }

        /* Animations */
        @keyframes hotBounce {

            0%,
            20%,
            50%,
            80%,
            100% {
                transform: translateY(0);
            }

            40% {
                transform: translateY(-2px);
            }

            60% {
                transform: translateY(-1px);
            }
        }

        @keyframes hotPulse {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .category-grid {
                grid-template-columns: 1fr;
                gap: 12px;
            }

            .job-card {
                padding: 12px;
            }

            .job-header {
                gap: 10px;
            }

            .company-logo {
                width: 48px;
                height: 48px;
            }

            .job-title {
                font-size: 15px;
            }

            .job-meta {
                flex-direction: column;
                gap: 4px;
            }
        }

        @media (max-width: 480px) {
            .job-header {
                flex-direction: column;
                align-items: stretch;
            }

            .job-actions {
                align-self: flex-end;
                margin-top: -40px;
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
        window.onclick = function (event) {
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
        document.addEventListener('DOMContentLoaded', function () {
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
            <div class="row">
                @foreach($companyPartners->chunk(6) as $partnerChunk)
                    <div class="row mb-4">
                        @foreach($partnerChunk as $partner)
                            <div class="col-md-2">
                                <div class="partner-item">
                                    <img src="{{ asset('storage/' . $partner->image) }}" alt="{{ $partner->name }}"
                                        class="img-fluid">
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <style>
        .partners {
            padding: 50px 0;
            background-color: #f9f9f9;
        }

        .partners h2 {
            text-align: center;
            margin-bottom: 30px;
            font-weight: bold;
            position: relative;
        }

        .partners h2:after {
            content: '';
            display: block;
            width: 80px;
            height: 3px;
            background-color: #007bff;
            margin: 10px auto 0;
        }

        .partner-grid {
            max-width: 1200px;
            margin: 0 auto;
        }

        .partner-item {
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #fff;
            border: 1px solid #e0e0e0;
            border-radius: 5px;
            padding: 15px;
            height: 120px;
            transition: all 0.3s ease;
        }

        .partner-item:hover {
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transform: translateY(-3px);
        }

        .partner-item img {
            max-height: 80%;
            max-width: 80%;
            object-fit: contain;
        }
    </style>

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
                <h3>Từ khóa</h3>
                <ul class="keyword-list">
                    @foreach($keySearches as $keySearch)
                        <li><a href="{{ $keySearch->url }}">{{ $keySearch->name }}</a></li>
                    @endforeach
                </ul>
            </div>

        </div>
    </section>

    <script>
        window.toggleSaveStudyAbroad = function (studyAbroadId) {
            document.querySelectorAll(".save-btn").forEach(button => {
                button.addEventListener("click", function () {
                    const studyAbroadId = this.dataset.id;
                    toggleSaveStudyAbroad(studyAbroadId);
                });
            });

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
                        const saveBtn = document.querySelector(`.save-btn[data-id="${studyAbroadId}"]`);
                        if (data.saved) {
                            saveBtn.innerHTML = 'Đã lưu';
                            saveBtn.classList.add('saved');
                        } else {
                            saveBtn.innerHTML = 'Lưu';
                            saveBtn.classList.remove('saved');
                        }
                    }
                })
                .catch(error => {
                    console.error('Lỗi:', error);
                    alert('Có lỗi xảy ra khi lưu chương trình du học.');
                });
        };

        // Kiểm tra nếu chương trình đã được lưu
        document.addEventListener("DOMContentLoaded", function () {
            document.querySelectorAll(".save-btn").forEach(button => {
                const studyAbroadId = button.dataset.id;

                fetch(`/candidate/study-abroad/${studyAbroadId}/check-saved`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.saved) {
                            button.innerHTML = '❤️';
                            button.classList.add('saved');
                        }
                    });
            });
        });
    </script>
    <script>
        function showRegisterPopup(studyAbroadId) {
            const popup = document.getElementById('registerPopup');
            const form = document.getElementById('registerForm');

            // Gán action route động đúng với route Laravel
            const actionRoute = `/candidate/register-study-abroad/${studyAbroadId}`;
            form.action = actionRoute;

            popup.style.display = 'block';
        }

        function closeRegisterPopup() {
            document.getElementById('registerPopup').style.display = 'none';
        }
    </script>
    <script>
        // Save Job Functionality
        document.addEventListener('DOMContentLoaded', function () {

            // Function to check if jobs are already saved when page loads
            function checkSavedJobs() {
                const saveButtons = document.querySelectorAll('.save-job-btn');

                saveButtons.forEach(button => {
                    const jobId = button.getAttribute('data-job-id');

                    fetch(`/check-saved/${jobId}`, {
                        method: 'GET',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success && data.saved) {
                                button.classList.add('saved');
                                updateButtonState(button, true);
                            }
                        })
                        .catch(error => {
                            console.error('Error checking saved status:', error);
                        });
                });
            }

            // Function to update button appearance
            function updateButtonState(button, isSaved) {
                const svg = button.querySelector('svg path');

                if (isSaved) {
                    button.classList.add('saved');
                    button.setAttribute('title', 'Đã lưu - Click để bỏ lưu');
                    // Fill the bookmark icon
                    svg.setAttribute('fill', 'currentColor');
                } else {
                    button.classList.remove('saved');
                    button.setAttribute('title', 'Lưu công việc');
                    // Empty the bookmark icon
                    svg.setAttribute('fill', 'none');
                }
            }

            // Function to show toast notification
            function showToast(message, type = 'success') {
                // Remove existing toast if any
                const existingToast = document.querySelector('.toast-notification');
                if (existingToast) {
                    existingToast.remove();
                }

                // Create toast element
                const toast = document.createElement('div');
                toast.className = `toast-notification toast-${type}`;
                toast.innerHTML = `
                        <div class="toast-content">
                            <span class="toast-icon">${type === 'success' ? '✓' : '⚠'}</span>
                            <span class="toast-message">${message}</span>
                            <button class="toast-close" onclick="this.parentElement.parentElement.remove()">×</button>
                        </div>
                    `;

                // Add to page
                document.body.appendChild(toast);

                // Auto remove after 3 seconds
                setTimeout(() => {
                    if (toast && toast.parentNode) {
                        toast.remove();
                    }
                }, 3000);
            }

            // Handle save job button clicks
            document.addEventListener('click', function (e) {
                if (e.target.closest('.save-job-btn')) {
                    e.preventDefault();

                    const button = e.target.closest('.save-job-btn');
                    const jobId = button.getAttribute('data-job-id');

                    // Disable button during request
                    button.disabled = true;
                    button.style.opacity = '0.6';

                    // Add loading animation
                    button.classList.add('loading');

                    fetch(`/candidate/save-job/${jobId}`, {
                        method: 'POST',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    })
                        .then(response => {
                            if (!response.ok) {
                                if (response.status === 401) {
                                    throw new Error('Vui lòng đăng nhập để lưu công việc');
                                }
                                throw new Error('Có lỗi xảy ra, vui lòng thử lại');
                            }
                            return response.json();
                        })
                        .then(data => {
                            if (data.success) {
                                updateButtonState(button, data.saved);
                                showToast(data.message, 'success');

                                // Update save counter if exists
                                updateSaveCounter(data.saved);
                            } else {
                                showToast(data.error || 'Có lỗi xảy ra', 'error');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            showToast(error.message, 'error');

                            // If unauthorized, redirect to login
                            if (error.message.includes('đăng nhập')) {
                                setTimeout(() => {
                                    window.location.href = '/candidate/login';
                                }, 2000);
                            }
                        })
                        .finally(() => {
                            // Re-enable button
                            button.disabled = false;
                            button.style.opacity = '1';
                            button.classList.remove('loading');
                        });
                }
            });

            // Function to update save counter (if you have a saved jobs counter somewhere)
            function updateSaveCounter(isSaved) {
                const counter = document.querySelector('.saved-jobs-counter');
                if (counter) {
                    let currentCount = parseInt(counter.textContent) || 0;
                    if (isSaved) {
                        currentCount++;
                    } else {
                        currentCount = Math.max(0, currentCount - 1);
                    }
                    counter.textContent = currentCount;
                }
            }

            // Initialize saved status check
            checkSavedJobs();
        });

        // CSS Styles (add to your CSS file or in a <style> tag)
        const saveJobStyles = `
            <style>
            /* Save button states */
            .save-job-btn {
                position: relative;
                transition: all 0.3s ease;
            }

            .save-job-btn.loading::after {
                content: '';
                position: absolute;
                top: 50%;
                left: 50%;
                width: 16px;
                height: 16px;
                margin: -8px 0 0 -8px;
                border: 2px solid transparent;
                border-top: 2px solid currentColor;
                border-radius: 50%;
                animation: spin 1s linear infinite;
            }

            .save-job-btn.loading svg {
                opacity: 0;
            }

            .save-job-btn.saved {
                background: #2563eb !important;
                color: white !important;
                border-color: #2563eb !important;
            }

            /* Toast Notification */
            .toast-notification {
                position: fixed;
                top: 20px;
                right: 20px;
                z-index: 9999;
                min-width: 300px;
                max-width: 400px;
                background: white;
                border-radius: 8px;
                box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
                animation: slideInRight 0.3s ease-out;
            }

            .toast-notification.toast-success {
                border-left: 4px solid #10b981;
            }

            .toast-notification.toast-error {
                border-left: 4px solid #ef4444;
            }

            .toast-content {
                display: flex;
                align-items: center;
                padding: 16px;
                gap: 12px;
            }

            .toast-icon {
                flex-shrink: 0;
                width: 20px;
                height: 20px;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 12px;
                font-weight: bold;
                color: white;
            }

            .toast-success .toast-icon {
                background: #10b981;
            }

            .toast-error .toast-icon {
                background: #ef4444;
            }

            .toast-message {
                flex: 1;
                font-size: 14px;
                color: #374151;
                line-height: 1.4;
            }

            .toast-close {
                background: none;
                border: none;
                font-size: 18px;
                color: #9ca3af;
                cursor: pointer;
                padding: 0;
                width: 20px;
                height: 20px;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .toast-close:hover {
                color: #374151;
            }

            /* Animations */
            @keyframes slideInRight {
                from {
                    transform: translateX(100%);
                    opacity: 0;
                }
                to {
                    transform: translateX(0);
                    opacity: 1;
                }
            }

            @keyframes spin {
                to {
                    transform: rotate(360deg);
                }
            }

            /* Mobile responsive */
            @media (max-width: 768px) {
                .toast-notification {
                    left: 20px;
                    right: 20px;
                    min-width: auto;
                    max-width: none;
                }
            }
            </style>
            `;

        // Inject styles into page
        if (!document.querySelector('#save-job-styles')) {
            const styleElement = document.createElement('div');
            styleElement.id = 'save-job-styles';
            styleElement.innerHTML = saveJobStyles;
            document.head.appendChild(styleElement);
        }
    </script>
    <!-- End Cart Area  -->
@endsection
