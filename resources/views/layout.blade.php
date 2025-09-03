<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@3.1.0/dist/css/multi-select-tag.css">
    <!-- Thêm Toastr CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap JS -->

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <title>Vieclamtainamchau</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;

        }

        body {
            overflow-x: hidden;

        }

        a {
            text-decoration: none;
        }

        .avatar-container {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 80px;
            /* Kích thước vùng chứa avatar */
            height: 80px;
            border-radius: 50%;
            /* Bo tròn để tạo hình tròn */
            overflow: hidden;
            /* Ẩn phần thừa của hình ảnh */
            background-color: #f3f3f3;
            /* Màu nền mặc định nếu không có avatar */
            border: 2px solid #ddd;
            /* Đường viền nhẹ */
        }

        .avatar-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            /* Đảm bảo ảnh luôn được hiển thị đầy đủ */
        }

        .avatar-container svg {
            width: 50%;
            /* Kích thước SVG nhỏ hơn vùng chứa */
            height: 50%;
            color: #aaa;
            /* Màu sắc SVG */
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

        /* .category-card.hot-effect {
            border: 2px solid #ff6b6b;
            box-shadow: 0 4px 15px rgba(255, 107, 107, 0.2);
            transform: translateY(-3px);
        } */

.category-card.hot-effect {
            border: 2px solid #ff6b6b;
            box-shadow: 0 4px 15px rgba(255, 107, 107, 0.2);

        }
        /* .category-card.hot-effect::before {
            content: "Hot";
            position: absolute;
            top: -12px;
            right: 10px;
            background: #ff6b6b;
            color: white;
            padding: 2px 12px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: bold;


        } */

        .advertisement-container {
            display: flex;
            gap: 2rem;
            padding: 1rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .ad-content {
            flex: 2;
        }

        .news-list {
            background: #fff;
            border-radius: 8px;
            padding: 1rem;
            margin-bottom: 2rem;
        }

        .news-item {
            display: flex;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .news-image {
            width: 400px;
            height: 350px;
            object-fit: cover;
            border-radius: 4px;
        }

        .news-text h3 {
            font-size: 1.2rem;
            margin-bottom: 0.5rem;
        }

        .news-date {
            color: #666;
            font-size: 0.9rem;
        }

        .news-links {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .news-links a {
            color: #333;
            text-decoration: none;
            padding: 0.5rem 0;
            border-bottom: 1px solid #eee;
        }

        .news-links a:hover {
            color: #007bff;
        }

        .category-buttons {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .category-btn {
            padding: 1rem;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            text-align: center;
            font-weight: bold;
        }

        .category-btn.green {
            background-color: #4CAF50;
        }

        .category-btn.purple {
            background-color: #9C27B0;
        }

        .category-btn.blue {
            background-color: #2196F3;
        }

        .ad-banners {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .ad-banner img {
            width: 100%;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .advertisement-container {
                flex-direction: column;
            }

            .news-item {
                flex-direction: column;
            }

            .news-image {
                width: 100%;
                height: 200px;
            }

            .ad-banners {
                flex-direction: row;
                flex-wrap: wrap;
                justify-content: center;
            }

            .ad-banner {
                flex: 1;
                min-width: 300px;
            }
        }


        @media (min-width: 992px) {
            .footer-contact {
                width: 400px;
                margin-left: -150px;
            }
            .footer-company {
                width: 280px;
              margin-left: -70px;
            }

        }
        @media (max-width: 480px) {
            .category-buttons {
                gap: 0.5rem;
            }

            .category-btn {
                padding: 0.8rem;
                font-size: 0.9rem;
            }

            .ad-banner {
                min-width: 100%;
            }
        }

        .category-card.hot-effect:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 20px rgba(255, 107, 107, 0.3);
        }

        /* Thêm animation pulse cho hot-effect */
        @keyframes pulse {
            0% {
                box-shadow: 0 4px 15px rgba(255, 107, 107, 0.2);
            }

            50% {
                box-shadow: 0 4px 20px rgba(255, 107, 107, 0.4);
            }

            100% {
                box-shadow: 0 4px 15px rgba(255, 107, 107, 0.2);
            }
        }

        .category-card.hot-effect {
            animation: pulse 2s infinite;
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

        /* Base styles */
        .auth-section {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 1rem;
            padding: 1rem;
        }

        .auth-logged-in {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .auth-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }

        .search-btn {
            background: none;
            border: none;
            cursor: pointer;
            padding: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: transform 0.2s;
            color: #666;
        }

        .search-btn:hover {
            transform: scale(1.1);
            color: #007bff;
        }

        .search-btn svg {
            width: 20px;
            height: 20px;
        }

        .auth-name {
            font-size: 1rem;
            font-weight: bold;
            color: #ffffff;
        }

        .auth-actions {
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
            color: #f0f0f0;
        }

        .auth-btn.profile {
            background: #007bff;
            color: #fff;
        }

        .promotion-section {
            margin: 1rem 0;
        }

        .promotion-list {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .pagination {
            display: flex;
            justify-content: center;
            padding: 10px;
            list-style: none;
        }

        .pagination .page-item {
            margin: 0 5px;
        }

        .pagination .page-item a {
            display: block;
            padding: 8px 12px;
            color: #007bff;
            text-decoration: none;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .pagination .page-item.active a {
            background-color: #007bff;
            color: white;
            border-color: #007bff;
        }

        .promotion-card {
            display: flex;
            background: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
        }

        .promotion-card:hover {
            transform: translateY(-2px);
        }

        .promotion-image {
            width: 120px;
            height: 120px;
            flex-shrink: 0;
        }

        .promotion-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .promotion-content {
            padding: 1rem;
            flex-grow: 1;
        }

        .promotion-title {
            margin: 0 0 0.5rem 0;
        }

        .promotion-title a {
            color: #22c55e;
            text-decoration: none;
            font-size: 1.1rem;
            font-weight: 600;
        }

        .promotion-details {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            align-items: center;
            font-size: 0.9rem;
            color: #666;
        }

        .promotion-location,
        .promotion-time {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .status-tag {
            padding: 0.25rem 0.5rem;
            background-color: #f3f4f6;
            border-radius: 4px;
            font-size: 0.8rem;
        }

        .promotion-actions {
            margin-left: auto;
        }

        .favorite-btn {
            background: none;
            border: none;
            cursor: pointer;
            padding: 0.5rem;
            color: #666;
        }

        .favorite-btn:hover {
            color: #ef4444;
        }

        .pagination-container {
            margin-top: 1rem;
            display: flex;
            justify-content: center;
        }

        @media (max-width: 640px) {
            .promotion-card {
                flex-direction: column;
            }

            .promotion-image {
                width: 100%;
                height: 200px;
            }

            .promotion-details {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.5rem;
            }
        }

        .auth-btn.logout {
            background: #dc3545;
            color: #fff;
        }

        /* Hover effect */
        .auth-btn:hover {
            opacity: 0.9;
            transform: translateY(-2px);
        }

        .action-btn {
            padding: 5px 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            cursor: pointer;
            font-size: 14px;
            margin-right: 5px;
        }

        .action-btn.delete-btn {
            background-color: #dc3545;
        }

        .action-btn:hover {
            opacity: 0.9;
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

        .search-bar input,
        .search-bar select {
            flex: 1;
            height: 48px;
            padding: 8px 16px;
            border: 1px solid #e5e7eb;
            border-radius: 4px;
            font-size: 14px;
            color: #374151;
            background-color: #fff;
            transition: all 0.2s ease;
        }

        /* Custom select styling */
        /* Hero section */
        .hero {
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('{{ asset('frontend/img/we-are-hiring-digital-collage.jpg') }}');
            background-size: cover;
            background-position: center;
            padding: 80px 0;
        }

        /* Search bar container */
        .search-bar {
            position: absolute;
            bottom: 30px;
            /* Cách đáy ảnh 30px, điều chỉnh theo ý bạn */
            left: 50%;
            transform: translateX(-50%);


            padding: 20px;

            gap: 10px;
        }

        /* Search form */
        .search-bar form {
            display: flex;
            gap: 12px;
            background: rgba(255, 255, 255, 0.95);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        /* Common styles for input and select */
        .search-bar input,
        .search-bar select {
            flex: 1;
            height: 48px;
            padding: 8px 16px;
            border: 1px solid #e5e7eb;
            border-radius: 4px;
            font-size: 14px;
            color: #374151;
            background-color: #fff;
            transition: all 0.2s ease;
        }

        /* Custom select styling */
        .search-bar select {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%236B7280'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 12px center;
            background-size: 16px;
            padding-right: 40px;
        }

        /* Focus states */
        .search-bar input:focus,
        .search-bar select:focus {
            outline: none;
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        /* Search button */
        .search-btn {
            padding: 12px 32px;
            background-color: #dc2626;
            color: white;
            border: none;
            border-radius: 4px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.2s ease;
            min-width: 120px;
            height: 48px;
        }

        .search-btn:hover {
            background-color: #b91c1c;
        }

        /* Placeholder styling */
        .search-bar input::placeholder {
            color: #9ca3af;
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .hero {
                padding: 40px 0;
            }

            .search-bar form {
                flex-direction: column;
                gap: 10px;
            }

            .search-bar input,
            .search-bar select,
            .search-btn {
                width: 100%;
            }

            .search-btn {
                margin-top: 8px;
            }
        }

        /* Hover states */
        .search-bar input:hover,
        .search-bar select:hover {
            border-color: #cbd5e1;
        }

        /* Disabled state */
        .search-bar input:disabled,
        .search-bar select:disabled {
            background-color: #f3f4f6;
            cursor: not-allowed;
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
            max-width: 60px;
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

        .pagination-container {
            margin-top: 20px;
        }

        .pagination {
            display: flex;
            list-style: none;
            padding: 0;
            justify-content: center;
            gap: 5px;
        }

        .pagination li {
            display: inline-block;
        }

        .pagination li a,
        .pagination li span {
            padding: 8px 12px;
            border: 1px solid #ddd;
            color: #333;
            text-decoration: none;
            border-radius: 4px;
        }

        .pagination li.active span {
            background-color: #007bff;
            color: white;
            border-color: #007bff;
        }

        .pagination li a:hover {
            background-color: #f8f9fa;
        }

        .news-links a {
            display: block;
            padding: 8px 0;
            border-bottom: 1px solid #eee;
            transition: color 0.3s ease;
        }

        .news-links a:hover {
            color: #007bff;
        }

        .news-image {
            transition: opacity 0.3s ease;
        }

        .search-container {
            margin-bottom: 20px;
        }

        .search-input {
            width: 100%;
            padding: 12px;
            border: 2px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            transition: border-color 0.3s ease;

        }

        .search-input:focus {
            border-color: #ff0000;
            outline: none;
        }

        /* Hide/Show news links */
        .news-link.hidden {
            display: none;
        }

        /* No results message */
        .no-results {
            padding: 20px;
            text-align: center;
            color: #666;
            font-style: italic;
            display: none;
        }

        /* Highlight matching text */
        .highlight {
            background-color: #fff3cd;
            padding: 2px;
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

        .job-categories .category-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(min(286px, 100%), 1fr));
            gap: 20px;
            padding: 20px;
        }

        .job-categories .category-card {
            max-width: 486px;

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
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 4px;
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
            .auth-section {
                flex-direction: column;
                align-items: flex-start;
            }

            .auth-logged-in {
                flex-direction: column;
                align-items: flex-start;
            }

            .auth-name,
            .auth-actions {
                margin-top: 0.5rem;
            }

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
                width: 60px;
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

        .container {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 250px;
            background: #fff;
            padding: 20px;
            border-right: 1px solid #eee;
        }

        .main-content {
            flex: 1;
            padding: 20px;
            background: #f8f9fa;
        }

        .menu-item {
            display: flex;
            align-items: center;
            padding: 10px;
            margin: 5px 0;
            cursor: pointer;
            color: #333;
            text-decoration: none;
        }

        .menu-item i {
            margin-right: 10px;
            color: #ff0000;
        }

        .menu-section {
            margin: 15px 0;
        }

        .menu-title {
            font-weight: bold;
            margin: 10px 0;
            color: #333;
        }

        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .add-campaign-btn {
            background: #ff0000;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
        }

        .search-section {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }

        .campaign-select {
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            min-width: 200px;
        }

        .search-input {
            flex: 1;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .campaign-grid {
            display: grid;
            grid-template-columns: repeat(6, 1fr);
            gap: 10px;
            background: white;
            padding: 15px;
            border-radius: 4px;
            border: 1px solid #ddd;
        }

        .campaign-cell {
            padding: 15px;
            border-right: 1px solid #eee;
        }

        .campaign-cell:last-child {
            border-right: none;
        }

        .campaign-header {
            font-weight: bold;
            margin-bottom: 10px;
        }

        .campaign-toggle {
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 10px 0;
        }

        .toggle-switch {
            position: relative;
            display: inline-block;
            width: 50px;
            height: 24px;
        }

        .toggle-switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .toggle-slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: .4s;
            border-radius: 24px;
        }

        .toggle-slider:before {
            position: absolute;
            content: "";
            height: 16px;
            width: 16px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            transition: .4s;
            border-radius: 50%;
        }

        input:checked+.toggle-slider {
            background-color: #ff0000;
        }

        input:checked+.toggle-slider:before {
            transform: translateX(26px);
        }

        .stat {
            color: #0066ff;
            font-weight: bold;
            font-size: 1.2em;
        }

        .action-btn {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 4px;
            cursor: pointer;
            margin: 4px;
        }

        .primary-btn {
            background: #ff0000;
            color: white;
            border: none;
        }

        .outline-btn {
            border: 1px solid #ff0000;
            color: #ff0000;
            background: white;
        }

        .main-content {
            flex: 1;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .main-content h1 {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
            color: #333;
        }

        .main-content .form-label {
            font-size: 14px;
            font-weight: bold;
            color: #333;
        }

        .main-content .form-control,
        .main-content .form-select,
        .main-content .search-field {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }

        .main-content .form-control:focus,
        .main-content .form-select:focus {
            outline: none;
            border-color: #007bff;
            box-shadow: 0 0 4px rgba(0, 123, 255, 0.5);
        }

        .main-content textarea {
            resize: none;
        }

        .main-content .btn-primary {
            background-color: #007bff;
            border: none;
            padding: 10px 20px;
            font-size: 14px;
            color: #fff;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s ease-in-out;
        }

        .main-content .btn-primary:hover {
            background-color: #0056b3;
        }

        .text-danger {
            font-size: 12px;
            color: red;
        }

        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .add-campaign-btn {
            background: #ff0000;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
        }

        .search-section {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }

        .campaign-select {
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            min-width: 200px;
        }

        .search-input {
            flex: 1;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .campaign-grid {
            display: grid;
            grid-template-columns: repeat(6, 1fr);
            gap: 10px;
            background: white;
            padding: 15px;
            border-radius: 4px;
            border: 1px solid #ddd;
        }

        .campaign-cell {
            padding: 15px;
            border-right: 1px solid #eee;
        }

        .campaign-cell:last-child {
            border-right: none;
        }

        .campaign-header {
            font-weight: bold;
            margin-bottom: 10px;
        }

        .campaign-toggle {
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 10px 0;
        }

        .toggle-switch {
            position: relative;
            display: inline-block;
            width: 50px;
            height: 24px;
        }

        .toggle-switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .toggle-slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: .4s;
            border-radius: 24px;
        }

        .toggle-slider:before {
            position: absolute;
            content: "";
            height: 16px;
            width: 16px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            transition: .4s;
            border-radius: 50%;
        }

        input:checked+.toggle-slider {
            background-color: #ff0000;
        }

        input:checked+.toggle-slider:before {
            transform: translateX(26px);
        }

        .stat {
            color: #0066ff;
            font-weight: bold;
            font-size: 1.2em;
        }

        .action-btn {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 4px;
            cursor: pointer;
            margin: 4px;
        }

        .primary-btn {
            background: #ff0000;
            color: white;
            border: none;
        }

        .outline-btn {
            border: 1px solid #ff0000;
            color: #ff0000;
            background: white;
        }

        @media (max-width: 1200px) {
            .campaign-grid {
                grid-template-columns: repeat(3, 1fr);
            }

            .campaign-cell {
                border-bottom: 1px solid #eee;
            }
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
                border-right: none;
                border-bottom: 1px solid #eee;
            }

            .search-section {
                flex-direction: column;
            }

            .campaign-grid {
                grid-template-columns: 1fr;
            }

            .campaign-cell {
                border-right: none;
            }
        }

        .post-button {
            background: #ff0000;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
        }

        .filters {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }

        .filter-select {
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            min-width: 150px;
        }

        .job-table {
            width: 100%;
            border-collapse: collapse;
        }

        .job-table th {
            text-align: left;
            padding: 12px;
            background: #f8f9fa;
            border-bottom: 2px solid #dee2e6;
        }

        .job-table td {
            padding: 12px;
            border-bottom: 1px solid #dee2e6;
        }

        .export-btn {
            color: #ff0000;
            border: 1px solid #ff0000;
            background: white;
            padding: 5px 15px;
            border-radius: 4px;
            cursor: pointer;
        }

        .pagination {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 20px;
        }

        .page-btn {
            padding: 5px 10px;
            border: 1px solid #dee2e6;
            border-radius: 4px;
            cursor: pointer;
        }
 .content-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: transform 0.3s ease;
        }

        .content-card:hover {
            transform: translateY(-5px);
        }

        .contact-section h2 {
            color: #4a5568;
            margin-bottom: 20px;
            font-size: 1.8rem;
        }

        .contact-info {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .contact-item {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 15px;
            background: #f7fafc;
            border-radius: 12px;
            transition: all 0.3s ease;
        }

        .contact-item:hover {
            background: #e2e8f0;
            transform: translateX(5px);
        }

        .contact-icon {
            width: 24px;
            height: 24px;
            fill: #667eea;
        }

        /* Nút Zalo cố định */
        .zalo-float-button {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 60px;
            height: 60px;
            background: #0068FF;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 20px rgba(0, 104, 255, 0.4);
            cursor: pointer;
            transition: all 0.3s ease;
            z-index: 1000;
            animation: pulse 2s infinite;
        }

        .zalo-float-button:hover {
            transform: scale(1.1);
            box-shadow: 0 6px 30px rgba(0, 104, 255, 0.6);
        }

        .zalo-icon {
            width: 32px;
            height: 32px;
            fill: white;
        }

        /* Nút Zalo trong contact section */
        .zalo-contact-button {
            background: linear-gradient(45deg, #0068FF, #0052CC);
            color: white;
            border: none;
            padding: 15px 30px;
            border-radius: 50px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            justify-content: center;
            margin-top: 20px;
            box-shadow: 0 4px 15px rgba(0, 104, 255, 0.3);
        }

        .zalo-contact-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 104, 255, 0.4);
        }

        .features {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 30px;
        }

        .feature-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
        }

        .feature-icon {
            width: 48px;
            height: 48px;
            margin: 0 auto 15px;
            fill: #667eea;
        }

        @keyframes pulse {
            0% {
                box-shadow: 0 4px 20px rgba(0, 104, 255, 0.4);
            }
            50% {
                box-shadow: 0 4px 30px rgba(0, 104, 255, 0.7);
            }
            100% {
                box-shadow: 0 4px 20px rgba(0, 104, 255, 0.4);
            }
        }

        @media (max-width: 768px) {
            .main-content {
                grid-template-columns: 1fr;
            }

            h1 {
                font-size: 2rem;
            }

            .zalo-float-button {
                bottom: 20px;
                right: 20px;
                width: 50px;
                height: 50px;
            }

            .zalo-icon {
                width: 28px;
                height: 28px;
            }
        }
        .page-btn.active {
            background: #ff0000;
            color: white;
            border-color: #ff0000;
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
                border-right: none;
                border-bottom: 1px solid #eee;
            }

            .filters {
                flex-wrap: wrap;
            }

            .job-table {
                display: block;
                overflow-x: auto;
            }
        }

        select[multiple] {
            height: auto;
        }

        .mb-3 {
            margin-bottom: 16px;
        }

        .mb-4 {
            margin-bottom: 24px;
        }

        @media (max-width: 1200px) {
            .campaign-grid {
                grid-template-columns: repeat(3, 1fr);
            }

            .campaign-cell {
                border-bottom: 1px solid #eee;
            }
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
                border-right: none;
                border-bottom: 1px solid #eee;
            }

            .search-section {
                flex-direction: column;
            }

            .campaign-grid {
                grid-template-columns: 1fr;
            }

            .campaign-cell {
                border-right: none;
            }
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
            color: #ffc107;
        }

        .hotline-info {
            margin-bottom: 1rem;
        }

        .hotline-label {
            display: block;
            margin-bottom: 0.5rem;
        }

        .tabs {
            display: flex;
            border-bottom: 1px solid #ddd;
            margin-bottom: 30px;
        }

        .tab {
            padding: 10px 20px;
            cursor: pointer;
            border-bottom: 2px solid transparent;
        }

        .tab.active {
            color: #ff0000;
            border-bottom: 2px solid #ff0000;
        }

        .form-section {
            margin-bottom: 30px;
        }

        .form-section h2 {
            font-size: 18px;
            margin-bottom: 20px;
            color: #333;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #555;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }

        .avatar-section {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 30px;
        }

        .avatar {
            width: 100px;
            height: 100px;
            background: #6c5ce7;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }

        .upload-btn {
            color: #ff0000;
            text-decoration: underline;
            cursor: pointer;
        }

        .upload-note {
            font-size: 12px;
            color: #666;
        }

        .add-phone {
            color: #ff0000;
            text-decoration: none;
            font-size: 14px;
            display: inline-block;
            margin-top: 8px;
            cursor: pointer;
        }

        .update-btn {
            background: #ff0000;
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
        }

        .update-btn:hover {
            background: #e60000;
        }

        .login-alert {
            margin-top: 30px;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 4px;
        }

        .radio-group {
            display: flex;
            gap: 20px;
        }

        .radio-item {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .business-license {
            margin-top: 30px;
        }

        .upload-file {
            border: 1px dashed #ddd;
            padding: 20px;
            border-radius: 4px;
            margin-top: 10px;
        }

        .upload-file button {
            background: white;
            border: 1px solid #ddd;
            padding: 8px 16px;
            border-radius: 4px;
            cursor: pointer;
        }

        .license-note {
            margin-top: 20px;
            font-size: 14px;
            color: #00bcd4;
        }

        .license-note ul {
            list-style: none;
            margin-top: 10px;
        }

        .license-note li {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 6px;
        }

        .license-note li:before {
            content: "✓";
            color: #00bcd4;
        }

        @media (max-width: 768px) {
            .container {
                padding: 20px;
            }

            .avatar-section {
                flex-direction: column;
                align-items: flex-start;
            }
        }

        .hotline-label.job-seekers {
            color: #ff0000;
        }

        .hotline-label.employers {
            color: #ffc107;
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
            color: #ffc107;
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
            border-color: #ffc107;
            color: #ffc107;
        }

        .divider {
            width: 1px;
            background-color: #ccc;
            margin: 0 2rem;
        }

        /* CSS cho overlay và xử lý tương tác */
        .site-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: transparent;
            z-index: 998;
            pointer-events: none;
        }

        /* Vô hiệu hóa click cho toàn bộ trang trừ header và nút đăng nhập/đăng ký */
        body:has(.site-overlay) * {
            pointer-events: none;
        }

        /* Cho phép tương tác với header và nút đăng nhập/đăng ký */
        .header-top,
        .auth-group,
        .auth-buttons,
        .auth-btn {
            pointer-events: auto !important;
        }

        /* Cho phép scroll */
        body:has(.site-overlay) {
            overflow-y: auto;
        }

        /* Cho phép tương tác với modal */
        .warning-modal,
        .warning-modal * {
            pointer-events: auto !important;
        }

        /* Style cho các elements không thể click */
        .site-overlay~*:not(.auth-group):not(.auth-buttons):not(.auth-btn) a,
        .site-overlay~*:not(.auth-group):not(.auth-buttons):not(.auth-btn) button,
        .site-overlay~*:not(.auth-group):not(.auth-buttons):not(.auth-btn) input,
        .site-overlay~*:not(.auth-group):not(.auth-buttons):not(.auth-btn) select {
            cursor: not-allowed;
            user-select: none;
        }

        /* Khôi phục style cho nút đăng nhập/đăng ký */
        .auth-btn {
            cursor: pointer !important;
            user-select: auto !important;
        }

        /* Hiệu ứng hover chỉ cho elements bị chặn */
        .site-overlay~*:not(.auth-group):not(.auth-buttons):not(.auth-btn) a:hover::after,
        .site-overlay~*:not(.auth-group):not(.auth-buttons):not(.auth-btn) button:hover::after {
            content: "Vui lòng đăng nhập để tiếp tục";
            position: absolute;
            bottom: 100%;
            left: 50%;
            transform: translateX(-50%);
            background: rgba(0, 0, 0, 0.8);
            color: white;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 12px;
            white-space: nowrap;
            z-index: 1000;
        }

        /* Styling cho navigation chính */
        .nav {
            background-color: #ff0c0c;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: center;
        }

        .nav ul {
            display: flex;
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .nav ul li {
            position: relative;
        }

        .nav ul li a {
            color: #ffffff;
            display: block;
            padding: 15px 20px;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .nav ul li a:hover {
            background-color: #f5f5f5;
            color: #2563eb;
        }


        /* Styling cho dropdown */
        .dropdown-menu {
            background-color: rgb(254, 11, 11);
            border-radius: 4px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            display: none;
            left: 0;
            min-width: 200px;
            opacity: 0;
            position: absolute;
            top: 100%;
            transform: translateY(-10px);
            transition: all 0.3s ease;
            z-index: 1000;
        }

        /* Hiển thị dropdown khi hover */
        .dropdown:hover .dropdown-menu {
            display: block;
            opacity: 1;
            transform: translateY(0);
        }

        /* Styling cho các item trong dropdown */
        .dropdown-menu li {
            border-bottom: 1px solid #f0f0f0;
        }

        .dropdown-menu li:last-child {
            border-bottom: none;
        }

        .dropdown-menu li a {
            padding: 12px 20px;
            display: block;
            color: #4b5563;
            transition: all 0.2s ease;
        }

        .dropdown-menu li a:hover {
            background-color: #f8f9fa;
            color: #2563eb;
            padding-left: 24px;
            /* thêm effect lùi vào khi hover */
        }

        /* Thêm mũi tên cho dropdown */
        .dropdown>a::after {
            content: '▼';
            font-size: 10px;
            margin-left: 5px;
            vertical-align: middle;
        }

        /* Responsive styling */
        @media (max-width: 768px) {
            .nav ul {
                flex-direction: column;
            }

            .dropdown-menu {
                position: static;
                box-shadow: none;
                display: none;
                min-width: 100%;
            }

            .dropdown:hover .dropdown-menu {
                display: block;
            }

            .nav>ul>li {
                width: 100%;
                border-bottom: 1px solid #eee;
            }

            .nav>ul>li:last-child {
                border-bottom: none;
            }
        }

        /* Animation cho dropdown */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .dropdown:hover .dropdown-menu {
            animation: fadeIn 0.3s ease forwards;
        }

        /* Responsive Styles */
        .nav {
            position: relative;
        }

        .nav .dropdown {
            position: relative;
            display: inline-block;
        }

        .nav .dropdown-menu-hot {
            display: none;
            position: absolute;
            background-color: #ff0000;
            padding: 10px;
            z-index: 1;
            min-width: 150px;
            list-style: none;
        }

        .nav .dropdown-menu-hot li a {
            color: #fff;
            text-decoration: none;
            display: block;
            padding: 5px 10px;
        }

        .nav .dropdown-menu-hot li a:hover {
            background-color: #cc0000;
        }

        .nav .dropdown .dropdown-arrow {
            display: inline-block;
            margin-left: 5px;
            cursor: pointer;
            border: solid #000;
            border-width: 0 3px 3px 0;
            padding: 3px;
            transform: rotate(45deg);
            transition: transform 0.2s ease;
        }

        .nav .dropdown.show .dropdown-arrow {
            transform: rotate(-135deg);
        }

        .nav .dropdown.show .dropdown-menu-hot {
            display: block;
        }

        .nav li {
            position: relative;
        }

        .nav a {
            display: block;
            padding: 10px 15px;
            text-decoration: none;
            color: inherit;
        }

        /* Dropdown styles */
        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #fc0000;
            min-width: 200px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            z-index: 1000;
        }

        .dropdown-content a {
            color: #333;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {
            background-color: #880404;
        }

        /* Show dropdown on hover */
        .nav li:hover .dropdown-content {
            display: block;
        }

        /* Dropdown arrow */
        .dropdown-arrow {
            display: inline-block;
            margin-left: 5px;
        }

    .search-suggestions {
    position: absolute;
    top: 100%;
    left: 0;
    width: 100%;
    max-height: 300px;
    overflow-y: auto;
    background-color: white;
    border: 1px solid #ddd;
    border-top: none;
    border-radius: 0 0 4px 4px;
    z-index: 10000;
    list-style: none;
    padding: 0;
    margin: 0;
    display: none;
    box-shadow: 0 4px 8px rgba(0,0,0,0.2)
}

/* Đảm bảo các item trong danh sách hiển thị rõ ràng */
.search-suggestions li {
    padding: 12px 15px;
    cursor: pointer;
    border-bottom: 1px solid #f0f0f0;
    background: white; /* Đảm bảo nền trắng */
    color: #333; /* Màu chữ rõ ràng */
    font-size: 14px;

}


/* Khi hover vào gợi ý */
.search-suggestions li:hover,
.search-suggestions li.active-suggestion {
    background-color: #f0f7ff;
}

/* Thêm CSS này vào file CSS của bạn hoặc tạo một section style trong blade */

.pagination-container {
    display: flex;
    justify-content: center;
    margin-top: 20px;
    margin-bottom: 15px;
}

.pagination {
    display: flex;
    list-style: none;
    padding: 0;
    margin: 0;
    border-radius: 4px;
}

.pagination li {
    margin: 0 2px;
}

.pagination li a, .pagination li span {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 36px;
    min-width: 36px;
    padding: 0 10px;
    border-radius: 4px;
    text-decoration: none;
    background-color: #fff;
    color: #333;
    border: 1px solid #ddd;
    transition: all 0.3s ease;
}

.pagination li.active span {
    background-color: #007bff;
    border-color: #007bff;
    color: #fff;
}

.pagination li a:hover {
    background-color: #f5f5f5;
}

.pagination li.disabled span {
    color: #aaa;
    background-color: #f8f8f8;
    cursor: not-allowed;
}

/* Điều chỉnh để phù hợp với giao diện di động */
@media (max-width: 768px) {
    .pagination li a, .pagination li span {
        height: 32px;
        min-width: 32px;
        padding: 0 8px;
        font-size: 14px;
    }
}
    </style>
</head>

<body>
    <header class="header">
        <!-- Thêm overlay div ngay sau thẻ header -->
        @if (!Auth::guard('employer')->check() && !Auth::guard('candidate')->check())
            <div class="site-overlay" id="siteOverlay"></div>
        @endif
        <div class="header-top">
            <div class="logo">
                <img src="{{ asset('storage/' . ($info_layout->logo ?? 'frontend/img/logo.png')) }}"
                    style="width:200px;height:200px;" alt="Logo">
                <div class="modal-title-group" style="margin-left: 120px;">
                    <div class="modal-title" style="color: white">
                        {{ $info_layout->title ?? 'VIỆC LÀM TẠI NĂM CHÂU TRÊN THẾ GIỚI' }}
                    </div>
                    <div class="modal-subtitle" style="color: white">
                        {{ $info_layout->subtitle ?? 'JOBS IN FIVE CONTINENTS OF THE WORLD' }}
                    </div>
                </div>
            </div>
            <div class="header-actions">
                <div class="auth-section">
                    @if (Auth::guard('candidate')->check())
                        <div class="avatar-container">
                            <img src="{{ asset('storage/' . Auth::guard('candidate')->user()->avatar_candidate) ?? asset('storage/avatar/avatar-default.jpg') }}"
                                alt="Avatar" onerror="this.src='{{ asset('storage/avatar/avatar-default.jpg') }}'"
                                alt="{{ Auth::guard('candidate')->user()->fullname_candidate }}">
                        </div>
                        <div class="auth-logged-in">
                            <span class="auth-name">{{ Auth::guard('candidate')->user()->name }}</span>
                            <div class="auth-actions">
                                <a href="{{ route('candidate.profile.edit') }}" class="auth-btn profile">Hồ sơ</a>
                                <form action="{{ route('candidate.logout') }}" method="POST" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="auth-btn logout">Đăng xuất</button>
                                </form>
                            </div>
                        </div>
                    @elseif (Auth::guard('employer')->check())
                        <div class="avatar-container">
                            <img src="{{ asset('storage/' . Auth::guard('employer')->user()->avatar) ?? asset('storage/avatar/avatar-default.jpg') }}"
                                alt="Avatar" onerror="this.src='{{ asset('storage/avatar/avatar-default.jpg') }}'"
                                alt="{{ Auth::guard('employer')->user()->name }}">
                        </div>
                        <div class="auth-logged-in">
                            <span class="auth-name">{{ Auth::guard('employer')->user()->name }}</span>
                            <div class="auth-actions">
                                <a href="{{ route('employer.profile.edit') }}" class="auth-btn dashboard">Trang quản
                                    lý</a>
                                <form action="{{ route('employer.logout') }}" method="POST" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="auth-btn logout">Đăng xuất</button>
                                </form>
                            </div>
                        </div>
                    @else
                        <div class="auth-group candidate">
                            <span class="auth-label">Người tìm việc</span>
                            <div class="auth-buttons">
                                <a href="{{ route('candidate.login') }}" class="auth-btn login">Đăng nhập</a>
                                <a href="{{ route('candidate.register') }}" class="auth-btn register">Đăng ký</a>
                            </div>
                        </div>



                        <div class="auth-group employer">
                            <span class="auth-label">Nhà tuyển dụng</span>
                            <div class="auth-buttons">
                                <a href="{{ route('employer.login') }}" class="auth-btn login">Đăng nhập</a>
                                <a href="{{ route('employer.register') }}" class="auth-btn register">Đăng ký</a>
                            </div>
                        </div>
                    @endif
                </div>


            </div>
        </div>
        <nav class="nav">
            <ul>
                <li><a href="{{ route('/') }}">Trang chủ</a></li>
                @if (isset($genre_home) && $genre_home->count() > 0)
                    @foreach ($genre_home as $genre)
                        <li><a href="{{ route('genre.show', $genre->slug) }}">{{ $genre->name }}</a></li>
                    @endforeach
                @endif
                <li>
                    <a href="#">
                        Đơn vị đào tạo ngôn ngữ
                        <span class="dropdown-arrow">▼</span>
                    </a>
                    @if (isset($typeLanguageTraining_app) && $typeLanguageTraining_app->count())
                        <div class="dropdown-content">
                            @foreach ($typeLanguageTraining_app as $type)
                                <a href="{{ route('site.language-training', ['type' => $type->slug]) }}">
                                    {{ $type->name }}
                                </a>
                            @endforeach
                        </div>
                    @endif
                </li>

                 <li><a href="{{ route('site.study-abroad') }}">Du học nghề</a></li>
                <li><a href="{{ route('news.home') }}">Tin tức</a></li>
                <li><a href="{{ route('hotline') }}">Liên hệ</a></li>
            </ul>
        </nav>


    </header>
    @if (!Auth::guard('employer')->check() && !Auth::guard('candidate')->check())
        <div class="warning-modal" id="warningModal">
            <div class="modal-content">
                <button class="close-button" id="closeModal">&times;</button>
                <div class="modal-header">
                    <img src="{{ asset('frontend/img/logo.png') }}" alt="Logo">
                    <div class="modal-title-group" style="margin-left: 120px;">
                        <div class="modal-title">VIỆC LÀM TẠI NĂM CHÂU TRÊN THẾ GIỚI</div>
                        <div class="modal-subtitle">JOBS IN FIVE CONTINENTS OF THE WORLD</div>
                    </div>
                </div>

                <div class="modal-body">
                    <p class="modal-highlight">TÌM VIỆC LÀM MỚI – TÌM TRƯỜNG DU HỌC NGHỀ - TÌM CÔNG TY TUYỂN DỤNG LAO
                        ĐỘNG MIỄN PHÍ</p>
                    <p>TRANG WEBSITE VIECLAMTAINAMCHAU Này</p>
                    <p>Chỉ dành cho Người Tìm việc – Du học sinh – Học Nghề - Người lao động Đi xuất khẩu lao động.</p>
                    <p class="modal-warning">TRANG WEBSITE NÀY KHÔNG DÀNH CHO: các Công ty môi giới – Đại lý việc Làm.
                    </p>
                    <p>Nghiêm cấm các Tổ chức Hoặc Cá nhân lợi dụng nội dung việc làm – Du học nghề - Việc làm xuất khẩu
                        lao động đăng trên trang web này để thông tin môi giới kiếm tiền ,lừa đảo người tìm việc, người
                        đi du học nghề, Người đi xuất khẩu lao động.</p>
                    <p>Người tìm việc – du học sinh học nghề - Người đi xuất khẩu lao động.</p>
                    <a href="{{ route('candidate.register') }}" class="register-link">Đăng ký tài khoản miễn phí ngay
                        để xem tin việc làm mới – tìm trường du học nghề - tìm Công ty tuyển dụng lao động.</a>
                    <a href="{{ route('employer.register') }}" class="register-link">Đăng ký tài khoản nhà tuyển dụng
                        miễn phí ngay </a>
                </div>

                <div class="modal-footer">
                    <div class="contact-info">
                        <span>📞 +84.6565815</span>
                        <span>✉️ hotro@vieclamtainamchau.com</span>
                    </div>
                </div>
            </div>
        </div>

        <style>
            .warning-modal {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.5);
                display: flex;
                justify-content: center;
                align-items: center;
                z-index: 9999;
            }

            .modal-content {
                background: white;
                padding: 2rem;
                border-radius: 8px;
                width: 90%;
                max-width: 800px;
                max-height: 90vh;
                overflow-y: auto;
            }

            .modal-header {
                display: flex;
                align-items: center;
                gap: 1rem;
                margin-bottom: 1.5rem;
            }

            .modal-header img {
                width: 100px;
                height: 100px;
                object-fit: contain;
            }

            .modal-title {
                color: #ff0000;
                font-size: 1.25rem;
                font-weight: bold;
                text-align: center;
            }

            .modal-subtitle {
                color: #ff0000;
                font-size: 1rem;
                text-align: center;
            }

            .modal-body {
                text-align: center;
            }

            .modal-body p {
                margin-bottom: 1rem;
                line-height: 1.5;
            }

            .modal-highlight {
                font-weight: bold;
                color: #ff0000;
            }

            .modal-warning {
                font-weight: bold;
            }

            .register-link {
                display: inline-block;
                background: #ff0000;
                color: white;
                padding: 1rem 2rem;
                border-radius: 4px;
                text-decoration: none;
                margin: 1.5rem 0;
                font-weight: bold;
            }

            .register-link:hover {
                background: #cc0000;
            }

            .modal-footer {
                margin-top: 1.5rem;
                border-top: 1px solid #eee;
                padding-top: 1rem;
            }

            .contact-info {
                display: flex;
                justify-content: space-between;
                font-size: 0.9rem;
            }

            .modal-content {
                position: relative;
                /* Để định vị nút close */
                /* Các style khác giữ nguyên */
            }

            .close-button {
                position: absolute;
                top: 20px;
                right: 41px;
                width: 30px;
                height: 30px;
                border-radius: 50%;
                background: #ff0000;
                border: 2px solid white;
                color: white;
                font-size: 24px;
                line-height: 24px;
                cursor: pointer;
                display: flex;
                align-items: center;
                justify-content: center;
                transition: all 0.3s ease;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
                z-index: 1;
            }

            .close-button:hover {
                background: #cc0000;
                transform: rotate(90deg);
            }

            /* Thêm animation cho modal */
            .warning-modal {
                animation: fadeIn 0.3s ease-out;
            }

            .modal-content {
                animation: slideIn 0.3s ease-out;
            }

            @keyframes fadeIn {
                from {
                    opacity: 0;
                }

                to {
                    opacity: 1;
                }
            }

            @keyframes slideIn {
                from {
                    transform: translateY(-50px);
                    opacity: 0;
                }

                to {
                    transform: translateY(0);
                    opacity: 1;
                }
            }

            /* Điều chỉnh responsive */
            @media (max-width: 768px) {
                .close-button {
                    top: 10px;
                    right: 10px;
                }
            }

            @media (max-width: 768px) {
                .modal-content {
                    padding: 1rem;
                }

                .modal-header {
                    flex-direction: column;
                    text-align: center;
                }

                .contact-info {
                    flex-direction: column;
                    gap: 0.5rem;
                    text-align: center;
                }
            }
        </style>
    @endif
    <main>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        @yield('content')
    </main>

    <footer class="footer">
        <div class="footer-grid">
            <div class="footer-links" >
                <h3>Trang chủ</h3>
                <ul>
                    <li><a href="{{ route('about') }}">Về chúng tôi</a></li>
                    <li><a href="{{ route('employer.services') }}">Bảng giá dịch vụ</a></li>
                    <li><a href="{{ route('candidate.login') }}">Người tìm việc</a></li>
                    <li><a href="{{ route('employer.login') }}">Nhà tuyển dụng</a></li>
                </ul>
            </div>

            <div class="footer-links" style="margin-left: -60px;">
                <h3>Hỗ trợ</h3>
                <ul>
                    <li><a href="{{ route('hotline') }}">Liên hệ với chúng tôi</a></li>
                    <li><a href="{{ route('candidate.cv.white') }}">CV Du Học</a></li>
                    <li><a href="{{ route('candidate.cv.black') }}">CV Học Tiếng</a></li>
                    <li><a href="{{ route('candidate.cv.logistic') }}">CV Việc Làm</a></li>
                </ul>
            </div>

            <div class="footer-links" style="margin-left: -120px;">
                <h3>Hỏi đáp</h3>
                <ul>
                    <li><a href="{{ route('hotline') }}">Giải đáp thắc mắc</a></li>
                    <li><a href="{{ route('news.home') }}">Tin tức</a></li>
                </ul>
            </div>

            <div class="footer-contact">
                <h3>HỖ TRỢ KỸ THUẬT</h3>
                <ul>
                    <li><i class="fas fa-phone"></i>{{ $info_layout->phone ?? '+8467 9957 052' }}</li>
                    <li><i class="fas fa-envelope"></i> {{ $info_layout->gmail ?? 'vietnamvision@gmail.com' }}</li>
                    <li><i class="fas fa-clock"></i>
                        {{ $info_layout->copyright ?? 'Copyright 2014-2024 Việc Làm Năm Châu' }}</li>
                </ul>
            </div>

            <div class="footer-company">
                <h3>{{ $info_layout->newspaper ?? 'Trực thuộc (C) Công Ty Ltd' }}</h3>
                {!! $info_layout->footer_company !!}
            </div>
             <!-- Nút Zalo cố định -->
    <div class="zalo-float-button" onclick="openZalo()" title="Liên hệ qua Zalo">
        <img src="{{ asset('frontend/zalo.png') }}" alt="Zalo" style="width: 50px; height: 50px;">
    </div>

    <script>
        function openZalo() {
         const zaloNumber = "{{ $info_layout->phone ?? '0988123456' }}";

            const message = encodeURIComponent('Xin chào! Tôi muốn tìm hiểu về Layout App.');

            // Thử mở ứng dụng Zalo trước
            const zaloApp = `zalo://conversation?phone=${zaloNumber}&message=${message}`;

            // Fallback về Zalo Web nếu không có app
            const zaloWeb = `https://zalo.me/${zaloNumber}`;

            // Tạo link tạm thời để thử mở app
            const link = document.createElement('a');
            link.href = zaloApp;
            link.click();

            // Sau 1 giây, nếu vẫn ở trang này thì mở Zalo Web
            setTimeout(() => {
                window.open(zaloWeb, '_blank');
            }, 1000);
        }

        // Hiệu ứng hover cho các card
        document.querySelectorAll('.content-card, .feature-card').forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-5px)';
            });

            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });

        // Hiệu ứng scroll smooth
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            });
        });
    </script>
        </div>

        <div class="footer-bottom">
            <div id="google_translate_element"></div>
            <script type="text/javascript">
                function googleTranslateElementInit() {
                    new google.translate.TranslateElement({
                        pageLanguage: 'vi',
                        layout: google.translate.TranslateElement.InlineLayout.SIMPLE
                    }, 'google_translate_element');
                }
            </script>
            <script type="text/javascript"
                src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit">
                </script>

<div class="social-links">
    <a href="{{ $info_layout->url_facebook ?? '#' }}" class="social-link">
        <i class="fab fa-facebook-f"></i>
        <span>Follow Us on Facebook</span>
    </a>
    <a href="{{ $info_layout->url_youtube ?? '#' }}" class="social-link">
        <i class="fab fa-youtube"></i>
        <span>Youtube</span>
    </a>
    <a href="{{ $info_layout->url_partner ?? '#' }}" class="social-link">
        <i class="fas fa-handshake"></i>
        <span>Partners</span>
    </a>
    <a href="https://www.vieclamtainamchau.com/vieclamtainamchau.apk" class="social-link" download>
        <i class="fas fa-mobile-alt"></i>
        <span>Tải ứng dụng</span>
    </a>
    <a href="#" class="social-link" id="qr-link">
        <i class="fas fa-qrcode"></i>
        <span>QR Code tải App</span>
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
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const warningModal = document.getElementById("warningModal");
            const closeModal = document.getElementById("closeModal");

            if (warningModal && closeModal) {
                // Đóng modal
                closeModal.addEventListener("click", function () {
                    warningModal.style.display = "none";
                    document.body.classList.remove("modal-active");
                });

                // Hiển thị modal
                document.body.classList.add("modal-active");
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@3.1.0/dist/js/multi-select-tag.js"></script>
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@3.1.0/dist/css/multi-select-tag.css">
    <script>
        new MultiSelectTag('countries') // id
    </script>
    <script>
        new MultiSelectTag('genres')
    </script>
    <script>
        new MultiSelectTag('categories')
    </script>
    <script src="{{ asset('backend_admin/ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace('summary2');
        CKEDITOR.replace('summary3');
        CKEDITOR.replace('summary1');
        CKEDITOR.replace('summary4');
        CKEDITOR.replace('summary5');
        CKEDITOR.replace('description');
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const dropdownLink = document.querySelector(".dropdown > a");
            const dropdown = document.querySelector(".dropdown");

            dropdownLink.addEventListener("click", function (event) {
                event.preventDefault(); // Prevent the default link behavior
                event.stopPropagation(); // Prevent click from propagating to the document
                dropdown.classList.toggle("show");
            });

            // Hide dropdown if clicked outside
            document.addEventListener("click", function () {
                dropdown.classList.remove("show");
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const modal = document.getElementById('warningModal');
            if (modal) {
                // Prevent closing on click outside
                modal.addEventListener('click', function (e) {
                    if (e.target === modal) {
                        e.preventDefault();
                    }
                });

                // Prevent closing with Escape key
                document.addEventListener('keydown', function (e) {
                    if (e.key === 'Escape') {
                        e.preventDefault();
                    }
                });
            }
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (!document.querySelector('.site-overlay')) return;

            // Chặn sự kiện click trên toàn trang trừ nút đăng nhập/đăng ký
            document.addEventListener('click', function (e) {
                // Kiểm tra xem element được click có phải là nút đăng nhập/đăng ký không
                const isAuthButton = e.target.closest('.auth-btn') ||
                    e.target.closest('.auth-group') ||
                    e.target.closest('.auth-buttons');

                if (!e.target.closest('.warning-modal') && !isAuthButton) {
                    e.preventDefault();
                    e.stopPropagation();

                    const notification = document.createElement('div');
                    notification.style.cssText = `
                position: fixed;
                top: 20px;
                left: 50%;
                transform: translateX(-50%);
                background: rgba(0, 0, 0, 0.8);
                color: white;
                padding: 10px 20px;
                border-radius: 4px;
                z-index: 1001;
                animation: fadeInOut 2s ease-in-out;
            `;
                    notification.textContent = 'Vui lòng đăng nhập để tiếp tục';
                    document.body.appendChild(notification);

                    setTimeout(() => {
                        notification.remove();
                    }, 2000);
                }
            }, true);
        });
    </script>
    <script src="{{ asset('backend_admin/js/jquery-1.11.1.min.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">

    <!-- Include DataTables JavaScript -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#user-table').DataTable();
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    @if (session('error'))
        <script>
            $(document).ready(function () {
                toastr.error("{{ session('error') }}", "Lỗi!");
            });
        </script>
    @endif
    <script>
        @if (session('success'))
            toastMessage("{{ session('success') }}", 'success');
        @endif

        @if (session('error'))
            toastMessage("{{ session('error') }}", 'error');
        @endif

        function toastMessage(message, type = 'success') {
            const toast = document.createElement('div');
            toast.className = `toast toast-${type}`;
            toast.textContent = message;
            document.body.appendChild(toast);
            setTimeout(() => {
                toast.remove();
            }, 3000);
        }
    </script>

    <style>
        .toast {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 12px 20px;
            color: #fff;
            border-radius: 4px;
            z-index: 9999;
            font-size: 15px;
            animation: slideDown 0.5s ease;
        }

        .toast-success {
            background-color: #28a745;
        }

        .toast-error {
            background-color: #dc3545;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
 <script src="https://www.google.com/recaptcha/api.js" async defer></script>
 <script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const suggestionsList = document.getElementById('search-suggestions');
    let jobsList = [];

    // Tải dữ liệu từ file jobs.json
    fetch('/json/jobs.json')
        .then(response => response.json())
        .then(data => {
            jobsList = data;
        })
        .catch(error => {
            console.error('Error loading jobs.json:', error);
        });

    // Xử lý sự kiện nhập tìm kiếm
    searchInput.addEventListener('input', function() {
        const keyword = searchInput.value.trim().toLowerCase();

        if (keyword.length < 2) {
            suggestionsList.style.display = 'none';
            return;
        }

        // Lọc các job title phù hợp với từ khóa
        const matchedJobs = jobsList.filter(job =>
            job.title.toLowerCase().includes(keyword)
        ).slice(0, 10); // Giới hạn 10 kết quả

        suggestionsList.innerHTML = '';

        if (matchedJobs.length > 0) {
            matchedJobs.forEach(job => {
                const li = document.createElement('li');
                li.textContent = job.title;
                li.setAttribute('data-slug', job.slug);

                li.addEventListener('click', function() {
                    searchInput.value = job.title;
                    suggestionsList.style.display = 'none';
                    // window.location.href = `/jobs/${job.slug}`;
                });

                suggestionsList.appendChild(li);
            });

            suggestionsList.style.display = 'block';
        } else {
            suggestionsList.style.display = 'none';
        }
    });

    // Ẩn danh sách gợi ý khi click ra ngoài
    document.addEventListener('click', function(event) {
        if (!searchInput.contains(event.target) && !suggestionsList.contains(event.target)) {
            suggestionsList.style.display = 'none';
        }
    });

    // Xử lý phím mũi tên và Enter cho danh sách gợi ý
    searchInput.addEventListener('keydown', function(e) {
        const items = suggestionsList.querySelectorAll('li');

        if (items.length === 0) return;

        const key = e.key;
        const activeClass = 'active-suggestion';
        const activeItem = suggestionsList.querySelector('.' + activeClass);

        if (key === 'ArrowDown' || key === 'ArrowUp') {
            e.preventDefault();

            if (!activeItem) {
                // Không có item nào đang active
                if (key === 'ArrowDown') {
                    items[0].classList.add(activeClass);
                } else {
                    items[items.length - 1].classList.add(activeClass);
                }
            } else {
                // Đã có item active
                const currentIndex = Array.from(items).indexOf(activeItem);
                activeItem.classList.remove(activeClass);

                if (key === 'ArrowDown') {
                    const nextIndex = (currentIndex + 1) % items.length;
                    items[nextIndex].classList.add(activeClass);
                } else {
                    const prevIndex = (currentIndex - 1 + items.length) % items.length;
                    items[prevIndex].classList.add(activeClass);
                }
            }

            // Scroll đến item active để luôn nhìn thấy
            const newActiveItem = suggestionsList.querySelector('.' + activeClass);
            if (newActiveItem) {
                newActiveItem.scrollIntoView({ block: 'nearest' });
            }
        } else if (key === 'Enter' && activeItem) {
            e.preventDefault();
            searchInput.value = activeItem.textContent;
            suggestionsList.style.display = 'none';
        }
    });
});
</script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        @if (session('success'))
            toastr.success("{{ session('success') }}");
        @endif

        @if (session('error'))
            toastr.error("{{ session('error') }}");
        @endif

        @if (session('warning'))
            toastr.warning("{{ session('warning') }}");
        @endif

        @if (session('info'))
            toastr.info("{{ session('info') }}");
        @endif
    </script>
    <style>
        /* Màu cho success */
        .toast-success {
            background-color: #51A351 !important;
        }

        /* Màu cho error */
        .toast-error {
            background-color: #BD362F !important;
        }

        /* Màu cho info */
        .toast-info {
            background-color: #2F96B4 !important;
        }

        /* Màu cho warning */
        .toast-warning {
            background-color: #F89406 !important;
        }

        /* Màu chữ cho tất cả loại thông báo */
        .toast-message {
            color: white !important;
        }

    </style>
    <!-- QR Code Modal -->
<div id="qr-modal" class="qr-modal" style="display: none;">
    <div class="qr-modal-content">
        <span class="qr-close">&times;</span>
        <h3>Quét QR Code để tải ứng dụng</h3>
        <div id="qr-code"></div>
        <p>Hoặc <a href="https://www.vieclamtainamchau.com/vieclamtainamchau.apk" download>tải trực tiếp tại đây</a></p>
    </div>
</div>

<script>
// Tạo QR Code đơn giản bằng API
function generateQRCode() {
    const qrCodeDiv = document.getElementById('qr-code');
    const url = 'https://www.vieclamtainamchau.com/vieclamtainamchau.apk';
    const qrApiUrl = `https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=${encodeURIComponent(url)}`;

    qrCodeDiv.innerHTML = `<img src="${qrApiUrl}" alt="QR Code" style="border: 2px solid #ddd; border-radius: 5px;">`;
}

// Chạy khi DOM đã load
document.addEventListener('DOMContentLoaded', function() {
    // Tạo QR Code
    generateQRCode();

    // Modal functionality
    const modal = document.getElementById('qr-modal');
    const qrLink = document.getElementById('qr-link');
    const closeBtn = document.querySelector('.qr-close');

    if (qrLink && modal && closeBtn) {
        qrLink.onclick = function(e) {
            e.preventDefault();
            modal.style.display = 'block';
        }

        closeBtn.onclick = function() {
            modal.style.display = 'none';
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = 'none';
            }
        }
    }
});
</script>

<style>
.qr-modal {
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0,0.5);
}

.qr-modal-content {
    background-color: #fefefe;
    margin: 15% auto;
    padding: 20px;
    border-radius: 10px;
    width: 300px;
    text-align: center;
    position: relative;
}

.qr-close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
    position: absolute;
    right: 15px;
    top: 10px;
    cursor: pointer;
}

.qr-close:hover,
.qr-close:focus {
    color: #000;
}

#qr-code canvas {
    border: 2px solid #ddd;
    border-radius: 5px;
}
</style>

</body>

</html>
