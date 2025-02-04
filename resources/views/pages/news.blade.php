@extends('layout')

@section('content')
    <section class="advertisement-container">
        <!-- Left Content -->
        <div class="ad-content">
            <div class="search-container">
                <input type="text" id="newsSearch" class="search-input" placeholder="Tìm kiếm tin tức...">
            </div>
            <div class="news-list">
                @if ($outstandingNews)
                    <div class="news-item">
                        <img src="{{ asset('storage/' . $outstandingNews->image) }}" alt="{{ $outstandingNews->name }}"
                            id="previewImage" class="news-image">
                        <div class="news-text">
                            <h3>
                                <a href="{{ route('news.detail.home', $outstandingNews->id) }}">
                                    {{ $outstandingNews->name }}
                                </a>
                            </h3>
                            <span class="news-date">{{ $outstandingNews->created_at->diffForHumans() }}</span>
                            <div class="news-links">
                                @foreach ($newsList as $news)
                                    <a href="{{ route('news.detail.home', $news->id) }}" class="news-link"
                                        data-image="{{ asset('storage/' . $news->image) }}">
                                        {{ $news->name }}
                                    </a>
                                @endforeach
                            </div>

                            <!-- Pagination -->
                            <div class="pagination-container">
                                {{ $newsList->links() }}
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const previewImage = document.getElementById('previewImage');
                    const defaultImage = previewImage.src;
                    let currentImage = defaultImage;

                    // Store original image URL
                    const originalImageSrc = previewImage.src;

                    // Add hover effect for news links
                    document.querySelectorAll('.news-link').forEach(link => {
                        link.addEventListener('mouseenter', function() {
                            const newImage = this.getAttribute('data-image');
                            if (newImage) {
                                // Save current image before changing
                                currentImage = previewImage.src;

                                // Fade out effect
                                previewImage.style.opacity = '0';

                                setTimeout(() => {
                                    previewImage.src = newImage;
                                    previewImage.style.opacity = '1';
                                }, 300);
                            }
                        });

                        link.addEventListener('mouseleave', function() {
                            // Fade out effect
                            previewImage.style.opacity = '0';

                            setTimeout(() => {
                                // Return to original main news image
                                previewImage.src = originalImageSrc;
                                previewImage.style.opacity = '1';
                            }, 300);
                        });
                    });
                });
            </script>

            <!-- Promotion Section -->
            <div class="category-buttons">
                @php
                    $colors = ['green', 'purple', 'blue'];
                @endphp

                @foreach ($promotion as $key => $promo)
                    <a href="{{ route('news.detail.home', $promo->id) }}"
                        class="category-btn {{ $colors[$key] ?? 'green' }}">
                        {{ $promo->name }}
                    </a>
                @endforeach
            </div>
        </div>

        <!-- Banner News Section -->
        <div class="ad-banners">
            @foreach ($bannerNews as $banner)
                <div class="ad-banner">
                    <a href="{{ $banner->website }}" target="_blank">
                        <img src="{{ asset('storage/' . $banner->image) }}" alt="{{ $banner->name }}">
                    </a>
                </div>
            @endforeach
        </div>
    </section>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Add hover effects to category buttons
            const categoryButtons = document.querySelectorAll('.category-btn');
            categoryButtons.forEach(button => {
                button.addEventListener('mouseenter', function() {
                    this.style.opacity = '0.9';
                    this.style.transform = 'translateY(-2px)';
                    this.style.transition = 'all 0.3s ease';
                });

                button.addEventListener('mouseleave', function() {
                    this.style.opacity = '1';
                    this.style.transform = 'translateY(0)';
                });
            });

            // Add smooth scroll for news links
            const newsLinks = document.querySelectorAll('.news-links a');
            newsLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const href = this.getAttribute('href');
                    if (href !== '#') {
                        window.location.href = href;
                    }
                });
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('newsSearch');
            const newsLinks = document.querySelectorAll('.news-link');

            // Create no results message element
            const noResults = document.createElement('div');
            noResults.className = 'no-results';
            noResults.textContent = 'Không tìm thấy kết quả phù hợp';
            document.querySelector('.news-links').appendChild(noResults);

            function highlightText(text, searchTerm) {
                if (!searchTerm) return text;
                const regex = new RegExp(`(${searchTerm})`, 'gi');
                return text.replace(regex, '<span class="highlight">$1</span>');
            }

            let searchTimeout;

            searchInput.addEventListener('input', function() {
                // Clear previous timeout
                clearTimeout(searchTimeout);

                // Set new timeout for search (debouncing)
                searchTimeout = setTimeout(() => {
                    const searchTerm = this.value.toLowerCase().trim();
                    let hasResults = false;

                    newsLinks.forEach(link => {
                        const newsTitle = link.textContent.toLowerCase();
                        const matches = newsTitle.includes(searchTerm);

                        if (matches) {
                            hasResults = true;
                            link.classList.remove('hidden');
                            // Highlight matching text
                            if (searchTerm) {
                                link.innerHTML = highlightText(link.textContent,
                                    searchTerm);
                            } else {
                                link.textContent = link.textContent; // Reset highlighting
                            }
                        } else {
                            link.classList.add('hidden');
                        }
                    });

                    // Show/hide no results message
                    noResults.style.display = hasResults ? 'none' : 'block';

                }, 300); // 300ms delay for better performance
            });

            // Reset search when clicking outside
            document.addEventListener('click', function(e) {
                if (!e.target.closest('.search-container') && !searchInput.value) {
                    newsLinks.forEach(link => {
                        link.classList.remove('hidden');
                        link.textContent = link.textContent; // Reset highlighting
                    });
                    noResults.style.display = 'none';
                }
            });
        });
    </script>
@endsection
