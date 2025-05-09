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
    <section class="job-categories">
        @if ($genre->jobPostings->count() > 0)
            <div class="category-grid">
                @foreach ($genre->jobPostings as $job)
                    <div class="category-card {{ $job->service_type == 'Tin đặc biệt' ? 'hot-effect' : '' }}">
                        <!-- Job card content như cũ -->
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
             
        @else
            <p>Hiện tại không có bài đăng tuyển dụng nào trong thể loại này.</p>
        @endif
    </section>

@endsection
