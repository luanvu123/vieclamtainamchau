@extends('layout')
@section('content')
    <section class="hero">
        <div class="search-bar">
            <form action="{{ route('site.search') }}" method="GET">
                <input type="text" name="keyword" placeholder="Nhập từ khóa tìm kiếm" value="{{ request('keyword') }}">
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
        @if ($jobPostings->count() > 0)
            <div class="category-grid">
                @foreach ($jobPostings as $job)
                    <a href="{{ route('candidate.job.show', $job->slug) }}" class="category-card-link">
                        <div class="category-card {{ $job->service_type === 'Tin đặc biệt' ? 'hot-effect' : '' }}">

                            @if ($job->employer && $job->employer->avatar)
                                <img src="{{ asset('storage/' . $job->employer->avatar) }}" alt="{{ $job->employer->company_name }}"
                                    onerror="this.src='{{ asset('frontend/company1.png') }}'">
                            @else
                                <img src="{{ asset('frontend/company1.png') }}" alt="Default Company Logo">
                            @endif
                            <div class="card-content">
                                <h3>{{ Str::limit($job->title, 15) }}</h3>
                                <p>{{ Str::limit($job->employer->company_name ?? 'Công ty TNHH', 40) }}</p>
                                <p>Địa điểm: {{ Str::limit($job->location ?? 'Không xác định', 30) }}</p>
                                <p>Lương: {{ Str::limit($job->salary ?? 'Thỏa thuận', 30) }}</p>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
            <div class="pagination-container mt-4">
                {{ $jobPostings->links() }}
            </div>
        @else
            <p>Hiện tại không có bài đăng tuyển dụng nào trong ngành nghề này.</p>
        @endif
    </section>
@endsection
