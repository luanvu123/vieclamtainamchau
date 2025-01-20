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




    <section class="job-categories">
        @if ($jobPostings->count() > 0)
            <div class="category-grid">
                @foreach ($jobPostings as $job)
                    <div class="category-card {{ $job->employer && $job->employer->IsHoteffect ? 'hot-effect' : '' }}">
                        @if ($job->employer && $job->employer->avatar)
                            <img src="{{ asset('storage/' . $job->employer->avatar) }}"
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
                    </div>
                @endforeach
            </div>

            {{-- Thêm phân trang --}}
            <div class="pagination-container mt-4">
                {{ $jobPostings->links() }}
            </div>
        @else
            <p>Hiện tại không có bài đăng tuyển dụng nào trong danh mục này.</p>
        @endif
    </section>
@endsection
