@extends('layout')
@section('content')
    <div class="container">
        <div class="sidebar">
            <div class="menu-section">
                <div class="menu-title">Quản lý đăng tuyển dụng</div>
                <a href="{{ route('employer.job-posting.create') }}" class="menu-item">
                    <i>+</i>
                    <span>Tạo tin tuyển dụng</span>
                </a>
                <a href="{{ route('employer.job-posting.index') }}" class="menu-item">
                    <i>📋</i>
                    <span>Quản lý tin đăng</span>
                </a>
                <a href="{{ route('employer.services') }}" class="menu-item">
                    <i>📊</i>
                    <span>Mua dịch vụ</span>
                </a>
                <a href="{{ route('employer.service-active') }}" class="menu-item">
                    <i>❤️</i>
                    <span>Dịch vụ đã mua</span>
                </a>
            </div>

            <div class="menu-section">
                <div class="menu-title">Quản lý ứng viên</div>
                <a href="{{ route('employer.saved-applications') }}" class="menu-item">
                    <i>👥</i>
                    <span>Hồ sơ ứng tuyển</span>
                </a>
                <a href="{{ route('employer.job-posting.find-candidate') }}" class="menu-item">
                    <i>🔍</i>
                    <span>Tìm ứng viên mới</span>
                </a>
            </div>
        </div>

        <div class="main-content">

            <h1 class="mb-4">Mua dịch vụ</h1>
            <h2>Vui lòng liên hệ:0987654321 để được hỗ trợ</h2>

            <div class="services-container">
                <!-- Services Section -->
                <section class="services-section">
                    <div class="container mx-auto px-4 py-8">
                        <div class="services-grid">
                            @foreach ($services as $service)
                                <div class="service-card">
                                    <div class="service-image">
                                        <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->name }}"
                                            class="service-img">
                                    </div>
                                    <div class="service-content">
                                        <h3 class="service-title">{{ $service->name }}</h3>
                                        <div class="service-price">
                                            {{ number_format($service->price, 0, ',', '.') }} VNĐ
                                        </div>
                                        <p class="service-description">
                                            {{ $service->description }}
                                        </p>
                                        <button onclick="showPaymentInfo('{{ $service->id }}')" class="buy-button">
                                            Đăng ký ngay
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </section>

                <!-- Banking Information Section -->
                <section class="banking-section" id="bankingInfo">
                    <div class="container mx-auto px-4 py-8">
                        <div class="banks-grid">
                            @foreach ($banks as $bank)
                                <div class="bank-card">
                                    <div class="bank-logo">
                                        <img src="{{ asset('storage/' . $bank->logo_bank) }}" alt="{{ $bank->name }}"
                                            class="bank-logo-img">
                                    </div>
                                    <div class="bank-info">
                                        <h3 class="bank-name">{{ $bank->name }}</h3>
                                        <div class="bank-details">
                                            <p><strong>Chi nhánh:</strong> {{ $bank->branch }}</p>
                                            <p><strong>Số tài khoản:</strong> {{ $bank->account_number }}</p>
                                            <p><strong>Chủ tài khoản:</strong> {{ $bank->area }}</p>
                                        </div>
                                        <div class="bank-content">
                                            <p><strong>Nội dung chuyển khoản:</strong></p>
                                            <p class="transfer-content">{!! $bank->content !!}</p>
                                            <button onclick="copyContent('{!! $bank->content !!}')" class="copy-button">
                                                Sao chép
                                            </button>
                                        </div>
                                        @if ($bank->image)
                                            <div class="qr-code">
                                                <img src="{{ asset('storage/' . $bank->image) }}" alt="QR Code"
                                                    class="qr-code-img">
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </section>
            </div>

            <style>
                .services-grid {
                    display: grid;
                    grid-template-columns: repeat(2, 1fr);
                    /* Mỗi hàng 2 cột */
                    gap: 20px;
                    /* Khoảng cách giữa các thẻ */
                    padding: 20px;
                }

                .service-card {
                    background-color: #fff;
                    border: 1px solid #ddd;
                    border-radius: 10px;
                    overflow: hidden;
                    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                    transition: transform 0.3s, box-shadow 0.3s;
                }

                .service-card:hover {
                    transform: translateY(-5px);
                    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
                }

                .service-image {
                    width: 100%;
                    height: 200px;
                    overflow: hidden;
                    border-bottom: 1px solid #ddd;
                }

                .service-img {
                    width: 100%;
                    height: 100%;
                    object-fit: cover;
                    /* Đảm bảo ảnh vừa khít vùng hiển thị */
                }

                .service-content {
                    padding: 15px;
                    text-align: center;
                }

                .service-title {
                    font-size: 1.2rem;
                    font-weight: bold;
                    margin-bottom: 10px;
                    color: #333;
                }

                .service-price {
                    font-size: 1.1rem;
                    font-weight: bold;
                    color: #e74c3c;
                    margin-bottom: 10px;
                }

                .service-description {
                    font-size: 0.9rem;
                    color: #666;
                    margin-bottom: 15px;
                }

                .buy-button {
                    background-color: #f61616;
                    color: #fff;
                    border: none;
                    border-radius: 5px;
                    padding: 10px 15px;
                    font-size: 1rem;
                    cursor: pointer;
                    transition: background-color 0.3s;
                }

                .buy-button:hover {
                    background-color: #f70505;
                }


                /* Banking Section Styles */
                .banking-section {
                    background-color: white;
                    padding: 2rem 0;
                }

                .banks-grid {
                    display: grid;
                    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
                    gap: 2rem;
                }

                .bank-card {
                    border: 1px solid #e5e7eb;
                    border-radius: 8px;
                    padding: 1.5rem;
                    background-color: #f8fafc;
                }

                .bank-logo {
                    width: 120px;
                    height: 60px;
                    margin-bottom: 1rem;
                }

                .bank-logo-img {
                    width: 100%;
                    height: 100%;
                    object-fit: contain;
                }

                .bank-name {
                    font-size: 1.25rem;
                    font-weight: bold;
                    margin-bottom: 1rem;
                }

                .bank-details {
                    margin-bottom: 1rem;
                }

                .bank-details p {
                    margin-bottom: 0.5rem;
                }

                .transfer-content {
                    background-color: #e5e7eb;
                    padding: 0.5rem;
                    border-radius: 4px;
                    font-family: monospace;
                    margin: 0.5rem 0;
                }

                .copy-button {
                    padding: 0.5rem 1rem;
                    background-color: #4b5563;
                    color: white;
                    border: none;
                    border-radius: 4px;
                    cursor: pointer;
                    transition: background-color 0.3s ease;
                }

                .copy-button:hover {
                    background-color: #374151;
                }

                .qr-code {
                    margin-top: 1rem;
                    text-align: center;
                }

                .qr-code-img {
                    max-width: 200px;
                    height: auto;
                }

                @media (max-width: 768px) {

                    .services-grid,
                    .banks-grid {
                        grid-template-columns: 1fr;
                    }
                }
            </style>

            <script>
                function showPaymentInfo(serviceId) {
                    const bankingSection = document.getElementById('bankingInfo');
                    bankingSection.scrollIntoView({
                        behavior: 'smooth'
                    });
                }

                function copyContent(content) {
                    navigator.clipboard.writeText(content).then(() => {
                        alert('Đã sao chép nội dung chuyển khoản!');
                    }).catch(err => {
                        console.error('Không thể sao chép: ', err);
                    });
                }
            </script>

        </div>
    </div>
@endsection
