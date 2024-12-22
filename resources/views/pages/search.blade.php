@extends('layout')

@section('content')
<section class="job-categories">
    <h1>
        Kết quả tìm kiếm:
        @if (request('keyword'))
            "{{ request('keyword') }}"
        @endif

        @if (request('category'))
            trong danh mục "{{ $categories->firstWhere('slug', request('category'))->name ?? 'Không xác định' }}"
        @endif

        @if (request('country'))
            tại quốc gia "{{ $countries->firstWhere('slug', request('country'))->name ?? 'Không xác định' }}"
        @endif
    </h1>

    @if ($jobPostings->count() > 0)
        <div class="category-grid">
            @foreach ($jobPostings as $job)
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
        <p>Không tìm thấy kết quả phù hợp với tiêu chí tìm kiếm.</p>
    @endif
</section>

@endsection
