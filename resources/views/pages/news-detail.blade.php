{{-- resources/views/pages/news-detail.blade.php --}}
@extends('layout')
@section('content')
    <section class="new-detail">
        <div class="container">
            <div class="row">
                <!-- Left Content - News Detail -->
                <div class="news-content">
                    <div class="news-header">
                        <h1 class="news-title">{{ $news->name }}</h1>
                        <div class="news-meta">
                            <span class="news-date">
                                <i class="far fa-calendar"></i>
                                {{ $news->created_at->format('d/m/Y H:i') }}
                            </span>
                        </div>
                    </div>

                    @if ($news->image)
                        <div class="news-feature-image">
                            <img src="{{ asset('storage/' . $news->image) }}" alt="{{ $news->name }}">
                        </div>
                    @endif

                    <div class="news-body">
                        {!! $news->description !!}
                    </div>

                    @if ($news->website)
                        <div class="news-source">
                            <a href="{{ $news->website }}" target="_blank" class="source-link">
                                Nguồn bài viết <i class="fas fa-external-link-alt"></i>
                            </a>
                        </div>
                    @endif

                    <!-- Related News -->
                    @if ($relatedNews->count() > 0)
                        <div class="related-news">
                            <h3>Tin tức liên quan</h3>
                            <ul>
                                @foreach ($relatedNews as $related)
                                    <li>
                                        <a href="{{ route('news.detail.home', $related->id) }}">
                                            {{ $related->name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>

                <!-- Right Sidebar - Banner Ads -->
                <div class="sidebar-ads">
                    @foreach ($bannerNews as $banner)
                        <div class="sidebar-ad-item">
                            <a href="{{ $banner->website }}" target="_blank">
                                <img src="{{ asset('storage/' . $banner->image) }}" alt="{{ $banner->name }}">
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <style>
        .new-detail {
            padding: 2rem 0;
            background: #f8f9fa;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
        }

        .row {
            display: flex;
            gap: 2rem;
        }

        /* Left Content Styles */
        .news-content {
            flex: 1;
            background: #fff;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .news-header {
            margin-bottom: 2rem;
        }

        .news-title {
            font-size: 2rem;
            color: #333;
            margin-bottom: 1rem;
        }

        .news-meta {
            color: #666;
            font-size: 0.9rem;
        }

        .news-feature-image {
            margin-bottom: 2rem;
        }

        .news-feature-image img {
            width: 100%;
            height: auto;
            border-radius: 8px;
        }

        .news-body {
            line-height: 1.8;
            color: #444;
            font-size: 1.1rem;
            margin-bottom: 2rem;
        }

        .news-source {
            padding-top: 1rem;
            border-top: 1px solid #eee;
        }

        .source-link {
            color: #007bff;
            text-decoration: none;
        }

        .source-link:hover {
            text-decoration: underline;
        }

        /* Related News Styles */
        .related-news {
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 1px solid #eee;
        }

        .related-news h3 {
            margin-bottom: 1rem;
            color: #333;
        }

        .related-news ul {
            list-style: none;
            padding: 0;
        }

        .related-news li {
            margin-bottom: 0.8rem;
        }

        .related-news a {
            color: #444;
            text-decoration: none;
            transition: color 0.3s;
        }

        .related-news a:hover {
            color: #ff0000;
        }

        /* Right Sidebar Styles */
        .sidebar-ads {
            width: 300px;
        }

        .sidebar-ad-item {
            margin-bottom: 1rem;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .sidebar-ad-item img {
            width: 100%;
            height: auto;
            display: block;
            transition: transform 0.3s;
        }

        .sidebar-ad-item:hover img {
            transform: scale(1.02);
        }

        /* Responsive Design */
        @media (max-width: 992px) {
            .row {
                flex-direction: column;
            }

            .sidebar-ads {
                width: 100%;
                display: flex;
                flex-wrap: wrap;
                gap: 1rem;
            }

            .sidebar-ad-item {
                flex: 1;
                min-width: 300px;
            }
        }

        @media (max-width: 768px) {
            .news-title {
                font-size: 1.5rem;
            }

            .news-content {
                padding: 1rem;
            }
        }
    </style>

@endsection
