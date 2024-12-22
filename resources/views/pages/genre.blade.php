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
