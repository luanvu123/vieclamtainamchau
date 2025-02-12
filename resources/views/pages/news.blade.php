@extends('layout')

@section('content')
    <section class="advertisement-container">
        <!-- Left Content -->
        <div class="ad-content">
            <div class="search-container">
                <input type="text" id="newsSearch" class="search-input" placeholder="Tìm kiếm tin tức...">
            </div>
            <!-- Promotion Section -->
            <div class="category-buttons">
                <!-- Promotion Section -->
                <div class="promotion-section">
                    <div class="promotion-list">
                        @foreach ($promotion as $promo)
                            <div class="promotion-card">
                                <div class="promotion-image">
                                    <img src="{{ asset('storage/' . $promo->image) }}" alt="{{ $promo->name }}">
                                </div>
                                <div class="promotion-content">
                                    <h3 class="promotion-title">
                                        <a href="{{ route('news.detail.home', $promo->id) }}">
                                            {{ $promo->name }}
                                        </a>
                                    </h3>
                                    <div class="promotion-details">
                                        <div class="promotion-location">
                                            <i class="fas fa-map-marker-alt"></i>
                                            {{ $promo->website ?? 'Website' }}
                                        </div>
                                        <div class="promotion-time">
                                            <i class="far fa-clock"></i>
                                            {{ $promo->created_at->diffForHumans() }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="pagination-container">
                        <ul class="pagination">
                            @for ($i = 1; $i <= $promotion->lastPage(); $i++)
                                <li class="page-item {{ $i == $promotion->currentPage() ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $promotion->url($i) }}">{{ $i }}</a>
                                </li>
                            @endfor
                        </ul>
                    </div>
                </div>
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
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        const searchInput = document.getElementById("newsSearch");
        const promotionCards = document.querySelectorAll(".promotion-card");

        searchInput.addEventListener("input", function () {
            const searchTerm = this.value.trim().toLowerCase();

            promotionCards.forEach(card => {
                const title = card.querySelector(".promotion-title a").textContent.trim().toLowerCase();

                if (title.includes(searchTerm) || searchTerm === "") {
                    card.style.display = "block"; // Hiển thị nếu tìm thấy từ khóa
                } else {
                    card.style.display = "none"; // Ẩn nếu không khớp
                }
            });
        });
    });
</script>

@endsection
