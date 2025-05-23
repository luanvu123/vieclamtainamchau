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
            <h2><a href="{{ route('genre.show', $genre->slug) }}">{{ $genre->name }}</a></h2>

            <div class="category-grid">
                @foreach ($jobs as $job)
                    <div class="category-card {{ $job->service_type === 'Tin đặc biệt' ? 'hot-effect' : '' }}">
                        <!-- Card content -->

                        @if ($job->employer && $job->employer->avatar)
                            <a href="{{ route('candidate.job.show', $job->slug) }}">
                                <img src="{{ asset('storage/' . $job->employer->avatar) }}" alt="{{ $job->employer->company_name }}"
                                    onerror="this.src='{{ asset('frontend/company1.png') }}'">
                            </a>
                        @else
                            <a href="{{ route('candidate.job.show', $job->slug) }}">
                                <img src="{{ asset('frontend/company1.png') }}" alt="Default Company Logo">
                            </a>
                        @endif

                        <div class="card-content">
                            <h3>
                                <a href="{{ route('candidate.job.show', $job->slug) }}">
                                    {{ Str::limit($job->title, 30) }}
                                </a>
                            </h3>
                            <p title="{{ $job->employer->company_name }}">
                                {{ $job->employer ? Str::limit($job->employer->company_name, 25) : 'Công ty TNHH' }}
                            </p>

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

            <!-- Hiển thị phân trang -->
            <div class="pagination-container">
                {{ $jobs->appends(request()->except('genre_'.$genre->id))->links() }}
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

        .job-categories {
            padding: 2rem;
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

    <!-- End Cart Area  -->
@endsection
