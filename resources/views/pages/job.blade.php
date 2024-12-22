@extends('layout')

@section('content')
    <style>
        /* Reset & General Styles */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        /* Job Card Container */
        .job-card {
            background: white;
            border-radius: 8px;
            padding: 20px;
            max-width: 1200px;
            margin: 20px auto;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        /* Company Logo */
        .company-logo {
            width: 100px;
            height: 100px;
            object-fit: contain;
            margin-bottom: 15px;
        }

        /* Job Header Section */
        .job-header {
            margin-bottom: 20px;
        }

        .company-name {
            color: #666;
            font-size: 14px;
            margin-bottom: 8px;
        }

        .job-title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 15px;
            color: #333;
        }

        /* Job Meta Information */
        .job-meta {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
            margin-bottom: 20px;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #666;
            font-size: 14px;
        }

        .meta-item img {
            width: 20px;
            height: 20px;
        }

        .first-apply {
            color: #ff6b00;
            font-size: 14px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* Action Buttons */
        .buttons {
            display: flex;
            gap: 15px;
            margin-bottom: 30px;
        }

        .apply-btn {
            background: #4527a0;
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 500;
            transition: background 0.3s ease;
        }

        .apply-btn:hover {
            background: #331d77;
        }

        .save-btn {
            background: white;
            border: 1px solid #ddd;
            padding: 12px 20px;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .save-btn:hover {
            background: #f5f5f5;
        }

        /* Tabs */
        .tabs {
            display: flex;
            gap: 30px;
            border-bottom: 1px solid #eee;
            margin-bottom: 20px;
        }

        .tab {
            padding: 12px 0;
            color: #666;
            cursor: pointer;
            position: relative;
            transition: all 0.3s ease;
        }

        .tab.active {
            color: #4527a0;
            font-weight: 500;
        }

        .tab.active::after {
            content: '';
            position: absolute;
            bottom: -1px;
            left: 0;
            width: 100%;
            height: 2px;
            background: #4527a0;
        }

        /* Tab Content */
        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        /* Job Information Grid */
        .info-section {
            margin-bottom: 30px;
        }

        .info-section h2 {
            font-size: 18px;
            margin-bottom: 15px;
            color: #333;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 20px;
        }

        .info-item {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            padding: 15px;
            background: #f8f8ff;
            border-radius: 6px;
        }

        .info-item img {
            width: 24px;
            height: 24px;
        }

        /* Tags */
        .job-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 30px;
        }

        .job-tag {
            color: #4527a0;
            text-decoration: none;
            font-size: 14px;
            transition: color 0.3s ease;
        }

        .job-tag:hover {
            color: #331d77;
        }

        /* Job Description */
        .job-description {
            color: #333;
            line-height: 1.6;
        }

        .job-description h2 {
            font-size: 18px;
            margin: 25px 0 15px;
            color: #333;
        }
.other-jobs-section {
    margin-top: 2.5rem;
    padding: 1.5rem;
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
}

.section-title {
    font-size: 1.5rem;
    font-weight: 600;
    color: #2d3748;
    margin-bottom: 1.5rem;
    padding-bottom: 0.75rem;
    border-bottom: 2px solid #edf2f7;
}

.jobs-list {
    display: flex;
    flex-direction: column;
    gap: 1.25rem;
}

.job-item {
    padding: 1.25rem;
    border: 1px solid #e2e8f0;
    border-radius: 6px;
    transition: all 0.3s ease;
}

.job-item:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    border-color: #cbd5e0;
}

.job-item-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1rem;
}

.job-item-title {
    font-size: 1.125rem;
    margin: 0;
}

.job-item-title a {
    color: #2d3748;
    text-decoration: none;
    transition: color 0.2s ease;
}

.job-item-title a:hover {
    color: #4299e1;
}

.hot-label {
    background: #f56565;
    color: white;
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    font-size: 0.875rem;
    font-weight: 500;
}

.job-item-details {
    display: flex;
    flex-wrap: wrap;
    gap: 1.25rem;
    margin-bottom: 1rem;
}

.detail {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: #4a5568;
    font-size: 0.9375rem;
}

.detail i {
    color: #718096;
}

.job-item-skills {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
    margin-bottom: 1rem;
}

