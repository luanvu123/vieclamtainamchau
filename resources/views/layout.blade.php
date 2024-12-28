<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@3.1.0/dist/css/multi-select-tag.css">
    <title>Job Portal</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
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

        .category-card.hot-effect {
            border: 2px solid #ff6b6b;
            box-shadow: 0 4px 15px rgba(255, 107, 107, 0.2);
            transform: translateY(-3px);
        }

        .category-card.hot-effect::before {
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
            z-index: 1;
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
            color: #00ffff;
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

        /* CSS cho overlay và xử lý tương tác */
        .site-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(1px);
            z-index: 998;
            pointer-events: none;
            /* Cho phép scroll qua overlay */
        }

        /* Vô hiệu hóa click cho toàn bộ trang */
        body:has(.site-overlay) * {
            pointer-events: none;
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
        .site-overlay~* a,
        .site-overlay~* button,
        .site-overlay~* input,
        .site-overlay~* select {
            opacity: 0.7;
            cursor: not-allowed;
            user-select: none;
        }

        /* Khôi phục style cho elements trong modal */
        .warning-modal a,
        .warning-modal button,
        .warning-modal input {
            opacity: 1 !important;
            cursor: pointer !important;
            user-select: auto !important;
        }

        /* Hiệu ứng hover cho elements không thể click */
        .site-overlay~* a:hover,
        .site-overlay~* button:hover {
            position: relative;
        }

        .site-overlay~* a:hover::after,
        .site-overlay~* button:hover::after {
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

        /* Responsive Styles */
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
                <img src="{{ asset('frontend/img/logo.png') }}" style="width:200px;height:200px;" alt="Logo">
                <h1>VIỆC LÀM TẠI NĂM CHÂU</h1>
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
                <li><a href="{{ route('site.countries') }}">Việc làm</a></li>
                @if (isset($genre_home) && $genre_home->count() > 0)
                    @foreach ($genre_home as $genre)
                        <li><a href="{{ route('genre.show', $genre->slug) }}">{{ $genre->name }}</a></li>
                    @endforeach
                @endif
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
                    <div class="modal-title-group" style="margin-left: 240px;">
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
                width: 60px;
                height: 60px;
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
                top: 0px;
                right: 0px;
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
            <div class="footer-links">
                <h3>Trang chủ</h3>
                <ul>
                    <li><a href="{{ route('about') }}">Về chúng tôi</a></li>
                    <li><a href="{{ route('employer.services') }}">Bảng giá dịch vụ</a></li>
                    <li><a href="{{ route('candidate.login') }}">Người tìm việc</a></li>
                    <li><a href="{{ route('employer.login') }}">Nhà tuyển dụng</a></li>
                </ul>
            </div>

            <div class="footer-links">
                <h3>Hỗ trợ</h3>
                <ul>
                    <li><a href="{{ route('hotline') }}">Liên hệ với chúng tôi</a></li>
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
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const warningModal = document.getElementById("warningModal");
            const closeModal = document.getElementById("closeModal");

            if (warningModal && closeModal) {
                // Đóng modal
                closeModal.addEventListener("click", function() {
                    warningModal.style.display = "none";
                    document.body.classList.remove("modal-active");
                });

                // Hiển thị modal
                document.body.classList.add("modal-active");
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@3.1.0/dist/js/multi-select-tag.js"></script>
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
    <script src="{{ asset('backend_admin/js/jquery-1.11.1.min.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">

    <!-- Include DataTables JavaScript -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#user-table').DataTable();
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('warningModal');
            if (modal) {
                // Prevent closing on click outside
                modal.addEventListener('click', function(e) {
                    if (e.target === modal) {
                        e.preventDefault();
                    }
                });

                // Prevent closing with Escape key
                document.addEventListener('keydown', function(e) {
                    if (e.key === 'Escape') {
                        e.preventDefault();
                    }
                });
            }
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (!document.querySelector('.site-overlay')) return;

            // Chặn sự kiện click trên toàn trang
            document.addEventListener('click', function(e) {
                if (!e.target.closest('.warning-modal')) {
                    e.preventDefault();
                    e.stopPropagation();

                    // Hiển thị thông báo nhỏ khi click
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
                    notification.textContent = 'Vui lòng đăng nhập để tương tác với trang web';
                    document.body.appendChild(notification);

                    setTimeout(() => {
                        notification.remove();
                    }, 2000);
                }
            }, true);

            // Style cho animation thông báo
            const style = document.createElement('style');
            style.textContent = `
        @keyframes fadeInOut {
            0% { opacity: 0; transform: translate(-50%, -20px); }
            15% { opacity: 1; transform: translate(-50%, 0); }
            85% { opacity: 1; transform: translate(-50%, 0); }
            100% { opacity: 0; transform: translate(-50%, -20px); }
        }
    `;
            document.head.appendChild(style);
        });
    </script>
</body>

</html>
