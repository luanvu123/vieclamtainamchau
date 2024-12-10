<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Portal</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        /* Header */
        .header-top {
            background-image: url('{{ asset('frontend/img/hochiminhcity.png') }}');
            background-size: cover;
            /* Ảnh bao phủ toàn bộ khối */
            background-position: center;
            /* Căn giữa ảnh */
            background-repeat: no-repeat;
            /* Không lặp lại ảnh */
            padding: 60px;
            /* Khoảng cách bên trong */
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-radius: 8px;
            /* Bo tròn góc (nếu cần) */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            /* Tạo bóng */
            color: white;
            /* Màu chữ nếu cần nổi bật */
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .logo img {
            width: 50px;
            height: 50px;
            object-fit: contain;
        }

        .logo h1 {
            font-size: 1.5rem;
            color: #ffffff;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 2rem;
        }

        .your-location {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .your-location i {
            color: #ff0000;
        }

        .location-select {
            border: none;
            outline: none;
            color: #ffffff;
            font-size: 0.9rem;
            background: transparent;
            cursor: pointer;
        }

        .auth-section {
            display: flex;
            gap: 2rem;
        }

        .auth-group {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.5rem;
        }

        .auth-label {
            font-size: 0.9rem;
            color: #ffffff;
            font-weight: 500;
        }

        .auth-buttons {
            display: flex;
            gap: 0.5rem;
        }

        .auth-btn {
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 0.9rem;
            transition: all 0.2s;
        }

        .auth-btn.login {
            background: #fff;
            border: 1px solid #ff0000;
            color: #ff0000;
        }

        .auth-btn.register {
            background: #ff0000;
            color: white;
        }

        .auth-btn:hover {
            opacity: 0.9;
            transform: translateY(-1px);
        }

        @media (max-width: 1200px) {
            .header-actions {
                flex-direction: column;
                gap: 1rem;
            }

            .keywords-container {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        /* Navigation */
        .nav {
            background: #ff0000;
            padding: 1rem 0;
        }

        .nav ul {
            display: flex;
            list-style: none;
            justify-content: center;
            gap: 2rem;
        }

        .nav a {
            color: white;
            text-decoration: none;
        }

        /* Hero Section */
        .hero {
            background-image: url('{{ asset('frontend/img/we-are-hiring-digital-collage.jpg') }}');
            background-size: cover;
            background-position: center;
            height: 100vh;
            /* Chiều cao toàn màn hình */
            position: relative;
        }

        .search-bar {
            position: absolute;
            bottom: 30px;
            /* Cách đáy ảnh 30px, điều chỉnh theo ý bạn */
            left: 50%;
            transform: translateX(-50%);
            /* Căn giữa theo chiều ngang */
            background: rgba(255, 255, 255, 0.9);
            /* Làm nổi bật khung tìm kiếm */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            display: flex;
            gap: 10px;
        }

        .search-bar input {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            flex: 1;
            /* Để các ô input có kích thước đồng đều */
        }

        .search-bar .search-btn {
            background: #c21a33;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .search-bar .search-btn:hover {
            background: #0056b3;
        }

        /* Stats Section */
        .stats {
            display: flex;
            justify-content: center;
            gap: 2rem;
            padding: 2rem;
            flex-wrap: wrap;
        }

        .stat-item {
            text-align: center;
            width: 100px;
        }

        .stat-item img {
            width: 40px;
            height: 40px;
            margin-bottom: 0.5rem;
        }

        /* Job Categories */
        .job-categories {
            padding: 2rem;
            background: #f5f5f5;
        }

        .category-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1rem;
            margin-top: 2rem;
        }

        .category-card {
            background: white;
            padding: 1rem;
            border-radius: 8px;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .category-card img {
            width: 50px;
            height: 50px;
        }

        /* Partners Section */
        .partners {
            padding: 2rem;
            text-align: center;
        }

        .partner-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }

        .partner-logo {
            background: white;
            padding: 1rem;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .partner-logo img {
            max-width: 100px;
        }

        .keywords-section {
            padding: 3rem 2rem;
            background: #f8f9fa;
        }

        .keywords-section h2 {
            text-align: center;
            margin-bottom: 2rem;
            color: #333;
            font-size: 1.5rem;
        }

        .keywords-container {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .keyword-column {
            background: white;
            padding: 1.5rem;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .keyword-column h3 {
            color: #ff0000;
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #ff0000;
            font-size: 1.1rem;
        }

        .keyword-list {
            list-style: none;
            padding: 0;
        }

        .keyword-list li {
            padding: 0.5rem 0;
            border-bottom: 1px solid #eee;
            color: #666;
            transition: all 0.2s;
            cursor: pointer;
        }

        .keyword-list li:last-child {
            border-bottom: none;
        }

        .keyword-list li:hover {
            color: #ff0000;
            padding-left: 0.5rem;
        }

        /* Footer */
        .footer {
            background: #ff0000;
            color: white;
            padding: 3rem 2rem 1rem;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 2rem;
            max-width: 1200px;
            margin: 0 auto;
            margin-bottom: 2rem;
        }

        .footer-links h3,
        .footer-contact h3,
        .footer-company h3 {
            font-size: 1.1rem;
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid rgba(255, 255, 255, 0.2);
        }

        .footer-links ul,
        .footer-contact ul {
            list-style: none;
            padding: 0;
        }

        .footer-links li,
        .footer-contact li {
            margin-bottom: 0.5rem;
        }

        .footer-links a {
            color: white;
            text-decoration: none;
            transition: opacity 0.2s;
        }

        .footer-links a:hover {
            opacity: 0.8;
        }

        .footer-contact i {
            margin-right: 0.5rem;
            width: 20px;
        }

        .footer-company p {
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
        }

        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.2);
            padding-top: 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .language-select {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .language-select select {
            padding: 0.3rem;
            border-radius: 4px;
            border: 1px solid white;
            background: transparent;
            color: white;
        }

        .language-select select option {
            background: #ff0000;
        }

        .social-links {
            display: flex;
            gap: 1.5rem;
        }

        .social-link {
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: opacity 0.2s;
        }

        .social-link:hover {
            opacity: 0.8;
        }

        .social-link i {
            font-size: 1.2rem;
        }


        .category-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1.5rem;
            padding: 20px;
        }

        .category-card {
            background: white;
            border-radius: 8px;
            padding: 1.5rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: flex-start;
            gap: 1rem;
            transition: transform 0.2s;
        }

        .category-card:hover {
            transform: translateY(-5px);
        }

        .category-card img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 4px;
        }

        .card-content {
            flex: 1;
        }

        .card-content h3 {
            font-size: 1.1rem;
            margin-bottom: 0.5rem;
        }

        .card-content p {
            color: #666;
            margin-bottom: 0.5rem;
        }

        .card-content span {
            color: #888;
            font-size: 0.9rem;
        }

        .partners {
            padding: 3rem 2rem;
            background: #f8f9fa;
        }

        .partners h2 {
            text-align: center;
            margin-bottom: 2rem;
        }

        .partner-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .partner-logo {
            background: white;
            border-radius: 8px;
            padding: 1.5rem;
            text-align: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            transition: transform 0.2s;
        }

        .partner-logo:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .partner-logo img {
            width: 120px;
            height: 80px;
            object-fit: contain;
            margin-bottom: 1rem;
        }

        .partner-info {
            margin-top: 1rem;
            padding-top: 1rem;
            border-top: 1px solid #eee;
        }

        .position-count {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            color: #666;
            font-size: 0.9rem;
        }

        .position-count i {
            color: #ff0000;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .hotlines-section {
                flex-direction: column;
                padding: 1rem;
            }

            .hotline-column {
                padding: 1rem 0;
            }

            .hotline-title {
                font-size: 1.5rem;
                text-align: center;
            }

            .hotline-info {
                text-align: center;
            }

            .divider {
                width: 100%;
                height: 1px;
                margin: 1rem 0;
            }

            .consult-button {
                display: block;
                margin: 0 auto;
                width: 100%;
                max-width: 300px;
            }

            .countries-container .row {
                flex-wrap: wrap;
            }

            .country-item {
                margin: 5px;
            }

            .hotline-box {
                width: 100%;
                max-width: 300px;
            }

            .keywords-container {
                grid-template-columns: 1fr;
            }

            .keywords-section {
                padding: 2rem 1rem;
            }

            .keyword-column {
                padding: 1rem;
            }

            .header-top {
                flex-direction: column;
                padding: 1rem;
            }

            .header-actions {
                width: 100%;
            }

            .auth-section {
                flex-direction: column;
                width: 100%;
            }

            .auth-group {
                width: 100%;
            }

            .auth-buttons {
                width: 100%;
                justify-content: center;
            }

            .auth-btn {
                flex: 1;
                text-align: center;
            }

            .your-location {
                width: 100%;
                justify-content: center;
            }

            .nav ul {
                flex-direction: column;
                align-items: center;
            }

            .search-bar {
                flex-direction: column;
            }

            .stats {
                gap: 1rem;
            }

            .category-grid {
                grid-template-columns: 1fr;
            }

            .partner-grid {
                grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
                gap: 1rem;
            }

            .partner-logo {
                padding: 1rem;
            }

            .partner-logo img {
                width: 100px;
                height: 60px;
            }

            .footer {
                padding: 2rem 1rem 1rem;
            }

            .footer-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }

            .footer-bottom {
                flex-direction: column;
                text-align: center;
            }

            .social-links {
                flex-direction: column;
                align-items: center;
            }


        }

        /* Countries Section */
        .countries-section {
            text-align: center;
            background-color: #f0f0f0;
            padding: 20px 0;
        }

        .countries-container .row {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        .country-item {
            text-align: center;
            margin: 0 10px;
        }

        .country-item .flag {
            width: 80px;
            height: auto;
        }

        .country-item .country-name {
            display: block;
            margin-top: 5px;
        }

        /* Hotline Section */
        .hotlines-section {
            display: flex;
            justify-content: space-between;
            padding: 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .hotline-column {
            flex: 1;
            padding: 1rem;
        }

        .hotline-title {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 1.5rem;
        }

        .hotline-title.job-seekers {
            color: #ff0000;
        }

        .hotline-title.employers {
            color: #00ffff;
        }

        .hotline-info {
            margin-bottom: 1rem;
        }

        .hotline-label {
            display: block;
            margin-bottom: 0.5rem;
        }

        .hotline-label.job-seekers {
            color: #ff0000;
        }

        .hotline-label.employers {
            color: #00ffff;
        }

        .hotline-number {
            font-size: 1.2rem;
            font-weight: bold;
            display: block;
            margin-bottom: 1rem;
        }

        .hotline-number.job-seekers {
            color: #ff0000;
        }

        .hotline-number.employers {
            color: #00ffff;
        }

        .consult-button {
            padding: 0.5rem 1rem;
            border: 2px solid;
            background: transparent;
            cursor: pointer;
            font-size: 1rem;
        }

        .consult-button.job-seekers {
            border-color: #ff0000;
            color: #ff0000;
        }

        .consult-button.employers {
            border-color: #00ffff;
            color: #00ffff;
        }

        .divider {
            width: 1px;
            background-color: #ccc;
            margin: 0 2rem;
        }

        /* Responsive Styles */
    </style>
</head>

<body>
    <header class="header">
        <div class="header-top">
            <div class="logo">
                <img src="{{ asset('frontend/img/logo.png') }}" alt="Logo">
                <h1>VIỆC LÀM TẠI NĂM CHÂU</h1>
            </div>
            <div class="header-actions">
                <div class="your-location">
                    <i class="fas fa-map-marker-alt"></i>
                    <select class="location-select">
                        <option>Vị trí của bạn</option>
                        <option>Hà Nội</option>
                        <option>TP HCM</option>
                        <option>Đà Nẵng</option>
                    </select>
                </div>
                <div class="auth-section">
                    <div class="auth-group candidate">
                        <span class="auth-label">Người tìm việc</span>
                        <div class="auth-buttons">
                            <button class="auth-btn login">Đăng nhập</button>
                            <button class="auth-btn register">Đăng ký</button>
                        </div>
                    </div>
                    <div class="auth-group employer">
                        <span class="auth-label">Nhà tuyển dụng</span>
                        <div class="auth-buttons">
                            <button class="auth-btn login">Đăng nhập</button>
                            <button class="auth-btn register">Đăng ký</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <nav class="nav">
            <ul>
                <li><a href="#">Trang chủ</a></li>
                <li><a href="{{ route('site.countries') }}">Việc làm</a></li>
                <li><a href="#">Du học nghề</a></li>
                <li><a href="#">Xuất khẩu lao động</a></li>
                <li><a href="#">Tin tức</a></li>
                <li><a href="#">Liên hệ</a></li>
            </ul>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="footer">
        <div class="footer-grid">
            <div class="footer-links">
                <h3>Trang chủ</h3>
                <ul>
                    <li><a href="#">Về chúng tôi</a></li>
                    <li><a href="#">Bảng giá dịch vụ</a></li>
                    <li><a href="#">Người tìm việc</a></li>
                    <li><a href="#">Nhà tuyển dụng</a></li>
                </ul>
            </div>

            <div class="footer-links">
                <h3>Hỗ trợ</h3>
                <ul>
                    <li><a href="#">Liên hệ với chúng tôi</a></li>
                    <li><a href="#">Quy định đăng tin</a></li>
                    <li><a href="#">Hướng dẫn đăng tin</a></li>
                    <li><a href="#">Câu hỏi thường gặp</a></li>
                </ul>
            </div>

            <div class="footer-links">
                <h3>Hỏi đáp</h3>
                <ul>
                    <li><a href="#">Giải đáp thắc mắc</a></li>
                    <li><a href="#">Các hồ sơ thường gặp</a></li>
                    <li><a href="#">Thủ tục cần thiết</a></li>
                </ul>
            </div>

            <div class="footer-contact">
                <h3>HỖ TRỢ KỸ THUẬT</h3>
                <ul>
                    <li><i class="fas fa-phone"></i> Số đt/fax: +8467 9957 052</li>
                    <li><i class="fas fa-envelope"></i> vietnamvision@gmail.com</li>
                    <li><i class="fas fa-clock"></i> Copyright 2014-2024 Việc Làm Năm Châu</li>
                </ul>
            </div>

            <div class="footer-company">
                <h3>Báo Online Việc Làm Tại Năm Châu</h3>
                <p>Trực thuộc (C) Công Ty Ltd</p>
                <p>GPĐKKD: 3702914394</p>
                <p>Địa chỉ: Số 367/373 Lý Thường Kiệt, Phường 8</p>
                <p>Contact@namchauoverseas.com</p>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="language-select">
                <label>Ngôn ngữ:</label>
                <select>
                    <option value="vi">Tiếng Việt</option>
                    <option value="en">English</option>
                </select>
            </div>

            <div class="social-links">
                <a href="#" class="social-link">
                    <i class="fab fa-facebook-f"></i>
                    <span>Follow Us on Facebook</span>
                </a>
                <a href="#" class="social-link">
                    <i class="fab fa-youtube"></i>
                    <span>Youtube</span>
                </a>
                <a href="#" class="social-link">
                    <i class="fas fa-handshake"></i>
                    <span>Partners</span>
                </a>
            </div>
        </div>
    </footer>


    <script>
        // Add mobile menu toggle
        document.addEventListener('DOMContentLoaded', () => {
            const navToggle = document.createElement('button');
            navToggle.classList.add('nav-toggle');
            navToggle.innerHTML = '☰';

            const nav = document.querySelector('.nav ul');

            if (window.innerWidth <= 768) {
                nav.style.display = 'none';
                document.querySelector('.nav').prepend(navToggle);

                navToggle.addEventListener('click', () => {
                    nav.style.display = nav.style.display === 'none' ? 'flex' : 'none';
                });
            }
        });
    </script>
</body>

</html>
