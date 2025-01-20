@extends('layout')

@section('content')
<section class="hero">
        <div class="search-bar">
            <form action="{{ route('site.search') }}" method="GET">
                <input type="text" name="keyword" placeholder="Nhập từ khóa tìm kiếm" value="{{ request('keyword') }}">
                <select name="category">
                    <option value="">Lựa chọn nghề nghiệp</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->slug }}"
                            {{ request('category') == $category->slug ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                <select name="country">
                    <option value="">Nhập thị trường</option>
                    @foreach ($countries as $country)
                        <option value="{{ $country->slug }}" {{ request('country') == $country->slug ? 'selected' : '' }}>
                            {{ $country->name }}
                        </option>
                    @endforeach
                </select>
                <button class="search-btn" type="submit">Tìm kiếm</button>
            </form>
        </div>
    </section>
    <!-- Section: Các Lá Cờ Quốc Gia -->
    <section class="countries-section">
        <h2>Các Quốc Gia</h2></br>
        <div class="countries-container">
            @foreach ($countries->chunk(8) as $chunk)
                <div class="row">
                    @foreach ($chunk as $country)
                        <div class="country-item">
                            <a href="{{ route('country.show', $country->slug) }}">
                                <img src="{{ asset('storage/' . $country->image) }}" alt="{{ $country->name }}" class="flag">
                                <span class="country-name">{{ $country->name }}</span>
                            </a>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
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

        .countries-section {
            padding: 2rem 0;
        }

        .countries-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
        }

        .row {
            display: grid;
            grid-template-columns: repeat(8, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }

        .country-item {
            text-align: center;
        }

        .country-item a {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-decoration: none;
            color: inherit;
            transition: transform 0.2s;
        }

        .country-item a:hover {
            transform: translateY(-5px);
        }

        .flag {
            width: 100%;
            aspect-ratio: 3/2;
            object-fit: cover;
            border-radius: 4px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 8px;
        }

        .country-name {
            font-size: 0.9rem;
            margin-top: 5px;
        }

        /* Responsive Design */
        @media (max-width: 1200px) {
            .row {
                grid-template-columns: repeat(6, 1fr);
            }
        }

        @media (max-width: 992px) {
            .row {
                grid-template-columns: repeat(4, 1fr);
            }
        }

        @media (max-width: 768px) {
            .row {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (max-width: 576px) {
            .row {
                grid-template-columns: repeat(2, 1fr);
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
