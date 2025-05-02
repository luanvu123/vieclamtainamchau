@extends('layout')

@section('content')
    <!-- Section: Hotline -->
    <section class="hotlines-section">
           <div class="hotline-column">
        <h2 class="hotline-title job-seekers">Hotline cho người tìm việc</h2>

        <div class="hotline-info">
            <span class="hotline-label job-seekers">Hotline hỗ trợ</span>
            <span class="hotline-number job-seekers">{{ $info_layout->number_job_seeker_1 ?? '0567 012 132' }}</span>
        </div>

        @if($info_layout->facebook_candidate)
        <div class="hotline-info">
            <span class="hotline-label job-seekers">Facebook</span>
            <span class="hotline-number job-seekers">{{ $info_layout->facebook_candidate }}</span>
        </div>
        @endif

        @if($info_layout->email_candidate)
        <div class="hotline-info">
            <span class="hotline-label job-seekers">Email</span>
            <span class="hotline-number job-seekers">{{ $info_layout->email_candidate }}</span>
        </div>
        @endif
 @if($info_layout->zalo)
        <div class="hotline-info">
            <span class="hotline-label job-seekers">Zalo</span>
            <span class="hotline-number job-seekers">{{ $info_layout->zalo }}</span>
        </div>
        @endif
        <button class="consult-button job-seekers">Tư vấn cho người tìm việc</button>
    </div>

    <!-- Divider -->
    <div class="divider"></div>

    <!-- Employers Column -->
    <div class="hotline-column">
        <h2 class="hotline-title employers">Hotline cho Nhà tuyển dụng</h2>

        <div class="hotline-info">
            <span class="hotline-label employers">Hotline hỗ trợ</span>
            <span class="hotline-number employers">{{ $info_layout->number_employer_1 ?? '0567 012 132' }}</span>
        </div>

        @if($info_layout->whatsapp)
        <div class="hotline-info">
            <span class="hotline-label employers">WhatsApp</span>
            <span class="hotline-number employers">{{ $info_layout->whatsapp }}</span>
        </div>
        @endif

        @if($info_layout->wechat)
        <div class="hotline-info">
            <span class="hotline-label employers">WeChat</span>
            <span class="hotline-number employers">{{ $info_layout->wechat }}</span>
        </div>
        @endif

        @if($info_layout->facebook)
        <div class="hotline-info">
            <span class="hotline-label employers">Facebook</span>
            <span class="hotline-number employers">{{ $info_layout->facebook }}</span>
        </div>
        @endif

        @if($info_layout->email)
        <div class="hotline-info">
            <span class="hotline-label employers">Email</span>
            <span class="hotline-number employers">{{ $info_layout->email }}</span>
        </div>
        @endif



        <button class="consult-button employers">Tư vấn cho Nhà tuyển dụng</button>
    </div>
        <div class="divider"></div>
        <div class="hotline-column">
            <label for="location-select">Chọn địa điểm:</label>
            <select id="location-select">
                @foreach ($locations as $location)
                    <option value="{{ $location->id }}" data-description="{!! $location->description !!}"
                        {{ $defaultLocation->id == $location->id ? 'selected' : '' }}>
                        {{ $location->name }}
                    </option>
                @endforeach
            </select>

            <div id="location-info" class="hotline-info">
                <span class="hotline-info">
                    {!! $defaultLocation->description ?? 'Không có thông tin.' !!}
                </span>
            </div>
        </div>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const locationSelect = document.getElementById("location-select");
                const locationInfo = document.querySelector("#location-info .hotline-info");

                function updateDescription() {
                    let selectedOption = locationSelect.options[locationSelect.selectedIndex];
                    locationInfo.innerHTML = selectedOption.getAttribute("data-description") || "Không có thông tin.";
                }
                updateDescription();
                locationSelect.addEventListener("change", updateDescription);
            });
        </script>

    </section>
    <style>
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .hotline-info {
            margin-top: 1rem;
        }

        .hotline-info .hotline-label {
            margin-bottom: 0.25rem;
        }

        .hotline-info .hotline-number {
            display: block;
            font-size: 1.125rem;
            font-weight: 600;
            color: #333;
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
            color: #f7bd00;
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

        .hotline-column {
            flex: 1 1 33.33%;
            max-width: 33.33%;
            padding: 0 1rem;
        }

        .submit-button.employers {
            background-color: #f7bd00;
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
        .modal-title employers{
            color: #ffcd00;
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

                // Show loading state
                submitButton.disabled = true;
                submitButton.textContent = 'Đang gửi...';

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
                    })
                    .finally(() => {
                        // Reset button state
                        submitButton.disabled = false;
                        submitButton.textContent = 'Gửi thông tin';
                    });
            });
        });
    </script>
@endsection
