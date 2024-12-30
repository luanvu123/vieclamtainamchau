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

        <section class="partners">
            <h2>CÁC ĐỐI TÁC</h2>
            <div class="partner-grid">
                @if ($employerIsPartner->count() > 0)
                    @foreach ($employerIsPartner as $partner)
                        <div class="partner-logo">
                            <img src="{{ asset('storage/' . $partner->avatar) }}" alt="{{ $partner->company_name }}"
                                onerror="this.src='{{ asset('frontend/img/company1.png') }}'">
                            <div class="partner-info">
                                <h3>{{ $partner->company_name }}</h3>
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
