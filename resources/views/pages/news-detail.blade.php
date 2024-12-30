<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $news->name }} - Nghề & Nghiệp</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        /* Reset CSS */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f5f5f5;
            color: #333;
        }

        /* Container */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        /* Article */
        .article {
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-bottom: 40px;
        }

        .article-header {
            padding: 30px;
        }

        .article-title {
            font-size: 32px;
            margin-bottom: 20px;
            color: #1a1a1a;
        }

        .article-meta {
            display: flex;
            align-items: center;
            gap: 20px;
            color: #666;
            font-size: 14px;
            margin-bottom: 20px;
        }

        .article-image {
            width: 100%;
            max-height: 500px;
            object-fit: cover;
        }

        .article-content {
            padding: 30px;
            font-size: 16px;
            line-height: 1.8;
        }

        /* Related News */
        .related-news {
            margin-top: 40px;
        }

        .related-news h2 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #333;
            border-left: 4px solid #2563eb;
            padding-left: 10px;
        }

        .related-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
        }

        .related-card {
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }

        .related-card:hover {
            transform: translateY(-5px);
        }

        .related-image {
            width: 100%;
            height: 180px;
            object-fit: cover;
        }

        .related-content {
            padding: 20px;
        }

        .related-title {
            font-size: 16px;
            color: #1a1a1a;
            text-decoration: none;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            margin-bottom: 10px;
        }

        .related-title:hover {
            color: #2563eb;
        }

        /* Back to top button */
        .back-to-top {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: #2563eb;
            color: white;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            opacity: 0;
            transition: opacity 0.3s ease;
            box-shadow: 0 2px 4px rgba(0,0,0,0.2);
        }

        .back-to-top.visible {
            opacity: 1;
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .related-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .container {
                padding: 15px;
            }

            .article-header {
                padding: 20px;
            }

            .article-title {
                font-size: 24px;
            }

            .article-content {
                padding: 20px;
            }

            .related-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <article class="article">
            @if($news->image)
            <img src="{{ asset('storage/' .$news->image) }}" alt="{{ $news->name }}" class="article-image">
            @endif

            <header class="article-header">
                <h1 class="article-title">{{ $news->name }}</h1>
                <div class="article-meta">
                    <span>
                        <i class="far fa-calendar"></i>
                        {{ $news->created_at->format('d/m/Y') }}
                    </span>
                    @if($news->website)
                    <a href="{{ $news->website }}" class="news-source" target="_blank">
                        <i class="fas fa-external-link-alt"></i> Nguồn
                    </a>
                    @endif
                </div>
            </header>

            <div class="article-content">
                {!! $news->description !!}
            </div>
        </article>

        @if($relatedNews->count() > 0)
        <section class="related-news">
            <h2>Tin Tức Liên Quan</h2>
            <div class="related-grid">
                @foreach($relatedNews as $related)
                <article class="related-card">
                    @if($related->image)
                    <img src="{{ asset('storage/' .$related->image) }}" alt="{{ $related->name }}" class="related-image">
                    @endif
                    <div class="related-content">
                        <a href="{{ route('news.detail.home', $related->id) }}" class="related-title">
                            {{ $related->name }}
                        </a>
                        <div class="news-meta">
                            <span class="news-date">
                                <i class="far fa-calendar"></i>
                                {{ $related->created_at->format('d/m/Y') }}
                            </span>
                        </div>
                    </div>
                </article>
                @endforeach
            </div>
        </section>
        @endif
    </div>

    <a href="#" class="back-to-top" id="backToTop">
        <i class="fas fa-arrow-up"></i>
    </a>

    <script>
        // Back to top button functionality
        const backToTopButton = document.getElementById('backToTop');

        window.addEventListener('scroll', () => {
            if (window.pageYOffset > 300) {
                backToTopButton.classList.add('visible');
            } else {
                backToTopButton.classList.remove('visible');
            }
        });

        backToTopButton.addEventListener('click', (e) => {
            e.preventDefault();
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        // Lazy loading for images
        document.addEventListener('DOMContentLoaded', function() {
            const lazyImages = [].slice.call(document.querySelectorAll('img[data-src]'));

            if ('IntersectionObserver' in window) {
                const lazyImageObserver = new IntersectionObserver(function(entries, observer) {
                    entries.forEach(function(entry) {
                        if (entry.isIntersecting) {
                            const lazyImage = entry.target;
                            lazyImage.src = lazyImage.dataset.src;
                            lazyImage.classList.remove('lazy');
                            lazyImageObserver.unobserve(lazyImage);
                        }
                    });
                });

                lazyImages.forEach(function(lazyImage) {
                    lazyImageObserver.observe(lazyImage);
                });
            }
        });

        // Handle external links
        document.querySelectorAll('a[href^="http"]').forEach(link => {
            link.setAttribute('target', '_blank');
            link.setAttribute('rel', 'noopener noreferrer');
        });

        // Add smooth scroll behavior to all internal links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Add reading time estimate
        document.addEventListener('DOMContentLoaded', function() {
            const article = document.querySelector('.article-content');
            if (article) {
                const words = article.textContent.trim().split(/\s+/).length;
                const readingTime = Math.ceil(words / 200); // Assuming 200 words per minute
                const readingTimeElement = document.createElement('span');
                readingTimeElement.innerHTML = `<i class="far fa-clock"></i> ${readingTime} phút đọc`;
                document.querySelector('.article-meta').appendChild(readingTimeElement);
            }
        });
    </script>
</body>
</html>






