@extends('layouts.manage')
@section('content')


        <div class="main-content">

            <div class="container">
                <div class="pricing-section">
                    <h2>Tin đăng tuyển dụng</h2>

                    @foreach ($services as $service)

                        <div class="pricing-card" data-service-id="{{ $service->id }}">
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
                                        <select class="week-selector">
                                            @if ($service->weeks->count())
                                                @foreach ($service->weeks as $week)
                                                    <option value="{{ $week->number_of_weeks }}">{{ $week->number_of_weeks }} tuần
                                                    </option>
                                                @endforeach
                                            @else
                                                <option value="1">1 tuần</option>
                                            @endif
                                        </select>
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
                    @foreach ($carts as $cart)
                        <div class="cart-item">
                            <div class="cart-item-info">
                                <div class="cart-item-name">{{ $cart->service->name }}</div>
                                <div class="cart-item-duration">{{ $cart->number_of_weeks }} tuần</div>
                            </div>

                            <div class="cart-item-quantity">
                                <button class="quantity-btn" disabled>-</button>
                                <input type="text" class="quantity-input" value="{{ $cart->quantity }}" readonly
                                    style="width: 40px;">
                                <button class="quantity-btn" disabled>+</button>
                                <span style="margin-left: 5px;">tin</span>
                            </div>


                            <div class="cart-item-price">
                                ₫{{ number_format($cart->total_price, 0) }} <br>
                                <small>(${{ number_format($cart->total_price * $exchangeRate, 2) }})</small>
                            </div>
                            <button class="delete-item" data-id="{{ $cart->id }}">🗑️</button>

                        </div>
                    @endforeach
                </div>


                @php
                    $totalVND = $carts->sum('total_price');
                    $totalUSD = $totalVND * $exchangeRate;
                @endphp

                <div class="cart-footer">
                    <div class="cart-total">
                        Tổng giá (Chưa bao gồm thuế VAT):
                        <span>
                            ₫{{ number_format($totalVND, 0) }}
                            ( ${{ number_format($totalUSD, 2) }} )
                        </span>
                    </div>
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
            <script>
                // JavaScript for cart functionality
                document.addEventListener('DOMContentLoaded', function () {
                    // Cart modal elements
                    const cartBtn = document.querySelector('.cart-button');
                    const closeBtn = document.querySelector('.close-btn');
                    const cartModal = document.getElementById('cartModal');
                    const overlay = document.getElementById('overlay');
                    const addToCartButtons = document.querySelectorAll('.add-to-cart');

                    // Initialize cart display
                    updateCartButton();

                    // Handle opening and closing cart modal
                    if (cartBtn) {
                        cartBtn.addEventListener('click', () => {
                            cartModal.style.display = 'block';
                            overlay.style.display = 'block';
                        });
                    }

                    if (closeBtn) {
                        closeBtn.addEventListener('click', () => {
                            cartModal.style.display = 'none';
                            overlay.style.display = 'none';
                        });
                    }

                    // Add to cart button click handlers
                    addToCartButtons.forEach(button => {
                        button.addEventListener('click', function (e) {
                            const card = this.closest('.pricing-card');
                            const serviceId = card.dataset.serviceId;
                            const quantityInput = card.querySelector('.quantity-input');
                            const quantity = parseInt(quantityInput.value);
                            const weekSelector = card.querySelector('.week-selector');
                            const numberOfWeeks = weekSelector ? parseInt(weekSelector.value) : 1;

                            // Add visual effect - button animation
                            this.classList.add('adding');

                            // AJAX call to add to cart
                            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                            fetch('/employer/add-to-cart', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': csrfToken
                                },
                                body: JSON.stringify({
                                    service_id: serviceId,
                                    quantity: quantity,
                                    number_of_weeks: numberOfWeeks
                                })
                            })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.success) {
                                        // Show success notification
                                        showNotification(data.message);

                                        // Update cart count
                                        updateCartCountDisplay(data.cart_count);

                                        // Animate item flying to cart
                                        animateAddToCart(card, cartBtn);

                                        // Reset button state after animation
                                        setTimeout(() => {
                                            this.classList.remove('adding');
                                        }, 1000);
                                    }
                                })
                                .catch(error => {
                                    console.error('Error adding to cart:', error);
                                    this.classList.remove('adding');
                                    showNotification('Có lỗi xảy ra, vui lòng thử lại sau', 'error');
                                });
                        });
                    });

                    // Function to animate item flying to cart
                    function animateAddToCart(sourceElement, targetElement) {
                        // Create a clone of the service image
                        const serviceImage = sourceElement.querySelector('.pricing-image img');
                        const imgClone = document.createElement('img');
                        imgClone.src = serviceImage.src;
                        imgClone.classList.add('flying-item');

                        // Calculate positions
                        const sourceRect = serviceImage.getBoundingClientRect();
                        const targetRect = targetElement.getBoundingClientRect();

                        // Position the clone at the source position
                        imgClone.style.width = '50px';
                        imgClone.style.height = '50px';
                        imgClone.style.position = 'fixed';
                        imgClone.style.top = sourceRect.top + 'px';
                        imgClone.style.left = sourceRect.left + 'px';
                        imgClone.style.zIndex = '9999';
                        imgClone.style.borderRadius = '50%';
                        imgClone.style.opacity = '0.8';
                        imgClone.style.transition = 'all 0.8s cubic-bezier(0.18, 0.89, 0.32, 1.28)';

                        // Add the clone to the DOM
                        document.body.appendChild(imgClone);

                        // Start the animation after a small delay to ensure the transition works
                        setTimeout(() => {
                            imgClone.style.top = targetRect.top + 'px';
                            imgClone.style.left = targetRect.left + 'px';
                            imgClone.style.width = '20px';
                            imgClone.style.height = '20px';
                            imgClone.style.opacity = '0.2';

                            // Shake the cart button
                            targetElement.classList.add('cart-shake');

                            // Remove the clone and the shake effect after animation completes
                            setTimeout(() => {
                                imgClone.remove();
                                targetElement.classList.remove('cart-shake');
                            }, 800);
                        }, 10);
                    }

                    // Function to show notification
                    function showNotification(message, type = 'success') {
                        const notification = document.createElement('div');
                        notification.className = `notification ${type}`;
                        notification.innerHTML = message;
                        document.body.appendChild(notification);

                        // Show notification
                        setTimeout(() => {
                            notification.style.opacity = '1';
                            notification.style.transform = 'translateY(0)';
                        }, 10);

                        // Auto hide after delay
                        setTimeout(() => {
                            notification.style.opacity = '0';
                            notification.style.transform = 'translateY(-20px)';

                            // Remove from DOM after fade out
                            setTimeout(() => {
                                notification.remove();
                            }, 500);
                        }, 3000);
                    }

                    // Function to update cart count display
                    function updateCartCountDisplay(count) {
                        const cartCountElements = document.querySelectorAll('.cart-count');
                        cartCountElements.forEach(element => {
                            element.textContent = `(${count})`;
                        });

                        if (cartBtn) {
                            cartBtn.innerHTML = `<i>🛒</i> ${count} sản phẩm <span style="margin-left: 5px;">▲</span>`;
                        }
                    }

                    // Function to update cart button visibility based on cart contents
                    function updateCartButton() {
                        fetch('/employer/get-cart-count', {
                            method: 'GET',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            }
                        })
                            .then(response => response.json())
                            .then(data => {
                                updateCartCountDisplay(data.cart_count);

                                if (cartBtn) {
                                    if (data.cart_count > 0) {
                                        cartBtn.style.display = 'flex';
                                    } else {
                                        cartBtn.style.display = 'none';
                                    }
                                }
                            })
                            .catch(error => {
                                console.error('Error fetching cart count:', error);
                            });
                    }

                    // Quantity control buttons
                    const quantityBtns = document.querySelectorAll('.quantity-btn');
                    quantityBtns.forEach(btn => {
                        btn.addEventListener('click', function () {
                            const input = this.parentElement.querySelector('.quantity-input');
                            let value = parseInt(input.value);

                            if (this.textContent === '+') {
                                value++;
                            } else if (this.textContent === '-' && value > 1) {
                                value--;
                            }

                            input.value = value;
                        });
                    });

                      const checkoutBtn = document.querySelector('.checkout-btn');
        if (checkoutBtn) {
            checkoutBtn.addEventListener('click', function() {
                // Show loading state
                checkoutBtn.textContent = 'Đang xử lý...';
                checkoutBtn.disabled = true;

                // Send checkout request
                fetch('{{ route("employer.orders.checkout") }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({})
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Show success message
                        alert(data.message);

                        // Redirect to order page
                        if (data.redirect) {
                            window.location.href = data.redirect;
                        } else {
                            // Refresh the page if no redirect URL
                            window.location.reload();
                        }
                    } else {
                        // Show error message
                        alert(data.message || 'Đã xảy ra lỗi khi xử lý đơn hàng.');

                        // Reset button state
                        checkoutBtn.textContent = 'Đặt mua';
                        checkoutBtn.disabled = false;
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Đã xảy ra lỗi khi xử lý đơn hàng.');

                    // Reset button state
                    checkoutBtn.textContent = 'Đặt mua';
                    checkoutBtn.disabled = false;
                });
            });
        }
                });
            </script>
            <style>
                /* Add to cart effects */
                .add-to-cart {
                    transition: all 0.3s ease;
                }

                .add-to-cart.adding {
                    background-color: #4CAF50;
                    transform: scale(0.95);
                }

                .cart-shake {
                    animation: shake 0.5s cubic-bezier(.36, .07, .19, .97) both;
                }

                @keyframes shake {

                    10%,
                    90% {
                        transform: translate3d(-1px, 0, 0);
                    }

                    20%,
                    80% {
                        transform: translate3d(2px, 0, 0);
                    }

                    30%,
                    50%,
                    70% {
                        transform: translate3d(-2px, 0, 0);
                    }

                    40%,
                    60% {
                        transform: translate3d(2px, 0, 0);
                    }
                }

                /* Notification styling */
                .notification {
                    position: fixed;
                    top: 20px;
                    right: 20px;
                    padding: 15px 25px;
                    background-color: #4CAF50;
                    color: white;
                    border-radius: 4px;
                    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
                    z-index: 10000;
                    opacity: 0;
                    transform: translateY(-20px);
                    transition: all 0.3s ease;
                }

                .notification.error {
                    background-color: #f44336;
                }

                /* Flying item animation */
                .flying-item {
                    object-fit: cover;
                    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
                }

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

    <script>
        document.querySelectorAll('.delete-item').forEach(button => {
            button.addEventListener('click', function () {
                const cartId = this.dataset.id;
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                const cartItem = this.closest('.cart-item');

                if (confirm('Bạn có chắc chắn muốn xoá dịch vụ này khỏi giỏ hàng?')) {
                    fetch(`/employer/cart/${cartId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        }
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                showNotification(data.message);
                                cartItem.remove();
                                // Cập nhật lại tổng giỏ hàng nếu cần
                            }
                        })
                        .catch(error => {
                            console.error('Lỗi khi xoá dịch vụ:', error);
                            showNotification('Có lỗi xảy ra, vui lòng thử lại sau.', 'error');
                        });
                }
            });
        });

    </script>
@endsection
