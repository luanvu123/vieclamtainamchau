@extends('layout')
@section('content')
    <section class="hotlines-section">
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

            <div class="container">
                <div class="pricing-section">
                    <h2>Tin đăng tuyển dụng</h2>

                    @foreach ($services as $service)

                        <div class="pricing-card">
                            <div class="pricing-image">
                                <img src="{{ $service->image ? asset('storage/' . $service->image) : asset('backend/images/banner-01.jpg') }}"
                                    alt="{{ $service->name }}">
                            </div>

                            <div class="pricing-info">
                                <div class="pricing-title">
                                    {{ $service->name }}
                                    <span class="info-icon" title="{!! $service->description !!}">ⓘ</span>
                                </div>

                                <div class="pricing-description">
                                    {!! $service->description !!}
                                </div>

                                <div class="pricing-details">
                                    <div class="pricing-column">
                                        <div class="pricing-label">Số lượng</div>
                                        <div class="quantity-control">
                                            <button class="quantity-btn">-</button>
                                            <input type="text" class="quantity-input" value="1">
                                            <button class="quantity-btn">+</button>
                                        </div>
                                    </div>

                                    <div class="pricing-column">
                                        <div class="pricing-label">Thời lượng</div>
                                        <div>
                                            @if ($service->weeks->count())
                                                @foreach ($service->weeks as $week)
                                                    <div>{{ $week->number_of_weeks }} tuần</div>
                                                @endforeach
                                            @else
                                                <div>Không có dữ liệu</div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="pricing-column">
                                        <div class="pricing-label">Giá bán</div>
                                        <div class="price">₫{{ number_format($service->price, 0, ',', '.') }}</div>
                                    </div>
                                </div>
                            </div>

                            <button class="add-to-cart">
                                <i>🛒</i> Thêm vào giỏ
                            </button>
                        </div>

                    @endforeach

                </div>
            </div>

            <div class="modal-overlay" id="overlay"></div>
            <div class="cart-modal" id="cartModal">
                <div class="cart-header">
                    <div class="cart-title">
                        <i>🛒</i> Giỏ hàng<span class="cart-count">(2)</span>
                    </div>
                    <button class="close-btn">&times;</button>
                </div>

                <div class="cart-items">
                    <div class="cart-item">
                        <div class="cart-item-info">
                            <div class="cart-item-name">Tin cơ bản</div>
                            <div class="cart-item-duration">4 tuần</div>
                        </div>

                        <div class="cart-item-quantity">
                            <button class="quantity-btn">-</button>
                            <input type="text" class="quantity-input" value="2" style="width: 40px;">
                            <button class="quantity-btn">+</button>
                            <span style="margin-left: 5px;">tin</span>
                        </div>

                        <div class="cart-item-price">₫3,440,000</div>
                        <button class="delete-item">🗑️</button>
                    </div>

                    <div class="cart-item">
                        <div class="cart-item-info">
                            <div class="cart-item-name">Trang chủ - Tuyển gấp</div>
                            <div class="cart-item-duration">2 tuần</div>
                        </div>

                        <div class="cart-item-quantity">
                            <button class="quantity-btn">-</button>
                            <input type="text" class="quantity-input" value="1" style="width: 40px;">
                            <button class="quantity-btn">+</button>
                            <span style="margin-left: 5px;">tin</span>
                        </div>

                        <div class="cart-item-price">₫6,520,000</div>
                        <button class="delete-item">🗑️</button>
                    </div>
                </div>

                <div class="cart-footer">
                    <div class="cart-total">Tổng giá (Chưa bao gồm thuế VAT): <span>₫9,960,000</span></div>
                    <button class="checkout-btn">Đặt mua</button>
                </div>
            </div>

            <button class="cart-button">
                <i>🛒</i> 2 sản phẩm
                <span style="margin-left: 5px;">▲</span>
            </button>

            <script>
                // Simple toggle functionality for demonstration
                const cartBtn = document.querySelector('.cart-button');
                const closeBtn = document.querySelector('.close-btn');
                const cartModal = document.getElementById('cartModal');
                const overlay = document.getElementById('overlay');

                cartBtn.addEventListener('click', () => {
                    cartModal.style.display = 'block';
                    overlay.style.display = 'block';
                });

                closeBtn.addEventListener('click', () => {
                    cartModal.style.display = 'none';
                    overlay.style.display = 'none';
                });

                // Initialize for demonstration
                cartModal.style.display = 'block';
                overlay.style.display = 'block';
            </script>
            <style>
                .services {
                    display: flex;
                    justify-content: space-between;
                    flex-wrap: wrap;
                    margin-bottom: 30px;
                }

                .service-card {
                    background: white;
                    width: 19%;
                    padding: 20px;
                    border-radius: 10px;
                    text-align: center;
                    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
                    transition: transform 0.3s;
                }

                .service-card:hover {
                    transform: translateY(-5px);
                }

                .service-icon {
                    width: 60px;
                    height: 60px;
                    margin: 10px auto;
                }

                .service-title {
                    font-size: 16px;
                    font-weight: bold;
                    margin-top: 10px;
                }

                .pricing-section {
                    margin: 30px 0;
                }

                .pricing-section h2 {
                    font-size: 24px;
                    margin-bottom: 20px;
                }

                .pricing-card {
                    background: white;
                    padding: 20px;
                    border-radius: 10px;
                    margin-bottom: 20px;
                    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
                    display: flex;
                    align-items: center;
                    position: relative;
                    width: 801px;
                }

                .pricing-image {
                    width: 200px;
                    height: 150px;
                    margin-right: 20px;
                    border-radius: 5px;
                    overflow: hidden;
                }

                .pricing-info {
                    flex: 1;
                }

                .pricing-title {
                    font-size: 18px;
                    font-weight: bold;
                    margin-bottom: 5px;
                    display: flex;
                    align-items: center;
                }

                .info-icon {
                    margin-left: 5px;
                    color: #999;
                    font-size: 16px;
                }

                .pricing-description {
                    color: #666;
                    font-size: 14px;
                    margin-bottom: 10px;
                }

                .pricing-details {
                    display: flex;
                    margin: 15px 0;
                }

                .pricing-column {
                    margin-right: 30px;
                }

                .pricing-label {
                    font-size: 14px;
                    color: #666;
                }

                .price {
                    font-size: 18px;
                    font-weight: bold;
                    color: #6200ee;
                }

                .quantity-control {
                    display: flex;
                    align-items: center;
                    border: 1px solid #ddd;
                    border-radius: 5px;
                    overflow: hidden;
                    width: 120px;
                }

                .quantity-btn {
                    width: 30px;
                    height: 30px;
                    background: #f5f5f5;
                    border: none;
                    font-size: 18px;
                    cursor: pointer;
                }

                .quantity-input {
                    width: 60px;
                    height: 30px;
                    border: none;
                    text-align: center;
                    font-size: 14px;
                }

                .add-to-cart {
                    background-color: #f0f7ff;
                    color: #6200ee;
                    border: 1px solid #6200ee;
                    padding: 10px 15px;
                    border-radius: 5px;
                    font-weight: bold;
                    cursor: pointer;
                    display: flex;
                    align-items: center;
                    position: absolute;
                    right: 20px;
                    bottom: 20px;
                }

                .add-to-cart i {
                    margin-right: 5px;
                }

                .cart-modal {
                    position: fixed;
                    top: 50%;
                    left: 50%;
                    transform: translate(-50%, -50%);
                    background: white;
                    width: 600px;
                    border-radius: 10px;
                    box-shadow: 0 5px 25px rgba(0, 0, 0, 0.2);
                    z-index: 1000;
                }

                .cart-header {
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                    padding: 15px 20px;
                    border-bottom: 1px solid #eee;
                }

                .cart-title {
                    display: flex;
                    align-items: center;
                    font-size: 18px;
                    font-weight: bold;
                }

                .cart-title i {
                    margin-right: 10px;
                    color: #6200ee;
                }

                .close-btn {
                    font-size: 24px;
                    background: none;
                    border: none;
                    cursor: pointer;
                    color: #666;
                }

                .cart-items {
                    padding: 10px 20px;
                }

                .cart-item {
                    padding: 15px 0;
                    border-bottom: 1px solid #eee;
                    display: flex;
                    align-items: center;
                }

                .cart-item-info {
                    flex: 1;
                }

                .cart-item-name {
                    font-weight: bold;
                    margin-bottom: 5px;
                }

                .cart-item-duration {
                    color: #666;
                    font-size: 14px;
                }

                .cart-item-quantity {
                    display: flex;
                    align-items: center;
                    margin: 0 20px;
                }

                .cart-item-price {
                    font-weight: bold;
                    color: #6200ee;
                    width: 120px;
                    text-align: right;
                }

                .delete-item {
                    color: #999;
                    background: none;
                    border: none;
                    cursor: pointer;
                    margin-left: 10px;
                    font-size: 18px;
                }

                .cart-footer {
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                    padding: 15px 20px;
                    background: #f9f9f9;
                    border-radius: 0 0 10px 10px;
                }

                .cart-total {
                    font-size: 18px;
                    color: #333;
                }

                .cart-total span {
                    font-weight: bold;
                    color: #6200ee;
                }

                .checkout-btn {
                    background-color: #6200ee;
                    color: white;
                    border: none;
                    padding: 10px 30px;
                    border-radius: 5px;
                    font-weight: bold;
                    cursor: pointer;
                }

                .cart-count {
                    background: #6200ee;
                    color: white;
                    border-radius: 50%;
                    width: 20px;
                    height: 20px;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    font-size: 12px;
                    margin-left: 5px;
                }

                .modal-overlay {
                    position: fixed;
                    top: 0;
                    left: 0;
                    right: 0;
                    bottom: 0;
                    background: rgba(0, 0, 0, 0.5);
                    z-index: 999;
                }

                .cart-button {
                    position: fixed;
                    bottom: 20px;
                    left: 200px;
                    background: #6200ee;
                    color: white;
                    border: none;
                    padding: 10px 15px;
                    border-radius: 5px;
                    font-weight: bold;
                    cursor: pointer;
                    display: flex;
                    align-items: center;
                }

                .cart-button i {
                    margin-right: 5px;
                }
            </style>
        </div>
    </section>
@endsection
