@extends('layout')

@section('content')
    <!-- Section: News -->
    <section class="news-section">
        <div class="news-header">
            <div class="news-tabs">
                <a href="#" class="tab active">Tin Nổi Bật</a>
                <a href="#" class="tab">Việc Làm</a>
                <a href="#" class="tab">Bất Động Sản Úc</a>
                <a href="#" class="tab">Hỏi Đáp</a>
            </div>
            <a href="#" class="view-more">Xem thêm tin tức →</a>
        </div>

        <div class="news-content">
            <div class="main-news">
                <div class="news-item featured">
                    <img src="{{ asset('frontend/img/workers-image.png') }}" alt="Top 10 ngành nghề">
                    <div class="news-details">
                        <h3>10 ngành nghề được tăng lương nhiều nhất năm 2024</h3>
                        <div class="news-meta">
                            <span class="date">26/12/2024</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="news-list">
                <a href="#" class="news-link">10 ngành nghề được tăng lương nhiều nhất năm 2024</a>
                <a href="#" class="news-link">Những ngành nghề được tăng lương nhiều nhất tại Úc</a>
                <a href="#" class="news-link">Nghề lái xe Forklift và cơ hội có thu nhập cao tại Úc</a>
                <a href="#" class="news-link">Tiềm năng nghề massage tại Úc, mức lương của nghề massage là bao
                    nhiêu?</a>
                <a href="#" class="news-link">Tại sao việc làm chạy bàn, phụ bếp chưa bao giờ hết HOT tại Úc</a>
                <a href="#" class="news-link">Làm nail ở Úc: Nghề phổ biến nhất cho các chị em Việt tại xứ sở chuột
                    túi</a>
            </div>
        </div>

        <div class="promotion-cards">
            <div class="promo-card green">
                <h3>Tăng cơ hội tiếp cận khách hàng mùa lễ hội từ quảng cáo</h3>
            </div>
            <div class="promo-card purple">
                <h3>Tìm hiểu về đầu tư Bất Động Sản cho công dân Việt Nam tại Úc</h3>
            </div>
            <div class="promo-card blue">
                <h3>Social Media Marketing – Chia Khóa Thành Công Của Doanh Nghiệp Thời Đại Số</h3>
            </div>
        </div>
    </section>

    <style>
        .news-section {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .news-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .news-tabs {
            display: flex;
            gap: 20px;
        }

        .tab {
            text-decoration: none;
            color: #333;
            padding: 5px 0;
        }

        .tab.active {
            color: #28a745;
            border-bottom: 2px solid #28a745;
        }

        .view-more {
            color: #007bff;
            text-decoration: none;
        }

        .news-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }

        .main-news {
            position: relative;
        }

        .news-item.featured {
            position: relative;
            height: 100%;
        }

        .news-item.featured img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 8px;
        }

        .news-details {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 20px;
            background: linear-gradient(transparent, rgba(0, 0, 0, 0.8));
            color: white;
            border-radius: 0 0 8px 8px;
        }

        .news-list {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .news-link {
            text-decoration: none;
            color: #333;
            padding: 10px;
            border-bottom: 1px solid #eee;
        }

        .news-link:hover {
            color: #28a745;
        }

        .promotion-cards {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .promo-card {
            padding: 20px;
            border-radius: 8px;
            color: white;
            min-height: 100px;
            display: flex;
            align-items: center;
        }

        .promo-card.green {
            background-color: #28a745;
        }

        .promo-card.purple {
            background-color: #6f42c1;
        }

        .promo-card.blue {
            background-color: #007bff;
        }

        .promo-card h3 {
            margin: 0;
            font-size: 16px;
        }

        @media (max-width: 768px) {
            .news-content {
                grid-template-columns: 1fr;
            }

            .promotion-cards {
                grid-template-columns: 1fr;
            }

            .news-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }

            .news-tabs {
                overflow-x: auto;
                width: 100%;
                padding-bottom: 10px;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Tab switching functionality
            const tabs = document.querySelectorAll('.tab');
            tabs.forEach(tab => {
                tab.addEventListener('click', (e) => {
                    e.preventDefault();
                    tabs.forEach(t => t.classList.remove('active'));
                    tab.classList.add('active');
                });
            });
        });
    </script>
@endsection
