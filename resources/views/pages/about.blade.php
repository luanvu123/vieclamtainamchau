@extends('layout')

@section('content')
    <section class="services">
        <div class="hero-content">
            <h1>Giới thiệu về Báo Online Việt Nam tại năm châu "vieclamnamchau.com"</h1>

            <div class="about-us">
                <h2>Chúng tôi là ai?</h2>
                <p>Những năm ý nghĩ làm một điều gì đó để chúng tôi giúp Cộng Đồng người Việt tại năm châu ngày một phát
                    triển vững mạnh. Chính vì thế Tin tin việc xin việc vieclamnamchau.com cung cấp thông tin và những việc
                    trọng thể về nhu cầu tìm kiếm việc làm nhà ở, sang nhượng business và dịch vụ cho cộng đồng trong được
                    đơn giản, nhanh gọn, dễ dàng hơn.</p>
            </div>
        </div>
        <div class="hero-image">
            <img src="{{ asset('frontend/about.png') }}" alt="Business professional with phone">
        </div>
        <h2>Chúng tôi có thể làm gì cho bạn</h2>

        <p class="highlight">Bạn đang tìm kiếm 1 công việc</p>
        <p>Bạn chưa tự tin vào khả năng tiếng anh của mình bạn muốn tìm công việc full-time, part time sau những giờ đi học.
            Đừng lo, chúng tôi luôn nỗ lực hết mình để đẩy dựng website Vieclamtainamchau.com trở thành kênh chuyên tin về
            Việc làm - Du học - Xuất khẩu lao động - Nhà ở & Dịch vụ cung cấp cho bạn và cộng đồng Việt nam, người Việc tại
            nầm châu, những thông tin hữu ích, công cụ tìm kiếm, cách bố trí thông minh giúp bạn có thể dễ dàng tìm kiếm
            được công việc mình mong muốn.</p>

        <p class="highlight">Bạn là chủ doanh nghiệp, shop, nhà hàng, muốn tìm kiếm nhân viên phù hợp</p>
        <p>Chúng tôi luôn đồng hành, giúp bạn đăng quảng cáo tìm thợ, cho thuê nhà, thuê phòng, sang nhượng business một
            cách nhanh nhất với mục chi phí rất rẻ kèm tới đa cho bạn bằng sự nhiệt tình, tận tâm, hỗ trợ khách hàng 24/7
            của chúng tôi.</p>

        <h2>Các dịch vụ của chúng tôi</h2>
        <ul>
            <li>Đăng tin quảng cáo VIP Post</li>
            <li>Đặt banner trên website, Group Facebook, Pin bài posting</li>
            <li>Viết bài nội dung về dịch vụ, sản phẩm, doanh nghiệp của bạn</li>
            <li>Lập, quản lý và phát triển Fanpage Facebook</li>
            <li>Đăng ký dịch vụ, doanh nghiệp của bạn trên Google Map(hỗ trợ làm SEO local)</li>
            <li>Thiết kế logo, Business card, bảng giá dịch vụ chuyên nghiệp</li>
            <li>Chạy quảng cáo Facebook, Google</li>
            <li>Xây dựng thư viện, đánh giá chiến lượng Marketing plan...</li>
        </ul>

        <a href="#" class="cta-button">Xem bảng giá dịch vụ</a>
    </section>

    <!-- Section: Hotline -->
    <section class="hotlines-section">
        <!-- Job Seekers Column -->
        <div class="hotline-column">
            <h2 class="hotline-title job-seekers">Hotline cho người tìm việc</h2>

            <div class="hotline-info">
                <span class="hotline-label job-seekers">Hotline hỗ trợ</span>
                <span class="hotline-number job-seekers">0567 012 132</span>
            </div>

            <div class="hotline-info">
                <span class="hotline-label job-seekers">Hotline hỗ trợ kỹ thuật</span>
                <span class="hotline-number job-seekers">0567 012 132</span>
            </div>

            <button class="consult-button job-seekers">Tư vấn cho người tìm việc</button>
        </div>

        <!-- Divider -->
        <div class="divider"></div>

        <!-- Employers Column -->
        <div class="hotline-column">
            <h2 class="hotline-title employers">Hotline cho Nhà tuyển dụng</h2>

            <div class="hotline-info">
                <span class="hotline-label employers">Hotline hỗ trợ</span>
                <span class="hotline-number employers">0567 012 132</span>
            </div>

            <div class="hotline-info">
                <span class="hotline-label employers">Hotline hỗ trợ kỹ thuật</span>
                <span class="hotline-number employers">0567 012 132</span>
            </div>

            <button class="consult-button employers">Tư vấn cho Nhà tuyển dụng</button>
        </div>
    </section>
    <style>
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .hero {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 40px;
            margin-bottom: 40px;
        }

        .hero-content {
            flex: 1;
        }

        .hero-image {
            flex: 1;
            text-align: center;
        }

        .hero-image img {
            max-width: 100%;
            height: auto;
        }

        h1 {
            font-size: 24px;
            color: #333;
            margin-bottom: 20px;
        }

        h2 {
            font-size: 20px;
            color: #333;
            margin-bottom: 15px;
        }

        p {
            line-height: 1.6;
            color: #666;
            margin-bottom: 15px;
        }

        .services {
            margin-top: 40px;
        }

        .services ul {
            list-style-type: disc;
            padding-left: 20px;
            margin-bottom: 20px;
        }

        .services li {
            margin-bottom: 10px;
            color: #666;
        }

        .cta-button {
            display: inline-block;
            background-color: #ff0000;
            color: white;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 4px;
            font-weight: bold;
        }

        .highlight {
            color: #ff0000;
            font-weight: bold;
        }

        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
        }

        .modal-content {
            position: relative;
            background-color: #fff;
            margin: 15% auto;
            padding: 20px;
            border-radius: 8px;
            width: 90%;
            max-width: 500px;
            animation: modalFade 0.3s ease-in-out;
        }

        @keyframes modalFade {
            from {
                transform: translateY(-30px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .modal-title {
            font-size: 1.5rem;
            font-weight: bold;
        }

        .modal-title.job-seekers {
            color: #ff0000;
        }

        .modal-title.employers {
            color: #00ffff;
        }

        .close-modal {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            padding: 0;
            color: #666;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
        }

        .input-with-icon {
            display: flex;
            align-items: center;
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 8px 12px;
        }

        .input-with-icon i {
            margin-right: 10px;
            color: #666;
        }

        .input-with-icon input,
        .input-with-icon textarea {
            border: none;
            outline: none;
            width: 100%;
            font-size: 1rem;
        }

        .input-with-icon textarea {
            min-height: 100px;
            resize: vertical;
        }

        .submit-button {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 4px;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .submit-button.job-seekers {
            background-color: #ff0000;
            color: white;
        }

        .submit-button.employers {
            background-color: #00ffff;
            color: black;
        }

        /* Responsive styles */
        @media screen and (max-width: 768px) {
            .modal-content {
                margin: 10% auto;
                width: 95%;
                padding: 15px;
            }

            .modal-title {
                font-size: 1.25rem;
            }
        }

        @media screen and (max-width: 480px) {
            .modal-content {
                margin: 5% auto;
            }

            .form-group label {
                font-size: 0.9rem;
            }

            .input-with-icon {
                padding: 6px 10px;
            }
        }
    </style>

    <!-- Modal HTML -->
    <div id="consultModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Tư vấn</h3>
                <button class="close-modal">&times;</button>
            </div>
            <form id="consultForm">
                <div class="form-group">
                    <label>Số điện thoại</label>
                    <div class="input-with-icon">
                        <i class="fas fa-phone"></i>
                        <input type="tel" name="phone" required placeholder="Nhập số điện thoại">
                    </div>
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <div class="input-with-icon">
                        <i class="fas fa-envelope"></i>
                        <input type="email" name="email" required placeholder="Nhập email">
                    </div>
                </div>

                <div class="form-group">
                    <label>Mô tả</label>
                    <div class="input-with-icon">
                        <i class="fas fa-comment-alt"></i>
                        <textarea name="description-info" required placeholder="Nhập mô tả"></textarea>
                    </div>
                </div>

                <button type="submit" class="submit-button">Gửi thông tin</button>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get modal elements
            const modal = document.getElementById('consultModal');
            const closeBtn = modal.querySelector('.close-modal');
            const form = document.getElementById('consultForm');
            const modalTitle = modal.querySelector('.modal-title');
            const submitButton = modal.querySelector('.submit-button');

            // Get consultation buttons
            const jobSeekerBtn = document.querySelector('.consult-button.job-seekers');
            const employerBtn = document.querySelector('.consult-button.employers');

            // Function to open modal
            function openModal(type) {
                modal.style.display = 'block';
                document.body.style.overflow = 'hidden';

                if (type === 'job-seekers') {
                    modalTitle.textContent = 'Tư vấn cho người tìm việc';
                    modalTitle.className = 'modal-title job-seekers';
                    submitButton.className = 'submit-button job-seekers';
                } else {
                    modalTitle.textContent = 'Tư vấn cho Nhà tuyển dụng';
                    modalTitle.className = 'modal-title employers';
                    submitButton.className = 'submit-button employers';
                }
            }

            // Function to close modal
            function closeModal() {
                modal.style.display = 'none';
                document.body.style.overflow = '';
                form.reset();
            }

            // Event listeners
            jobSeekerBtn.addEventListener('click', () => openModal('job-seekers'));
            employerBtn.addEventListener('click', () => openModal('employers'));
            closeBtn.addEventListener('click', closeModal);

            // Close modal when clicking outside
            window.addEventListener('click', (e) => {
                if (e.target === modal) {
                    closeModal();
                }
            });

            // Handle form submission
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                const formData = new FormData(form);
                const typeTitle = modalTitle.classList.contains('job-seekers') ?
                    'Tư vấn cho người tìm việc' : 'Tư vấn cho Nhà tuyển dụng';
                formData.append('type_title', typeTitle);

                fetch('/supports', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                .getAttribute('content'),
                        },
                        body: formData,
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Failed to submit consultation');
                        }
                        return response.json();
                    })
                    .then(data => {
                        alert(data.message);
                        closeModal();
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Đã xảy ra lỗi khi gửi thông tin tư vấn.');
                    });
            });

        });
    </script>
@endsection
