@extends('layout')

@section('content')
<style>
    .study-detail {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }

    /* Breadcrumb styles */
    .breadcrumb {
        margin-bottom: 20px;
    }

    .breadcrumb a {
        color: #007bff;
        text-decoration: none;
    }

    .breadcrumb a:hover {
        text-decoration: underline;
    }

    /* Header section styles */
    .study-header {
        margin-bottom: 30px;
    }

    .study-header h1 {
        font-size: 2.5em;
        margin-bottom: 20px;
    }

    .study-image {
        width: 100%;
        max-height: 500px;
        object-fit: cover;
        border-radius: 8px;
        margin-bottom: 30px;
    }

    /* Meta information styles */
    .study-meta {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 8px;
        margin-bottom: 30px;
    }

    .meta-section {
        margin-bottom: 15px;
    }

    .meta-section h3 {
        font-weight: bold;
        margin-bottom: 10px;
    }

    /* Tag styles */
    .tag {
        display: inline-block;
        padding: 5px 15px;
        margin: 5px;
        border-radius: 20px;
        font-size: 14px;
    }

    .country-tag {
        background: #e3f2fd;
        color: #1976d2;
    }

    .category-tag {
        background: #e8f5e9;
        color: #2e7d32;
    }

    /* Description styles */
    .description-section {
        background: #fff8e1;
        padding: 20px;
        border-radius: 8px;
        margin-bottom: 30px;
        border-left: 4px solid #ffd54f;
    }

    .description-section h3 {
        color: #f57f17;
        font-size: 1.3em;
        margin-bottom: 15px;
    }

    .description-content {
        line-height: 1.6;
        color: #5d4037;
    }

    /* Main content styles */
    .study-content {
        line-height: 1.6;
        margin-bottom: 40px;
    }

    /* Related studies styles */
    .related-studies {
        margin-top: 40px;
        padding-top: 40px;
        border-top: 1px solid #dee2e6;
    }

    .related-studies h2 {
        font-size: 1.8em;
        margin-bottom: 20px;
    }

    .related-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 20px;
    }

    .related-card {
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        overflow: hidden;
        transition: transform 0.3s ease;
    }

    .related-card:hover {
        transform: translateY(-5px);
    }

    .related-card img {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }

    .related-card-content {
        padding: 15px;
    }

    .related-card h3 {
        font-size: 1.2em;
        margin-bottom: 10px;
    }

    .related-card p {
        color: #6c757d;
        font-size: 0.9em;
    }
</style>

<section class="study-programs">
    <div class="study-detail">
        <!-- Breadcrumb -->
        <div class="breadcrumb">
            <a href="{{ route('site.study-abroad') }}">Du học nghề</a>
            <span> / </span>
            <span>{{ $study->name }}</span>
        </div>

        <!-- Header Section -->
        <div class="study-header">
            <h1>{{ $study->name }}</h1>
            <img src="{{ asset('storage/' . $study->image) }}"
                 alt="{{ $study->name }}"
                 class="study-image"
                 onerror="this.src='{{ asset('frontend/img/default-image.png') }}'">
        </div>

        <!-- Meta Information -->
        <div class="study-meta">
            <div class="meta-section">
                <h3>Quốc gia:</h3>
                @foreach($study->countries as $country)
                    <span class="tag country-tag">{{ $country->name }}</span>
                @endforeach
            </div>
            <div class="meta-section">
                <h3>Ngành nghề:</h3>
                @foreach($study->categories as $category)
                    <span class="tag category-tag">{{ $category->name }}</span>
                @endforeach
            </div>
        </div>

        <!-- Description Section -->
        <div class="description-section">
            <h3>Tổng quan chương trình</h3>
            <div class="description-content">
                {!! $study->description !!}
            </div>
        </div>

        <!-- Main Content -->
        <div class="study-content">
            {!! $study->detail !!}
        </div>

        <!-- Related Studies -->
        @if($relatedStudies->count() > 0)
            <div class="related-studies">
                <h2>Chương trình liên quan</h2>
                <div class="related-grid">
                    @foreach($relatedStudies as $relatedStudy)
                        <a href="{{ route('study-abroad.show', $relatedStudy->slug) }}" class="related-card">
                            <img src="{{ asset('storage/' . $relatedStudy->image) }}"
                                 alt="{{ $relatedStudy->name }}"
                                 onerror="this.src='{{ asset('frontend/img/default-image.png') }}'">
                            <div class="related-card-content">
                                <h3>{{ Str::limit($relatedStudy->name, 40) }}</h3>
                                <p>{{ Str::limit($relatedStudy->short_detail, 100) }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</section>
@endsection
