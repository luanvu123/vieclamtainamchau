<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tin tức - Nghề & Nghiệp</title>
    <meta name="description" content="Cập nhật tin tức mới nhất về nghề nghiệp, việc làm và phát triển sự nghiệp">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #2563eb;
            --text-color: #333;
            --gray-color: #666;
            --light-gray: #f5f5f5;
            --border-radius: 8px;
            --box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', system-ui, sans-serif;
            line-height: 1.6;
            background-color: var(--light-gray);
            color: var(--text-color);
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }

        /* Hero Section */
        .hero {
            background-color: white;
            padding: 2rem;
            border-radius: var(--border-radius);
            margin-bottom: 2rem;
            box-shadow: var(--box-shadow);
        }

        .hero h1 {
            font-size: 2rem;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }

        .hero p {
            color: var(--gray-color);
            max-width: 800px;
        }

        /* Featured News */
        .featured-news {
            margin-bottom: 3rem;
        }

        .section-title {
            font-size: 1.5rem;
            margin-bottom: 1.5rem;
            padding-left: 1rem;
            border-left: 4px solid var(--primary-color);
        }

        .featured-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
        }

        /* News Card */
        .news-card {
            background: white;
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: var(--box-shadow);
            transition: transform 0.3s ease;
        }

        .news-card:hover {
            transform: translateY(-5px);
        }

        .news-image-container {
            position: relative;
            padding-top: 60%;
            overflow: hidden;
        }

        .news-image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .news-card:hover .news-image {
            transform: scale(1.05);
        }

        .news-content {
            padding: 1.5rem;
        }

        .news-tag {
            display: inline-block;
            background-color: var(--primary-color);
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.875rem;
            margin-bottom: 1rem;
        }

        .news-title {
            font-size: 1.25rem;
            color: var(--text-color);
            text-decoration: none;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            margin-bottom: 0.75rem;
            line-height: 1.4;
        }

        .news-title:hover {
            color: var(--primary-color);
        }

        .news-description {
            color: var(--gray-color);
            font-size: 0.875rem;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            margin-bottom: 1rem;
        }

        .news-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.875rem;
            color: var(--gray-color);
        }

        .news-date {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .news-source {
            color: var(--primary-color);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .news-source:hover {
            text-decoration: underline;
        }

        /* Regular News Grid */
        .news-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        /* Pagination */
        .pagination {
            display: flex;
            justify-content: center;
            gap: 0.5rem;
            margin-top: 2rem;
        }

        .page-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 2.5rem;
            height: 2.5rem;
            padding: 0 0.75rem;
            border: 1px solid #ddd;
            border-radius: var(--border-radius);
            color: var(--text-color);
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .page-link:hover {
            background-color: var(--light-gray);
        }

        .page-link.active {
            background-color: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .container {
                padding: 1rem;
            }

            .hero {
                padding: 1.5rem;
            }

            .hero h1 {
                font-size: 1.5rem;
            }

            .section-title {
                font-size: 1.25rem;
            }

            .featured-grid,
            .news-grid {
                grid-template-columns: 1fr;
            }

            .news-card {
                max-width: 100%;
            }
        }
    </style>
</head>
<body>
    <main class="container">
        <section class="hero">
            <h1>Tin Tức & Cập Nhật</h1>
            <p>Khám phá những tin tức mới nhất về nghề nghiệp, việc làm và phát triển sự nghiệp. Cập nhật xu hướng và cơ hội mới trong thị trường lao động.</p>
        </section>

        @if($outstandingNews->count() > 0)
        <section class="featured-news">
            <h2 class="section-title">Tin Tức Nổi Bật</h2>
            <div class="featured-grid">
                @foreach($outstandingNews as $featured)
                <article class="news-card">
                    <div class="news-image-container">
                        @if($featured->image)
                        <img
                            src="{{ asset('storage/' .$featured->image) }}"
                            alt="{{ $featured->name }}"
                            class="news-image"
                            loading="lazy"
                        >
                        @endif
                    </div>
                    <div class="news-content">
                        <span class="news-tag">Nổi bật</span>
                        <a href="{{ route('news.detail.home', $featured->id) }}" class="news-title">
                            {{ $featured->name }}
                        </a>
                        <p class="news-description">
                            {{ Str::limit(strip_tags($featured->description), 150) }}
                        </p>
                        <div class="news-meta">
                            <span class="news-date">
                                <i class="far fa-calendar"></i>
                                {{ $featured->created_at->format('d/m/Y') }}
                            </span>
                            @if($featured->website)
                            <a href="{{ $featured->website }}" class="news-source" target="_blank">
                                <i class="fas fa-external-link-alt"></i>
                                <span>Xem nguồn</span>
                            </a>
                            @endif
                        </div>
                    </div>
                </article>
                @endforeach
            </div>
        </section>
        @endif

        <section>
            <h2 class="section-title">Tất Cả Tin Tức</h2>
            <div class="news-grid">
                @foreach($news as $item)
                <article class="news-card">
                    <div class="news-image-container">
                        @if($item->image)
                        <img
                            src="{{ asset('storage/' .$item->image) }}"
                            alt="{{ $item->name }}"
                            class="news-image"
                            loading="lazy"
                        >
                        @endif
                    </div>
                    <div class="news-content">
                        <a href="{{ route('news.detail.home', $item->id) }}" class="news-title">
                            {{ $item->name }}
                        </a>
                        <p class="news-description">
                            {{ Str::limit(strip_tags($item->description), 150) }}
                        </p>
                        <div class="news-meta">
                            <span class="news-date">
                                <i class="far fa-calendar"></i>
                                {{ $item->created_at->format('d/m/Y') }}
                            </span>
                            @if($item->website)
                            <a href="{{ $item->website }}" class="news-source" target="_blank">
                                <i class="fas fa-external-link-alt"></i>
                                <span>Xem nguồn</span>
                            </a>
                            @endif
                        </div>
                    </div>
                </article>
                @endforeach
            </div>

            <div class="pagination">
                {{ $news->links() }}
            </div>
        </section>
    </main>

    <script>
        // Handle smooth scrolling
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });

        // Handle external links
        document.querySelectorAll('a[href^="http"]').forEach(link => {
            if (!link.hasAttribute('target')) {
                link.setAttribute('target', '_blank');
                link.setAttribute('rel', 'noopener noreferrer');
            }
        });

        // Optional: Add animation on scroll
        const observerOptions = {
            root: null,
            rootMargin: '0px',
            threshold: 0.1
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        document.querySelectorAll('.news-card').forEach(card => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            card.style.transition = 'all 0.5s ease-out';
            observer.observe(card);
        });
    </script>
</body>
</html>