.skill-tag {
    background: #edf2f7;
    color: #4a5568;
    padding: 0.25rem 0.75rem;
    border-radius: 15px;
    font-size: 0.875rem;
}

.job-item-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    color: #718096;
    font-size: 0.875rem;
}

.deadline, .views {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.no-jobs-message {
    text-align: center;
    padding: 2rem;
    background: #f7fafc;
    border-radius: 6px;
    color: #718096;
}

@media (max-width: 768px) {
    .job-item-details {
        gap: 0.75rem;
    }

    .detail {
        font-size: 0.875rem;
    }

    .job-item-footer {
        flex-direction: column;
        gap: 0.5rem;
    }
}
        .job-description ul {
            list-style-type: none;
            padding-left: 20px;
        }

        .job-description li {
            margin-bottom: 10px;
            position: relative;
        }

        .job-description li::before {
            content: "•";
            position: absolute;
            left: -20px;
            color: #4527a0;
        }

        /* Company Tab Content */
        .company-info {
            color: #333;
            line-height: 1.6;
        }

        .company-header {
            margin-bottom: 30px;
        }

        .company-brief {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .brief-item {
            background: #f8f8ff;
            padding: 20px;
            border-radius: 8px;
        }

        .brief-item h3 {
            font-size: 16px;
            margin-bottom: 10px;
            color: #4527a0;
        }

        .company-gallery {
            margin: 30px 0;
        }

        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 15px;
            margin-top: 20px;
        }

        .gallery-item {
            aspect-ratio: 16/9;
            overflow: hidden;
            border-radius: 8px;
        }

        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .gallery-item:hover img {
            transform: scale(1.05);
        }

        .company-benefits {
            margin: 30px 0;
        }

        .benefits-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .benefit-item {
            display: flex;
            align-items: flex-start;
            gap: 15px;
            padding: 15px;
            background: white;
            border: 1px solid #eee;
            border-radius: 8px;
            transition: transform 0.3s ease;
        }

        .benefit-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .benefit-item img {
            width: 24px;
            height: 24px;
        }

        .benefit-content h4 {
            font-size: 15px;
            margin-bottom: 5px;
            color: #333;
        }

        .benefit-content p {
            font-size: 14px;
            color: #666;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .job-card {
                margin: 10px;
                padding: 15px;
            }

            .job-meta {
                flex-direction: column;
                gap: 10px;
            }

            .buttons {
                flex-direction: column;
            }

            .apply-btn,
            .save-btn {
                width: 100%;
                text-align: center;
            }

            .tabs {
                gap: 20px;
            }

            .company-brief {
                grid-template-columns: 1fr;
            }

            .gallery-grid {
                grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            }

            .benefits-grid {
                grid-template-columns: 1fr;
            }

            .info-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <div class="job-card">
        <!-- Company Logo -->
        <img src="{{ asset($jobPosting->employer->company_logo ?? 'frontend/img/company-default.png') }}"
            alt="{{ $jobPosting->employer->company_name }}" class="company-logo">

        <!-- Job Header Section -->
        <div class="job-header">
            <div class="company-name">{{ $jobPosting->employer->company_name }}</div>
            <h1 class="job-title">{{ $jobPosting->title }}</h1>

            <!-- Job Meta Information -->
            <div class="job-meta">
                <div class="meta-item">
                    <img src="{{ asset('frontend/img/dollar-svgrepo-com.png') }}" alt="salary">
                    {{ $jobPosting->salary }}
                </div>
                <div class="meta-item">
                    <img src="{{ asset('frontend/img/alarm-svgrepo-com.png') }}" alt="deadline">
                    Hạn nộp hồ sơ: {{ $jobPosting->closing_date }}
                </div>
                <div class="meta-item">
                    <img src="{{ asset('frontend/img/map-location-pin-svgrepo-com.png') }}" alt="location">
                    {{ $jobPosting->location }}
                </div>
            </div>

            {{-- @if ($jobPosting->is_first_applicant)
        <div class="first-apply">
            <img src="{{ asset('frontend/img/entry-svgrepo-com.png') }}" alt="first">
            Cơ hội đầu tiên! Hãy là người đầu tiên nộp hồ sơ!
        </div>
        @endif --}}

            <!-- Action Buttons -->
            <div class="buttons">
                <button class="apply-btn" onclick="applyJob({{ $jobPosting->id }})">Nộp hồ sơ</button>
                <button class="save-btn" onclick="toggleSaveJob({{ $jobPosting->id }})">♡</button>
            </div>
        </div>

        <!-- Tabs -->
        <div class="tabs">
            <div class="tab active" data-tab="job-detail">Chi tiết tuyển dụng</div>
            <div class="tab" data-tab="company-info">Công ty</div>
        </div>

        <!-- Job Details Tab Content -->
        <div class="tab-content active" id="job-detail">
            <div class="info-section">
                <h2>Thông tin chung</h2>
                <div class="info-grid">
                    <div class="info-item">
                        <img src="{{ asset('frontend/img/date-svgrepo-com.png') }}" alt="calendar">
                        <div>
                            <div>Ngày đăng</div>
                            <strong>{{ $jobPosting->created_at->format('d/m/Y') }}</strong>
                        </div>
                    </div>
                    <div class="info-item">
                        <img src="{{ asset('frontend/img/ladder-svgrepo-com.png') }}" alt="level">
                        <div>
                            <div>Cấp bậc</div>
                            <strong>{{ $jobPosting->level }}</strong>
                        </div>
                    </div>
                    <div class="info-item">
                        <img src="{{ asset('frontend/img/number-5-svgrepo-com.png') }}" alt="headcount">
                        <div>
                            <div>Số lượng tuyển</div>
                            <strong>{{ $jobPosting->headcount }}</strong>
                        </div>
                    </div>
                    <!-- Add more info items as needed -->
                </div>

                <div class="job-tags">
                    @foreach ($jobPosting->genres as $genre)
                        <a href="{{ route('genres.show', $genre->id) }}" class="job-tag">{{ $genre->name }}</a>
                        @if (!$loop->last)
                            /
                        @endif
                    @endforeach
                </div>

                <div class="job-description">
                    <h2>Mô tả công việc</h2>
                    {!! $jobPosting->description !!}

                    <h2>Yêu cầu công việc</h2>
                    {!! $jobPosting->skills_required !!}
                </div>
            </div>
        </div>

        <!-- Company Tab Content -->
        <div class="tab-content" id="company-info">
            <div class="company-info">
                <div class="company-header">
                    <h2>Giới thiệu công ty</h2>
                    <p>{{ $jobPosting->employer->description }}</p>
                </div>

                <div class="company-brief">
                    <div class="brief-item">
                        <h3>Quy mô công ty</h3>
                        <p>{{ $jobPosting->employer->scale }}</p>
                    </div>
                    <div class="brief-item">
                        <h3>Địa chỉ</h3>
                        <p>{{ $jobPosting->employer->address }}</p>
                    </div>
                </div>

                @if ($jobPosting->employer->gallery->isNotEmpty())
                    <div class="company-gallery">
                        <h2>Hình ảnh công ty</h2>
                        <div class="gallery-grid">
                            @foreach ($jobPosting->employer->gallery as $image)
                                <div class="gallery-item">
                                    <img src="{{ asset('storage/' . $image->image_path) }}" alt="Company Image">
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
                <div class="company-brief">
                    <div class="brief-item">
                        <h3>Thông tin</h3>
                        <p>{{ $jobPosting->employer->detail }}</p>
                    </div>

                </div>
                <div class="other-jobs-section">
    <h2 class="section-title">Việc làm khác từ công ty</h2>

    @if ($orderJob->count() > 0)
        <div class="jobs-list">
            @foreach ($orderJob as $job)
                <div class="job-item">
                    <div class="job-item-header">
                        <h3 class="job-item-title">
                            <a href="{{ route('job.show', $job->slug) }}">{{ $job->title }}</a>
                        </h3>
                        @if($job->isHot)
                            <span class="hot-label">Hot</span>
                        @endif
                    </div>

                    <div class="job-item-details">
                        <div class="detail">
                            <i class="fas fa-coins"></i>
                            <span>{{ $job->salary }}</span>
                        </div>
                        <div class="detail">
                            <i class="fas fa-map-marker"></i>
                            <span>{{ $job->city }}</span>
                        </div>
                        <div class="detail">
                            <i class="fas fa-briefcase"></i>
                            <span>{{ $job->type }}</span>
                        </div>
                        <div class="detail">
                            <i class="fas fa-users"></i>
                            <span>{{ $job->number_of_recruits }} người</span>
                        </div>
                    </div>

                    <div class="job-item-skills">
                        @foreach(explode(',', $job->skills_required) as $skill)
                            <span class="skill-tag">{{ trim($skill) }}</span>
                        @endforeach
                    </div>

                    <div class="job-item-footer">
                        <div class="deadline">
                            <i class="far fa-clock"></i>
                            <span>Hạn nộp: {{ \Carbon\Carbon::parse($job->closing_date)->format('d/m/Y') }}</span>
                        </div>
                        <div class="views">
                            <i class="far fa-eye"></i>
                            <span>{{ $job->views }} lượt xem</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="no-jobs-message">
            <p>Hiện tại công ty chưa có tin tuyển dụng nào khác</p>
        </div>
    @endif
</div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
                // Tab switching functionality
                const tabs = document.querySelectorAll('.tab');
                const tabContents = document.querySelectorAll('.tab-content');

                tabs.forEach(tab => {
                    tab.addEventListener('click', () => {
                        // Remove active class from all tabs and contents
                        tabs.forEach(t => t.classList.remove('active'));
                        tabContents.forEach(content => content.classList.remove('active'));

                        // Add active class to clicked tab and corresponding content
                        tab.classList.add('active');
                        const tabId = tab.getAttribute('data-tab');
                        document.getElementById(tabId).classList.add('active');
                    });
                });

                // Job application functionality
                window.applyJob = function(jobId) {
                    // Kiểm tra đăng nhập
                    @auth
                    // Gửi request apply job
                    fetch(`/jobs/${jobId}/apply`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                alert('Ứng tuyển thành công!');
                            } else {
                                alert(data.message || 'Có lỗi xảy ra khi ứng tuyển.');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Có lỗi xảy ra khi ứng tuyển.');
                        });
                @else
                    // Redirect to login if not authenticated
                    window.location.href = '{{ route('login') }}';
                @endauth
            };

            // Save/Unsave job functionality
            window.toggleSaveJob = function(jobId) {
                @auth
                const saveBtn = document.querySelector('.save-btn');

                fetch(`/jobs/${jobId}/toggle-save`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Toggle heart icon
                            if (data.saved) {
                                saveBtn.innerHTML = '❤️';
                                saveBtn.classList.add('saved');
                            } else {
                                saveBtn.innerHTML = '♡';
                                saveBtn.classList.remove('saved');
                            }
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Có lỗi xảy ra khi lưu công việc.');
                    });
            @else
                window.location.href = '{{ route('login') }}';
            @endauth
        };

        // Check if job is saved on page load
        @auth
        fetch(`/jobs/{{ $jobPosting->id }}/check-saved`)
            .then(response => response.json())
            .then(data => {
                if (data.saved) {
                    document.querySelector('.save-btn').innerHTML = '❤️';
                    document.querySelector('.save-btn').classList.add('saved');
                }
            });
        @endauth

        // Image gallery modal
        const galleryItems = document.querySelectorAll('.gallery-item img');
        galleryItems.forEach(img => {
        img.addEventListener('click', () => {
            // Create modal
            const modal = document.createElement('div');
            modal.classList.add('gallery-modal');
            modal.innerHTML = `
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <img src="${img.src}" alt="${img.alt}">
                </div>
            `;

            // Add modal styles
            const style = document.createElement('style');
            style.textContent = `
                .gallery-modal {
                    display: flex;
                    position: fixed;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    background: rgba(0,0,0,0.9);
                    z-index: 1000;
                    justify-content: center;
                    align-items: center;
                }
                .modal-content {
                    position: relative;
                    max-width: 90%;
                    max-height: 90%;
                }
                .modal-content img {
                    max-width: 100%;
                    max-height: 90vh;
                    object-fit: contain;
                }
                .close {
                    position: absolute;
                    top: -30px;
                    right: 0;
                    color: white;
                    font-size: 30px;
                    cursor: pointer;
                }
            `;
            document.head.appendChild(style);

            // Add modal to body
            document.body.appendChild(modal);

            // Close modal functionality
            modal.querySelector('.close').addEventListener('click', () => {
                modal.remove();
            });
            modal.addEventListener('click', (e) => {
                if (e.target === modal) {
                    modal.remove();
                }
            });
        });
        });
        });
    </script>
@endsection
