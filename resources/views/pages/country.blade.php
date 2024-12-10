@extends('layout')

@section('content')
    <!-- Section: Các Lá Cờ Quốc Gia -->
    <section class="countries-section">
        <h2>Các Quốc Gia</h2>
        <div class="countries-container">
            @foreach ($countries->chunk(4) as $chunk)
                <div class="row">
                    @foreach ($chunk as $country)
                        <div class="country-item">
                            <img src="{{ asset('storage/' . $country->image) }}" alt="{{ $country->name }}" class="flag">
                            <span class="country-name">{{ $country->name }}</span>
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
                        <textarea name="description" required placeholder="Nhập mô tả"></textarea>
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
                // Add your form submission logic here
                const formData = new FormData(form);
                console.log('Form submitted:', Object.fromEntries(formData));
                // You can add an AJAX request here to send the data to your server

                closeModal();
            });
        });
    </script>
@endsection
