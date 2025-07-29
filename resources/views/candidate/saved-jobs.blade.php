@extends('layouts.layout_candidate_profile')

@section('title', 'Chỉnh sửa hồ sơ')

@section('content')
       @if ($savedJobs->count() > 0)
    <div class="category-grid">
        @foreach ($savedJobs as $job)
            <div class="job-card {{ $job->service_type === 'Tin đặc biệt' ? 'hot-job' : '' }}">
                <div class="job-card-content">
                    <!-- Logo và thông tin chính -->
                    <div class="job-header">
                        <div class="company-logo">
                            @if ($job->employer && $job->employer->avatar)
                                <a href="{{ route('candidate.job.show', $job->slug) }}">
                                    <img src="{{ asset('storage/' . $job->employer->avatar) }}"
                                        alt="{{ $job->employer->company_name }}"
                                        onerror="this.src='{{ asset('frontend/company1.png') }}'">
                                </a>
                            @else
                                <a href="{{ route('candidate.job.show', $job->slug) }}">
                                    <img src="{{ asset('frontend/company1.png') }}" alt="Default Company Logo">
                                </a>
                            @endif
                        </div>

                        <div class="job-info">
                            <h3 class="job-title">
                                <a href="{{ route('candidate.job.show', $job->slug) }}" title="{{ $job->title }}">
                                    {{ Str::limit($job->title, 30) }}
                                    @if ($job->service_type === 'Tin đặc biệt')
                                        <span class="hot-icon">🔥</span>
                                    @endif
                                </a>
                            </h3>

                            <p class="company-name">
                                {{ $job->employer ? Str::limit($job->employer->company_name, 30) : 'Công ty TNHH' }}
                            </p>

                            <div class="job-meta">
                                @if ($job->salary)
                                    <span class="salary">{{ $job->salary }}</span>
                                @endif

                                @if ($job->location)
                                    <span class="location">{{ $job->location }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="job-actions">
                            <button class="save-job-btn saved" id="saveJobBtn_{{ $job->id }}" data-job-id="{{ $job->id }}" onclick="saveJob({{ $job->id }})">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor"
                                    stroke-width="2">
                                    <path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"></path>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Thông tin bổ sung -->
                    <div class="job-details">
                        <div class="job-tags">
                            @if ($job->type)
                                <span class="job-tag job-type">{{ $job->type }}</span>
                            @endif

                            @if ($job->experience)
                                <span class="job-tag experience">{{ $job->experience }}</span>
                            @endif

                            <span class="job-tag time-posted">
                                Ngày đăng: {{ $job->created_at->format('d/m/Y') }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="pagination-container mt-4">
        {{ $savedJobs->links() }}
    </div>
@else
    <div class="empty-state">
        <i class="far fa-heart fa-4x"></i>
        <h3>Bạn chưa lưu tin tuyển dụng nào</h3>
        <p>Hãy duyệt qua các tin tuyển dụng và lưu lại những tin bạn quan tâm.</p>
    </div>
@endif @if ($savedJobs->count() > 0)
            <div class="main-content">
                <div class="row">

                </div>
            </div>
            <div class="pagination-container mt-4">
                {{ $savedJobs->links() }}
            </div>
        @else
            <div class="empty-state">
                <i class="far fa-heart fa-4x"></i>
                <h3>Bạn chưa lưu tin tuyển dụng nào</h3>
                <p>Hãy duyệt qua các tin tuyển dụng và lưu lại những tin bạn quan tâm.</p>

            </div>
        @endif
 <style>
        /* Job Card Styles */
        .category-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(400px, 1fr));
            gap: 16px;
            margin: 20px 0;
            margin-left: 8rem;
            margin-right: 8rem;
        }

        .job-card {
            background: white;
            border-radius: 8px;
            border: 1px solid #e5e5e5;
            padding: 16px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .job-card:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border-color: #d0d0d0;
        }

        /* Hot Job Effect */
        .job-card.hot-job {
            border-left: 4px solid #ff4757;
            background: linear-gradient(135deg, #fff 0%, #fff5f5 100%);
            position: relative;
        }

        .job-card.hot-job::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 0;
            height: 0;
            border-left: 20px solid transparent;
            border-top: 20px solid #ff4757;
        }

        .job-card.hot-job::after {
            content: 'HOT';
            position: absolute;
            top: 2px;
            right: 2px;
            color: white;
            font-size: 8px;
            font-weight: bold;
            transform: rotate(45deg);
            transform-origin: center;
        }

        /* Job Header */
        .job-header {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            margin-bottom: 12px;
        }

        .company-logo {
            flex-shrink: 0;
            width: 60px;
            height: 60px;
            border-radius: 8px;
            overflow: hidden;
            border: 1px solid #e5e5e5;
            background: white;
        }

        .company-logo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .job-info {
            flex: 1;
            min-width: 0;
        }

        .job-title {
            margin: 0 0 6px 0;
            font-size: 16px;
            font-weight: 600;
            line-height: 1.3;
            color: #333;
        }

        .job-title a {
            color: inherit;
            text-decoration: none;
            display: block;
        }

        .job-title a:hover {
            color: #2563eb;
        }

        .hot-icon {
            font-size: 14px;
            margin-left: 6px;
            animation: hotBounce 2s infinite;
        }

        .company-name {
            margin: 0 0 8px 0;
            font-size: 14px;
            color: #666;
            font-weight: 400;
        }

        .job-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            font-size: 14px;
        }

        .salary {
            color: #2563eb;
            font-weight: 600;
        }

        .location {
            color: #666;
        }

        /* Job Actions */
        .job-actions {
            flex-shrink: 0;
        }

        .save-job-btn {
            background: none;
            border: 1px solid #e5e5e5;
            border-radius: 6px;
            padding: 8px;
            cursor: pointer;
            color: #666;
            transition: all 0.2s ease;
        }

        .save-job-btn:hover {
            background: #f8fafc;
            color: #2563eb;
            border-color: #2563eb;
        }

        .save-job-btn.saved {
            background: #2563eb;
            color: white;
            border-color: #2563eb;
        }

        /* Job Details */
        .job-details {
            margin-top: 12px;
            padding-top: 12px;
            border-top: 1px solid #f0f0f0;
        }

        .job-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .job-tag {
            background: #f1f5f9;
            color: #475569;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 500;
        }

        .job-tag.job-type {
            background: #dbeafe;
            color: #1e40af;
        }

        .job-tag.experience {
            background: #dcfce7;
            color: #166534;
        }

        .job-tag.time-posted {
            background: #f3f4f6;
            color: #6b7280;
        }

        /* Hot Badge for Genre Title */
        .hot-badge {
            background: linear-gradient(45deg, #ff6b6b, #ff4757);
            color: white;
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: bold;
            margin-left: 8px;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
            animation: hotPulse 2s infinite;
        }

        /* Animations */
        @keyframes hotBounce {

            0%,
            20%,
            50%,
            80%,
            100% {
                transform: translateY(0);
            }

            40% {
                transform: translateY(-2px);
            }

            60% {
                transform: translateY(-1px);
            }
        }

        @keyframes hotPulse {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .category-grid {
                grid-template-columns: 1fr;
                gap: 12px;
            }

            .job-card {
                padding: 12px;
            }

            .job-header {
                gap: 10px;
            }

            .company-logo {
                width: 48px;
                height: 48px;
            }

            .job-title {
                font-size: 15px;
            }

            .job-meta {
                flex-direction: column;
                gap: 4px;
            }
        }

        @media (max-width: 480px) {
            .job-header {
                flex-direction: column;
                align-items: stretch;
            }

            .job-actions {
                align-self: flex-end;
                margin-top: -40px;
            }
        }
    </style>
     <script>
        // Save Job Functionality
        document.addEventListener('DOMContentLoaded', function () {

            // Function to check if jobs are already saved when page loads
            function checkSavedJobs() {
                const saveButtons = document.querySelectorAll('.save-job-btn');

                saveButtons.forEach(button => {
                    const jobId = button.getAttribute('data-job-id');

                    fetch(`/check-saved/${jobId}`, {
                        method: 'GET',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success && data.saved) {
                                button.classList.add('saved');
                                updateButtonState(button, true);
                            }
                        })
                        .catch(error => {
                            console.error('Error checking saved status:', error);
                        });
                });
            }

            // Function to update button appearance
            function updateButtonState(button, isSaved) {
                const svg = button.querySelector('svg path');

                if (isSaved) {
                    button.classList.add('saved');
                    button.setAttribute('title', 'Đã lưu - Click để bỏ lưu');
                    // Fill the bookmark icon
                    svg.setAttribute('fill', 'currentColor');
                } else {
                    button.classList.remove('saved');
                    button.setAttribute('title', 'Lưu công việc');
                    // Empty the bookmark icon
                    svg.setAttribute('fill', 'none');
                }
            }

            // Function to show toast notification
            function showToast(message, type = 'success') {
                // Remove existing toast if any
                const existingToast = document.querySelector('.toast-notification');
                if (existingToast) {
                    existingToast.remove();
                }

                // Create toast element
                const toast = document.createElement('div');
                toast.className = `toast-notification toast-${type}`;
                toast.innerHTML = `
                        <div class="toast-content">
                            <span class="toast-icon">${type === 'success' ? '✓' : '⚠'}</span>
                            <span class="toast-message">${message}</span>
                            <button class="toast-close" onclick="this.parentElement.parentElement.remove()">×</button>
                        </div>
                    `;

                // Add to page
                document.body.appendChild(toast);

                // Auto remove after 3 seconds
                setTimeout(() => {
                    if (toast && toast.parentNode) {
                        toast.remove();
                    }
                }, 3000);
            }

            // Handle save job button clicks
            document.addEventListener('click', function (e) {
                if (e.target.closest('.save-job-btn')) {
                    e.preventDefault();

                    const button = e.target.closest('.save-job-btn');
                    const jobId = button.getAttribute('data-job-id');

                    // Disable button during request
                    button.disabled = true;
                    button.style.opacity = '0.6';

                    // Add loading animation
                    button.classList.add('loading');

                    fetch(`/candidate/save-job/${jobId}`, {
                        method: 'POST',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    })
                        .then(response => {
                            if (!response.ok) {
                                if (response.status === 401) {
                                    throw new Error('Vui lòng đăng nhập để lưu công việc');
                                }
                                throw new Error('Có lỗi xảy ra, vui lòng thử lại');
                            }
                            return response.json();
                        })
                        .then(data => {
                            if (data.success) {
                                updateButtonState(button, data.saved);
                                showToast(data.message, 'success');

                                // Update save counter if exists
                                updateSaveCounter(data.saved);
                            } else {
                                showToast(data.error || 'Có lỗi xảy ra', 'error');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            showToast(error.message, 'error');

                            // If unauthorized, redirect to login
                            if (error.message.includes('đăng nhập')) {
                                setTimeout(() => {
                                    window.location.href = '/candidate/login';
                                }, 2000);
                            }
                        })
                        .finally(() => {
                            // Re-enable button
                            button.disabled = false;
                            button.style.opacity = '1';
                            button.classList.remove('loading');
                        });
                }
            });

            // Function to update save counter (if you have a saved jobs counter somewhere)
            function updateSaveCounter(isSaved) {
                const counter = document.querySelector('.saved-jobs-counter');
                if (counter) {
                    let currentCount = parseInt(counter.textContent) || 0;
                    if (isSaved) {
                        currentCount++;
                    } else {
                        currentCount = Math.max(0, currentCount - 1);
                    }
                    counter.textContent = currentCount;
                }
            }

            // Initialize saved status check
            checkSavedJobs();
        });

        // CSS Styles (add to your CSS file or in a <style> tag)
        const saveJobStyles = `
            <style>
            /* Save button states */
            .save-job-btn {
                position: relative;
                transition: all 0.3s ease;
            }

            .save-job-btn.loading::after {
                content: '';
                position: absolute;
                top: 50%;
                left: 50%;
                width: 16px;
                height: 16px;
                margin: -8px 0 0 -8px;
                border: 2px solid transparent;
                border-top: 2px solid currentColor;
                border-radius: 50%;
                animation: spin 1s linear infinite;
            }

            .save-job-btn.loading svg {
                opacity: 0;
            }

            .save-job-btn.saved {
                background: #2563eb !important;
                color: white !important;
                border-color: #2563eb !important;
            }

            /* Toast Notification */
            .toast-notification {
                position: fixed;
                top: 20px;
                right: 20px;
                z-index: 9999;
                min-width: 300px;
                max-width: 400px;
                background: white;
                border-radius: 8px;
                box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
                animation: slideInRight 0.3s ease-out;
            }

            .toast-notification.toast-success {
                border-left: 4px solid #10b981;
            }

            .toast-notification.toast-error {
                border-left: 4px solid #ef4444;
            }

            .toast-content {
                display: flex;
                align-items: center;
                padding: 16px;
                gap: 12px;
            }

            .toast-icon {
                flex-shrink: 0;
                width: 20px;
                height: 20px;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 12px;
                font-weight: bold;
                color: white;
            }

            .toast-success .toast-icon {
                background: #10b981;
            }

            .toast-error .toast-icon {
                background: #ef4444;
            }

            .toast-message {
                flex: 1;
                font-size: 14px;
                color: #374151;
                line-height: 1.4;
            }

            .toast-close {
                background: none;
                border: none;
                font-size: 18px;
                color: #9ca3af;
                cursor: pointer;
                padding: 0;
                width: 20px;
                height: 20px;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .toast-close:hover {
                color: #374151;
            }

            /* Animations */
            @keyframes slideInRight {
                from {
                    transform: translateX(100%);
                    opacity: 0;
                }
                to {
                    transform: translateX(0);
                    opacity: 1;
                }
            }

            @keyframes spin {
                to {
                    transform: rotate(360deg);
                }
            }

            /* Mobile responsive */
            @media (max-width: 768px) {
                .toast-notification {
                    left: 20px;
                    right: 20px;
                    min-width: auto;
                    max-width: none;
                }
            }
            </style>
            `;

        // Inject styles into page
        if (!document.querySelector('#save-job-styles')) {
            const styleElement = document.createElement('div');
            styleElement.id = 'save-job-styles';
            styleElement.innerHTML = saveJobStyles;
            document.head.appendChild(styleElement);
        }
    </script>
@endsection
