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
                    <option value="">Nhập thị trường</option>
                    @foreach ($countries as $country)
                        <option value="{{ $country->slug }}" {{ request('country') == $country->slug ? 'selected' : '' }}>
                            {{ $country->name }}
                        </option>
                    @endforeach
                </select>
                <button class="search-btn" type="submit">Tìm kiếm</button>
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
        <h1>Công việc trong danh mục: {{ $category->name }}</h1>

        @if ($category->jobPostings->count() > 0)
            <div class="category-grid">
                @foreach ($category->jobPostings as $job)
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
            <p>Hiện tại không có bài đăng tuyển dụng nào trong danh mục này.</p>
        @endif
    </section>
@endsection
