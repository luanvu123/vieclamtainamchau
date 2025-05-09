@extends('layout')

@section('content')
    <section class="job-categories">
        <h1>
            Kết quả tìm kiếm:
            @if (request('keyword'))
                "{{ Str::limit(request('keyword'), 50) }}"
            @endif
            @if (request('category'))
                trong ngành nghề
                "{{ Str::limit($categories->firstWhere('slug', request('category'))->name ?? 'Không xác định', 40) }}"
            @endif
            @if (request('country'))
                tại quốc gia
                "{{ Str::limit($countries->firstWhere('slug', request('country'))->name ?? 'Không xác định', 40) }}"
            @endif
        </h1>
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
                                <p title="{{ $job->employer->company_name }}">
                                    {{ $job->employer ? Str::limit($job->employer->company_name, 25) : 'Công ty TNHH' }}
                                </p>
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
            <p>Không tìm thấy kết quả phù hợp với tiêu chí tìm kiếm.</p>
        @endif
    </section>

@endsection
