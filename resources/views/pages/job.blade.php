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
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
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
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
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

        .deadline,
        .views {
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
        <img src="{{ asset('storage/' . $jobPosting->employer->avatar) }}" alt="{{ $jobPosting->employer->company_name }}"
            class="company-logo">

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



            <div class="buttons">
                <div id="applicationStatus_{{ $jobPosting->id }}">
                    <!-- Sẽ được JavaScript cập nhật -->
                </div>
                <button class="apply-btn" onclick="applyJob({{ $jobPosting->id }})">Nộp hồ sơ</button>
               

                <button class="save-btn" onclick="toggleSaveJob({{ $jobPosting->id }})">
                    ♡
                </button>
            </div>

            <script>
                function toggleSaveJob(jobPostingId) {
                    fetch(`candidate/save-job/${jobPostingId}`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json'
                        }
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.saved) {
                                alert('Đã thêm vào danh sách yêu thích!');
                            } else {
                                alert('Đã xóa khỏi danh sách yêu thích!');
                            }
                        })
                        .catch(error => console.error('Lỗi:', error));
                }
            </script>














            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    checkApplicationStatus({{ $jobPosting->id }});
                });

                function checkApplicationStatus(jobId) {
                    fetch(`/candidate/check-application/${jobId}`)
                        .then(response => response.json())
                        .then(data => {
                            const statusDiv = document.getElementById(`applicationStatus_${jobId}`);
                            if (data.hasApplied) {
                                const applicationDate = new Date(data.applicationDate).toLocaleDateString('vi-VN');
                                const lastUpdateDate = data.lastUpdateDate ?
                                    new Date(data.lastUpdateDate).toLocaleDateString('vi-VN') :
                                    null;

                                statusDiv.innerHTML = `
                                <div class="application-status">
                                    Đã nộp hồ sơ - Ngày nộp: ${applicationDate}
                                    ${lastUpdateDate ? `<br>Cập nhật lần cuối: ${lastUpdateDate}` : ''}
                                </div>`;

                                const applyBtn = document.querySelector('.apply-btn');
                                applyBtn.textContent = 'Nộp lại hồ sơ';
                            }
                        })
                        .catch(error => console.error('Error checking application status:', error));
                }

                function applyJob(jobId) {
                    document.getElementById('jobPostingId').value = jobId;
                    document.getElementById('applicationModal').style.display = 'block';
                }

                // Đóng modal
                document.querySelector('.close').onclick = function () {
                    document.getElementById('applicationModal').style.display = 'none';
                };

                window.onclick = function (event) {
                    if (event.target == document.getElementById('applicationModal')) {
                        document.getElementById('applicationModal').style.display = 'none';
                    }
                };

                // Xử lý gửi form
                document.getElementById('applicationForm').onsubmit = function (e) {
                    e.preventDefault();

                    const formData = new FormData(this);

                    fetch('{{ route('candidate.apply') }}', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        }
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.status === 'success') {
                                alert(data.message);
                                document.getElementById('applicationModal').style.display = 'none';
                                document.getElementById('applicationForm').reset();
                                checkApplicationStatus(document.getElementById('jobPostingId').value);
                            } else {
                                alert(data.message);
                            }
                        })
                        .catch(error => {
                            alert('Có lỗi xảy ra, vui lòng thử lại');
                        });
                };
            </script>
            <style>
                .application-status-container {
                    margin-bottom: 1rem;
                }

                .application-status {
                    background-color: #f8f9fa;
                    border: 1px solid #e9ecef;
                    border-radius: 6px;
                    padding: 1rem;
                }

                .status-item {
                    display: flex;
                    align-items: center;
                    gap: 0.5rem;
                    margin-bottom: 0.5rem;
                }

                .status-item:last-child {
                    margin-bottom: 0;
                }

                .status-item i {
                    color: #0d6efd;
                    width: 20px;
                }

                .status-item span {
                    color: #495057;
                    font-size: 0.9rem;
                }

                .apply-btn.reapply {
                    background-color: #198754;
                }

                .apply-btn.reapply:hover {
                    background-color: #146c43;
                }
            </style>
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
                            <div>Kinh nghiệm</div>
                            <strong>{{ $jobPosting->experience }}</strong>
                        </div>
                    </div>
                    <div class="info-item">
                        <img src="{{ asset('frontend/img/number-5-svgrepo-com.png') }}" alt="headcount">
                        <div>
                            <div>Số lượng tuyển</div>
                            <strong>{{ $jobPosting->number_of_recruits }}</strong>
                        </div>
                    </div>
                </div>

                <div class="job-tags">
                    @foreach ($jobPosting->genres as $genre)
                        <a href="{{ route('genre.show', $genre->slug) }}" class="job-tag">{{ $genre->name }}</a>
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
                        <p>{{ $jobPosting->employer->scale }} </p>
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
                        <p>{!! $jobPosting->employer->detail !!}</p>
                    </div>

                </div>
                <iframe src="https://www.google.com/maps/embed?pb={{ $jobPosting->employer->map_url }}" width="600"
                    height="450" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
                <div class="other-jobs-section">
                    <h2 class="section-title">Việc làm khác từ công ty</h2>

                    @if ($orderJob->count() > 0)
                        <div class="jobs-list">
                            @foreach ($orderJob as $job)
                                <div class="job-item">
                                    <div class="job-item-header">
                                        <h3 class="job-item-title">
                                            <a href="{{ route('candidate.job.show', $job->slug) }}">{{ $job->title }}</a>
                                        </h3>
                                        @if ($job->isHot)
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
                                            <span>{{ $job->location }}</span>
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
                                        @foreach (explode(',', $job->skills_required) as $skill)
                                            <span class="skill-tag">{{ trim($skill) }}</span>
                                        @endforeach
                                    </div>

                                    <div class="job-item-footer">
                                        <div class="deadline">
                                            <i class="far fa-clock"></i>
                                            <span>Hạn nộp:
                                                {{ \Carbon\Carbon::parse($job->closing_date)->format('d/m/Y') }}</span>
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
    <!-- Loading Spinner -->
    <div id="loadingSpinner" class="loading-spinner">
        <div class="spinner"></div>
    </div>

    <!-- Application Modal -->
    <div id="applicationModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Nộp hồ sơ ứng tuyển</h2>
            <form id="applicationForm" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="job_posting_id" id="jobPostingId">

                <div class="form-group">
                    <label for="cv_id">Chọn CV đã tải lên</label>
                    <select name="cv_id" id="cv_id" class="form-control">
                        <option value="">-- Tải CV mới --</option>
                        @foreach(auth('candidate')->user()->cvs as $cv)
                            <option value="{{ $cv->id }}">{{ $cv->title }} - {{ $cv->file_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group" id="new-cv-upload">
                    <label for="cv">CV mới (PDF, DOC, DOCX)*</label>
                    <input type="file" id="cv" name="cv" accept=".pdf,.doc,.docx">
                </div>

                <div class="form-group">
                    <label for="introduction">Giới thiệu bản thân (không bắt buộc)</label>
                    <textarea id="introduction" name="introduction" rows="4"></textarea>
                </div>

                <button type="submit" class="submit-btn">Nộp hồ sơ</button>
            </form>

            <script>
                document.getElementById('cv_id').addEventListener('change', function () {
                    document.getElementById('new-cv-upload').style.display = this.value ? 'none' : 'block';
                });
            </script>

        </div>
    </div>

    <style>
        /* Modal Styles */
        .modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .modal.show {
            opacity: 1;
            visibility: visible;
        }

        .modal-content {
            background-color: #fff;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 500px;
            position: relative;
            transform: translateY(-20px);
            transition: transform 0.3s ease;
        }

        .modal.show .modal-content {
            transform: translateY(0);
        }

        /* Close Button */
        .close {
            position: absolute;
            right: 1rem;
            top: 1rem;
            font-size: 1.5rem;
            color: #666;
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .close:hover {
            color: #333;
        }

        /* Form Styles */
        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: #333;
            font-weight: 500;
        }

        .form-group input[type="file"] {
            width: 100%;
            padding: 0.5rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            background-color: #f9f9f9;
        }

        .form-group textarea {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            resize: vertical;
            min-height: 100px;
            font-family: inherit;
        }

        /* Button Styles */
        .submit-btn {
            background-color: #007bff;
            color: white;
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1rem;
            font-weight: 500;
            width: 100%;
            transition: background-color 0.3s ease;
        }

        .submit-btn:hover {
            background-color: #0056b3;
        }

        .submit-btn:disabled {
            background-color: #ccc;
            cursor: not-allowed;
        }

        /* Loading Spinner */
        .loading-spinner {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.8);
            z-index: 2000;
            justify-content: center;
            align-items: center;
        }

        .spinner {
            width: 50px;
            height: 50px;
            border: 3px solid #f3f3f3;
            border-top: 3px solid #007bff;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        /* Application Status Styles */
        .application-status {
            background-color: #e8f4ff;
            padding: 0.75rem;
            border-radius: 4px;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .application-status i {
            color: #007bff;
        }

        /* Success Message Animation */
        .success-message {
            opacity: 0;
            transform: translateY(-10px);
            transition: all 0.3s ease;
        }

        .success-message.show {
            opacity: 1;
            transform: translateY(0);
        }
    </style>


    <script>
        document.addEventListener('DOMContentLoaded', function () {
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




            window.toggleSaveJob = function (jobId) {
                fetch(`/candidate/save-job/${jobId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            const saveBtn = document.querySelector(`.save-btn`);
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
                        console.error('Lỗi:', error);
                        alert('Có lỗi xảy ra khi lưu công việc.');
                    });
            };

            // Kiểm tra xem công việc đã được lưu hay chưa khi tải trang
            fetch(`/candidate/jobs/{{ $jobPosting->id }}/check-saved`)
                .then(response => response.json())
                .then(data => {
                    const saveBtn = document.querySelector(`.save-btn`);
                    if (data.saved) {
                        saveBtn.innerHTML = '❤️';
                        saveBtn.classList.add('saved');
                    }
                });

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
    <script>
        function applyJob(jobId) {
            document.getElementById('jobPostingId').value = jobId;
            document.getElementById('applicationModal').style.display = 'block';
        }

        // Close modal when clicking on X or outside
        document.querySelector('.close').onclick = function () {
            document.getElementById('applicationModal').style.display = 'none';
        }

        window.onclick = function (event) {
            if (event.target == document.getElementById('applicationModal')) {
                document.getElementById('applicationModal').style.display = 'none';
            }
        }

        // Handle form submission
        document.getElementById('applicationForm').onsubmit = function (e) {
            e.preventDefault();

            const formData = new FormData(this);

            fetch('{{ route('candidate.apply') }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        alert(data.message);
                        document.getElementById('applicationModal').style.display = 'none';
                        document.getElementById('applicationForm').reset();
                    } else {
                        alert(data.message);
                    }
                })
                .catch(error => {
                    alert('Có lỗi xảy ra, vui lòng thử lại');
                });
        };
    </script>
    <script>
        // Show modal with animation
        function showModal(modalId) {
            const modal = document.getElementById(modalId);
            modal.style.display = 'flex';
            setTimeout(() => {
                modal.classList.add('show');
            }, 10);
        }

        // Hide modal with animation
        function hideModal(modalId) {
            const modal = document.getElementById(modalId);
            modal.classList.remove('show');
            setTimeout(() => {
                modal.style.display = 'none';
            }, 300);
        }

        // Show loading spinner
        function showLoading() {
            const spinner = document.getElementById('loadingSpinner');
            spinner.style.display = 'flex';
        }

        // Hide loading spinner
        function hideLoading() {
            const spinner = document.getElementById('loadingSpinner');
            spinner.style.display = 'none';
        }

        function applyJob(jobId) {
            document.getElementById('jobPostingId').value = jobId;
            showModal('applicationModal');
        }

        // Close modal when clicking on X or outside
        document.querySelector('.close').onclick = function () {
            hideModal('applicationModal');
        }

        window.onclick = function (event) {
            if (event.target == document.getElementById('applicationModal')) {
                hideModal('applicationModal');
            }
        }

        // Handle form submission
        document.getElementById('applicationForm').onsubmit = function (e) {
            e.preventDefault();

            // Disable submit button
            const submitBtn = this.querySelector('.submit-btn');
            submitBtn.disabled = true;

            showLoading();
            const formData = new FormData(this);

            fetch('{{ route('candidate.apply') }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
                .then(response => response.json())
                .then(data => {
                    hideLoading();
                    if (data.status === 'success') {
                        // Show success message with animation
                        const successMessage = document.createElement('div');
                        successMessage.className = 'success-message';
                        successMessage.innerHTML = data.message;
                        document.querySelector('.modal-content').appendChild(successMessage);

                        setTimeout(() => {
                            successMessage.classList.add('show');
                        }, 10);

                        setTimeout(() => {
                            hideModal('applicationModal');
                            document.getElementById('applicationForm').reset();
                            checkApplicationStatus(document.getElementById('jobPostingId').value);
                        }, 2000);
                    } else {
                        alert(data.message);
                    }
                })
                .catch(error => {
                    hideLoading();
                    alert('Có lỗi xảy ra, vui lòng thử lại');
                })
                .finally(() => {
                    submitBtn.disabled = false;
                });
        };

        // File input validation
        document.getElementById('cv').onchange = function () {
            const file = this.files[0];
            const maxSize = 2 * 1024 * 1024; // 2MB
            const allowedTypes = ['application/pdf', 'application/msword',
                'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
            ];

            if (file.size > maxSize) {
                alert('File không được vượt quá 2MB');
                this.value = '';
                return;
            }

            if (!allowedTypes.includes(file.type)) {
                alert('Chỉ chấp nhận file PDF, DOC, DOCX');
                this.value = '';
                return;
            }
        }
    </script>

@endsection
