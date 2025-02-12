@extends('layout')

@section('content')
<div class="language-training-detail">
    <div class="breadcrumb">
        <a href="{{ route('site.language-training') }}">Đơn vị đào tạo ngôn ngữ</a>
        <span> / </span>
        <span>{{ $languageTraining->name }}</span>
    </div>

    <h1>{{ $languageTraining->name }}</h1>

    <div class="description">
        {!! $languageTraining->description !!}
    </div>

    @if($relatedTrainings->count() > 0)
        <div class="related-section">
            <h2>Các đơn vị đào tạo khác</h2>
            <div class="related-grid">
                @foreach($relatedTrainings as $training)
                    <a href="{{ route('site.language-training.detail', $training->slug) }}"
                       class="related-card">
                        <h3>{{ $training->name }}</h3>
                        <p>{{ Str::limit($training->description, 100) }}</p>
                    </a>
                @endforeach
            </div>
        </div>
    @endif
</div>

<style>
.language-training-detail {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
}

.breadcrumb {
    margin-bottom: 20px;
}

.breadcrumb a {
    color: #007bff;
    text-decoration: none;
}

.description {
    line-height: 1.6;
    margin: 20px 0;
}

.related-section {
    margin-top: 40px;
    padding-top: 20px;
    border-top: 1px solid #eee;
}

.related-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 20px;
    margin-top: 20px;
}

.related-card {
    background: #fff;
    padding: 15px;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    text-decoration: none;
    color: inherit;
    transition: transform 0.3s ease;
}

.related-card:hover {
    transform: translateY(-5px);
}
</style>
@endsection
