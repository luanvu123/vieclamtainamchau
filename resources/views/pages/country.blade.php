@extends('layout')
@section('content')

    <section class="job-categories">
        <h1>Việc làm tại quốc gia: {{ $country->name }}</h1>

        @if ($jobPostings->count() > 0)
            <div class="category-grid">
                @foreach ($jobPostings as $job)
                    <div class="category-card {{ $job->employer && $job->employer->IsHoteffect ? 'hot-effect' : '' }}">
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
                            <h3>{{ $job->title }}</h3>
                            <p>{{ $job->employer->company_name ?? 'Công ty TNHH' }}</p>
                            <p>Địa điểm: {{ $job->location ?? 'Không xác định' }}</p>
                            <p>Lương: {{ $job->salary ?? 'Thỏa thuận' }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p>Hiện tại không có bài đăng tuyển dụng nào tại {{ $country->name }}.</p>
        @endif
    </section>
@endsection
