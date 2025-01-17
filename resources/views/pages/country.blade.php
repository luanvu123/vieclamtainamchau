@extends('layout')
@section('content')

    <section class="job-categories">
    <h1>Việc làm tại quốc gia: {{ $country->name }}</h1>
    @if ($jobPostings->count() > 0)
        <div class="category-grid">
            @foreach ($jobPostings as $job)
                <a href="{{ route('job.show', $job->slug) }}" class="category-card-link">
                    <div class="category-card {{ $job->employer && $job->employer->IsHoteffect ? 'hot-effect' : '' }}">
                        @if ($job->employer && $job->employer->avatar)
                            <img src="{{ asset('storage/' . $job->employer->avatar) }}"
                                alt="{{ $job->employer->company_name }}"
                                onerror="this.src='{{ asset('frontend/img/company1.png') }}'">
                        @else
                            <img src="{{ asset('frontend/img/company1.png') }}" alt="Default Company Logo">
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
    @else
        <p>Hiện tại không có bài đăng tuyển dụng nào tại {{ $country->name }}.</p>
    @endif
</section>
@endsection
