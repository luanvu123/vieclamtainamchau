@extends('layouts.layout_employer')

@section('title', 'Register')

@section('content')
    <style>
        /* public/css/modal.css */
        .modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
        }

        .modal.hidden {
            display: none;
        }

        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1001;
        }

        .modal-content {
            position: relative;
            background: white;
            padding: 2rem;
            border-radius: 12px;
            max-width: 800px;
            width: 90%;
            z-index: 1002;
            text-align: center;
        }

        .modal h2 {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .modal .subtitle {
            color: #666;
            margin-bottom: 1.5rem;
        }

        .modal .description {
            color: #444;
            margin-bottom: 2rem;
        }

        .choice-container {
            display: flex;
            justify-content: center;
            gap: 2rem;
            flex-wrap: wrap;
        }

        .choice-card {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 1.5rem;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            text-decoration: none;
            transition: all 0.2s;
        }

        .choice-card:hover {
            background-color: #f9fafb;
            transform: translateY(-2px);
        }

        .avatar-circle {
            width: 128px;
            height: 128px;
            border-radius: 50%;
            background-color: #f0f7ff;
            margin-bottom: 1rem;
            overflow: hidden;
        }

        .avatar-circle img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .choice-button {
            background-color: #fb0303;
            color: white;
            padding: 0.5rem 1.5rem;
            border-radius: 9999px;
            font-size: 0.875rem;
        }

        @media (max-width: 640px) {
            .choice-container {
                flex-direction: column;
            }

            .modal-content {
                padding: 1.5rem;
            }
        }
    </style>
    <div class="auth-container">
        <div class="auth-card">
            <h1>Đăng kí nhà tuyển dụng</h1>

            <form method="POST" action="{{ route('employer.register.submit') }}" class="auth-form"
                enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="name">Tên nhà tuyển dụng</label>
                    <input type="text" name="name" id="name" required value="{{ old('name') }}">
                    @error('name')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" required value="{{ old('email') }}">
                    @error('email')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="phone">Số điện thoại công ty</label>
                    <input type="tel" name="phone" id="phone" required value="{{ old('phone') }}">
                    @error('phone')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="company_name">Tên công ty</label>
                    <input type="text" name="company_name" id="company_name" required value="{{ old('company_name') }}">
                    @error('company_name')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Lĩnh vực hoạt động</label>
                    <select name="categories[]" id="categories" multiple>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ collect(old('categories'))->contains($category->id) ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('categories')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Danh mục</label>
                    <select name="genres[]" id="genres" multiple>
                        @foreach ($genres as $genre)
                            <option value="{{ $genre->id }}" {{ collect(old('genres'))->contains($genre->id) ? 'selected' : '' }}>
                                {{ $genre->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('genres')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">Mật khảu</label>
                    <input type="password" name="password" id="password" required>
                    @error('password')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Nhập lại mật khẩu</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" required>
                </div>

                <div id="registration-modal" class="modal hidden">
                    <div class="modal-overlay"></div>
                    <div class="modal-content">
                        <h2>Chào bạn</h2>
                        <p class="subtitle">Bạn hãy dành ra vài giây để xác nhận thông tin dưới đây nhé! 👋</p>
                        <p class="description">
                            Để tối ưu tốt nhất cho trải nghiệm của bạn với Vieclamtainamchau,<br>
                            vui lòng lựa chọn nhóm phù hợp nhất với bạn.
                        </p>

                        <div class="choice-container">
                            <a href="javascript:void(0)" class="choice-card" data-role="employer">
                                <div class="avatar-circle">
                                    <img src="{{ asset('frontend/employer-avatar.png') }}" alt="Employer">
                                </div>
                                <span class="choice-button">Tôi là nhà tuyển dụng</span>
                            </a>

                            <a href="{{ route('candidate.register') }}" class="choice-card">
                                <div class="avatar-circle">
                                    <img src="{{ asset('frontend/candidate-avatar.png') }}" alt="Candidate">
                                </div>
                                <span class="choice-button">Tôi là ứng viên tìm việc</span>
                            </a>
                        </div>
                    </div>
                </div>
                <script>
                    // public/js/modal.js
                    document.addEventListener('DOMContentLoaded', function () {
                        const modal = document.getElementById('registration-modal');

                        // Show modal when page loads
                        if (modal) {
                            modal.classList.remove('hidden');

                            // Optional: Close modal when clicking outside
                            modal.querySelector('.modal-overlay').addEventListener('click', function () {
                                modal.classList.add('hidden');
                            });
                        }
                    });
                </script>
                <script>
                    // public/js/modal.js
                    document.addEventListener('DOMContentLoaded', function () {
                        const modal = document.getElementById('registration-modal');

                        if (modal) {
                            // Hiện modal khi tải trang
                            modal.classList.remove('hidden');

                            // Đóng modal khi click vào overlay
                            modal.querySelector('.modal-overlay').addEventListener('click', function () {
                                modal.classList.add('hidden');
                            });

                            // Đóng modal khi chọn "Tôi là nhà tuyển dụng"
                            const employerButton = modal.querySelector('[data-role="employer"]');
                            if (employerButton) {
                                employerButton.addEventListener('click', function (e) {
                                    e.preventDefault(); // Ngăn chặn chuyển hướng ngay lập tức
                                    modal.classList.add('hidden'); // Ẩn modal

                                    // Chuyển hướng sau khi modal đã ẩn
                                    setTimeout(() => {
                                        window.location.href = this.href;
                                    }, 200); // Đợi 200ms để animation hoàn thành
                                });
                            }
                        }
                    });
                </script>
                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        const modal = document.getElementById('registration-modal');

                        // Kiểm tra xem đã chọn vai trò chưa
                        const hasChosenRole = localStorage.getItem('userRole');

                        // Chỉ hiện modal nếu chưa chọn vai trò
                        if (modal && !hasChosenRole) {
                            modal.classList.remove('hidden');

                            // Đóng modal khi click vào overlay
                            modal.querySelector('.modal-overlay').addEventListener('click', function () {
                                modal.classList.add('hidden');
                            });

                            // Xử lý khi chọn nhà tuyển dụng
                            const employerButton = modal.querySelector('[data-role="employer"]');
                            if (employerButton) {
                                employerButton.addEventListener('click', function (e) {
                                    e.preventDefault();

                                    // Lưu lựa chọn vào localStorage
                                    localStorage.setItem('userRole', 'employer');

                                    // Ẩn modal
                                    modal.classList.add('hidden');
                                });
                            }
                        }
                    });
                </script>
                {{-- <div class="form-group">
                    <label for="captcha">Mã xác thực *</label>
                    <div class="d-flex align-items-center mb-2">
                      <span id="captcha-image">{!! captcha_img('flat') !!}</span>
                        <button type="button" class="btn btn-refresh ml-2" id="reload">↻</button>
                    </div>
                    <input type="text" id="captcha" name="captcha" class="form-control" placeholder="Nhập mã xác thực...">
                    @error('captcha')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <script>
                    document.getElementById('reload').addEventListener('click', function () {
    fetch('{{ url('reload-captcha') }}?type=flat')
        .then(res => res.json())
        .then(data => {
            document.getElementById('captcha-image').innerHTML = data.captcha;
        });
});

                </script> --}}
<div class="form-group">
    <label for="captcha">Mã xác thực *</label>
    <div class="d-flex align-items-center mb-2">
        <span id="captcha-image">
            <img src="{{ url('reload-captcha') }}" onload="this.src='{{ url('reload-captcha') }}'" />
        </span>
        <button type="button" class="btn btn-refresh ml-2" id="reload">↻</button>
    </div>
    <input type="text" id="captcha" name="captcha" class="form-control" placeholder="Nhập mã xác thực...">
    @error('captcha')
        <span class="error">{{ $message }}</span>
    @enderror
</div>

<script>
    document.getElementById('reload').addEventListener('click', function () {
        fetch('{{ url('reload-captcha') }}')
            .then(res => res.json())
            .then(data => {
                document.getElementById('captcha-image').innerHTML = data.captcha;
            });
    });
</script>
                <button type="submit" class="btn-submit">Đăng kí</button>
            </form>

            <p class="auth-links">
                Bạn đã có tài khoản
                <a href="{{ route('employer.login') }}">Đăng nhập ngay</a>
            </p>
        </div>
    </div>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
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
@endsection
