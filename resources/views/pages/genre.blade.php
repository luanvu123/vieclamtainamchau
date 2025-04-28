@extends('layout')
@section('content')
 <section class="hero">
    <div class="search-bar">
        <form action="{{ route('site.search') }}" method="GET">
            <div class="search-input-container">
                <input type="text" name="keyword" id="searchInput" placeholder="Nhập từ khóa tìm kiếm" value="{{ request('keyword') }}" autocomplete="off">
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

    {{-- <section class="stats">
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


    <section class="countries-section">
        <h1>Bài đăng tuyển dụng trong thể loại: {{ $genre->name }}</h1>
        <br>
        <div class="countries-container">
            @foreach ($countries->chunk(8) as $chunk)
                <div class="custom-row">
                    @foreach ($chunk as $country)
                        <div class="country-item" data-country-id="{{ $country->id }}">
                            <a href="javascript:void(0)">
                                <img src="{{ asset('storage/' . $country->image) }}" alt="{{ $country->name }}" class="flag">
                                <span class="country-name">{{ $country->name }}</span>
                            </a>
                        </div>
                    @endforeach
                </div>
            @endforeach

        </div>
    </section> --}}

    <section class="job-categories">
        <!-- Hiển thị tất cả jobs ban đầu -->
        <div class="category-grid all-jobs">
            @if ($genre->jobPostings->count() > 0)
                @foreach ($genre->jobPostings as $job)
                    <div class="category-card {{ $job->service_type == 'Tin đặc biệt' ? 'hot-effect' : '' }}">

                        <!-- Job card content như cũ -->
                        @if ($job->employer && $job->employer->avatar)
                            <a href="{{ route('candidate.job.show', $job->slug) }}">
                                <img src="{{ asset('storage/' . $job->employer->avatar) }}" alt="{{ $job->employer->company_name }}"
                                    onerror="this.src='{{ asset('frontend/img/company1.png') }}'">
                            </a>
                        @else
                            <a href="{{ route('candidate.job.show', $job->slug) }}">
                                <img src="{{ asset('frontend/img/company1.png') }}" alt="Default Company Logo">
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
            @else
                <p>Hiện tại không có bài đăng tuyển dụng nào trong thể loại này.</p>
            @endif
        </div>

        <!-- Container cho jobs theo country -->
        @foreach ($countries as $country)
            <div class="category-grid country-jobs" id="country-{{ $country->id }}" style="display: none;">
                @if ($jobsByCountry->has($country->id) && $jobsByCountry[$country->id]->count() > 0)
                    @foreach ($jobsByCountry[$country->id] as $job)
                        <div class="category-card {{ $job->service_type === 'Tin đặc biệt' ? 'hot-effect' : '' }}">

                            @if ($job->employer && $job->employer->avatar)
                                <a href="{{ route('candidate.job.show', $job->slug) }}">
                                    <img src="{{ asset('storage/' . $job->employer->avatar) }}" alt="{{ $job->employer->company_name }}"
                                        onerror="this.src='{{ asset('frontend/img/company1.png') }}'">
                                </a>
                            @else
                                <a href="{{ route('candidate.job.show', $job->slug) }}">
                                    <img src="{{ asset('frontend/img/company1.png') }}" alt="Default Company Logo">
                                </a>
                            @endif
                            <div class="card-content">
                                <h3>
                                    <a href="{{ route('candidate.job.show', $job->slug) }}">
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
                @else
                    <p>Không có bài đăng tuyển dụng nào tại {{ $country->name }}.</p>
                @endif
            </div>
        @endforeach
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const countryItems = document.querySelectorAll('.country-item');
            const allJobs = document.querySelector('.all-jobs');
            const countryJobs = document.querySelectorAll('.country-jobs');
            let activeCountry = null;

            countryItems.forEach(item => {
                item.addEventListener('click', function () {
                    const countryId = this.dataset.countryId;

                    // Xóa active state từ country item trước đó
                    if (activeCountry) {
                        activeCountry.classList.remove('active');
                    }

                    // Nếu click vào country đang active, show tất cả jobs
                    if (activeCountry === this) {
                        allJobs.style.display = 'grid';
                        countryJobs.forEach(jobs => jobs.style.display = 'none');
                        activeCountry = null;
                        return;
                    }

                    // Active country mới
                    this.classList.add('active');
                    activeCountry = this;

                    // Ẩn tất cả jobs và hiện jobs của country được chọn
                    allJobs.style.display = 'none';
                    countryJobs.forEach(jobs => jobs.style.display = 'none');
                    document.getElementById(`country-${countryId}`).style.display = 'grid';
                });
            });
        });
    </script>
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
