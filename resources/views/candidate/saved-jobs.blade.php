@extends('layouts.layout_candidate_profile')

@section('title', 'Công việc đã lưu')

@section('content')
<div class="main-content">
    @if ($savedJobs->count() > 0)
        <div class="page-header">
            <h2 class="page-title">Công việc đã lưu</h2>
            <p class="page-subtitle">Bạn đã lưu {{ $savedJobs->total() }} công việc</p>
        </div>

        <div class="table-container">
            <div class="table-responsive">
                <table class="jobs-table">
                    <thead>
                        <tr>
                            <th class="col-stt">STT</th>
                            <th class="col-company">Công ty</th>
                            <th class="col-job">Vị trí công việc</th>
                            <th class="col-salary">Mức lương</th>
                            <th class="col-location">Địa điểm</th>
                            <th class="col-type">Loại hình</th>
                            <th class="col-date">Ngày đăng</th>
                            <th class="col-actions">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($savedJobs as $index => $job)
                            <tr class="job-row {{ $job->service_type === 'Tin đặc biệt' ? 'hot-job-row' : '' }}">
                                <!-- STT -->
                                <td class="stt-cell">
                                    <span class="job-number">
                                        {{ ($savedJobs->currentPage() - 1) * $savedJobs->perPage() + $index + 1 }}
                                    </span>
                                </td>
                                <!-- Company Info -->
                                <td class="company-cell">
                                    <div class="company-info">
                                        <div class="company-logo">
                                            @if ($job->employer && $job->employer->avatar)
                                                <img src="{{ asset('storage/' . $job->employer->avatar) }}"
                                                     alt="{{ $job->employer->company_name }}"
                                                     onerror="this.src='{{ asset('frontend/company1.png') }}'">
                                            @else
                                                <img src="{{ asset('frontend/company1.png') }}" alt="Default Company Logo">
                                            @endif
                                        </div>
                                        <div class="company-details">
                                            <span class="company-name">
                                                {{ $job->employer ? Str::limit($job->employer->company_name, 25) : 'Công ty TNHH' }}
                                            </span>
                                        </div>
                                    </div>
                                </td>

                                <!-- Job Title -->
                                <td class="job-cell">
                                    <div class="job-title-wrapper">
                                        <a href="{{ route('candidate.job.show', $job->slug) }}"
                                           class="job-title-link"
                                           title="{{ $job->title }}">
                                            {{ Str::limit($job->title, 40) }}
                                            @if ($job->service_type === 'Tin đặc biệt')
                                                <span class="hot-badge">HOT</span>
                                            @endif
                                        </a>
                                        @if ($job->experience)
                                            <span class="experience-tag">{{ $job->experience }}</span>
                                        @endif
                                    </div>
                                </td>

                                <!-- Salary -->
                                <td class="salary-cell">
                                    <span class="salary-amount">
                                        {{ $job->salary ?: 'Thỏa thuận' }}
                                    </span>
                                </td>

                                <!-- Location -->
                                <td class="location-cell">
                                    <span class="location-text">
                                        {{ $job->location ?: 'Không xác định' }}
                                    </span>
                                </td>

                                <!-- Job Type -->
                                <td class="type-cell">
                                    <span class="job-type-badge">
                                        {{ $job->type ?: 'Full-time' }}
                                    </span>
                                </td>

                                <!-- Posted Date -->
                                <td class="date-cell">
                                    <span class="posted-date">
                                        {{ $job->created_at->format('d/m/Y') }}
                                    </span>
                                    <span class="time-ago">
                                        {{ $job->created_at->diffForHumans() }}
                                    </span>
                                </td>

                                <!-- Actions -->
                                <td class="actions-cell">
                                    <div class="action-buttons">
                                        <a href="{{ route('candidate.job.show', $job->slug) }}"
                                           class="btn-view" title="Xem chi tiết">
                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                                <circle cx="12" cy="12" r="3"></circle>
                                            </svg>
                                        </a>

                                        <button class="btn-unsave"
                                                data-job-id="{{ $job->id }}"
                                                title="Bỏ lưu công việc"
                                                onclick="unsaveJob({{ $job->id }})">
                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="2">
                                                <path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        <div class="pagination-wrapper">
            {{ $savedJobs->links() }}
        </div>

    @else
        <div class="empty-state">
            <div class="empty-icon">
                <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1">
                    <path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"></path>
                </svg>
            </div>
            <h3 class="empty-title">Bạn chưa lưu tin tuyển dụng nào</h3>
            <p class="empty-description">Hãy duyệt qua các tin tuyển dụng và lưu lại những tin bạn quan tâm.</p>
            <a href="{{ route('candidate.jobs.index') }}" class="btn-browse-jobs">
                Duyệt công việc
            </a>
        </div>
    @endif
</div>

<style>
/* Main Content Styles */
.main-content {
    padding: 20px;
    background: #f8fafc;
    min-height: 100vh;
}

/* Page Header */
.page-header {
    margin-bottom: 24px;
    padding-bottom: 16px;
    border-bottom: 1px solid #e2e8f0;
}

.page-title {
    font-size: 24px;
    font-weight: 600;
    color: #1a202c;
    margin: 0 0 8px 0;
}

.page-subtitle {
    font-size: 14px;
    color: #718096;
    margin: 0;
}

/* Table Container */
.table-container {
    background: white;
    border-radius: 12px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    overflow: hidden;
}

.table-responsive {
    overflow-x: auto;
}

/* Jobs Table */
.jobs-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 14px;
}

.jobs-table thead th {
    background: #f7fafc;
    padding: 16px 12px;
    text-align: left;
    font-weight: 600;
    color: #4a5568;
    border-bottom: 2px solid #e2e8f0;
    white-space: nowrap;
}

.jobs-table tbody td {
    padding: 20px 12px;
    border-bottom: 2px solid #f1f5f9;
    vertical-align: middle;
}

/* Column Widths */
.col-stt { width: 60px; text-align: center; }
.col-company { width: 200px; }
.col-job { width: 300px; }
.col-salary { width: 150px; }
.col-location { width: 150px; }
.col-type { width: 120px; }
.col-date { width: 120px; }
.col-actions { width: 100px; }

/* Job Row Styles */
.job-row {
    transition: background-color 0.2s ease;
    margin-bottom: 8px;
}

.job-row:hover {
    background-color: #f8fafc;
}

.job-row.hot-job-row {
    background: linear-gradient(90deg, #fff5f5 0%, #ffffff 10%);
    border-left: 4px solid #ff4757;
}

/* STT Cell */
.stt-cell {
    text-align: center;
    font-weight: 600;
    color: #4a5568;
}

.job-number {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 32px;
    height: 32px;
    background: #edf2f7;
    border-radius: 50%;
    font-size: 14px;
    font-weight: 600;
    color: #2d3748;
}

/* Company Cell */
.company-info {
    display: flex;
    align-items: center;
    gap: 12px;
}

.company-logo {
    width: 40px;
    height: 40px;
    border-radius: 6px;
    overflow: hidden;
    flex-shrink: 0;
    border: 1px solid #e2e8f0;
}

.company-logo img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.company-name {
    font-weight: 500;
    color: #2d3748;
    line-height: 1.3;
}

/* Job Cell */
.job-title-wrapper {
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.job-title-link {
    color: #2563eb;
    text-decoration: none;
    font-weight: 500;
    line-height: 1.4;
    display: flex;
    align-items: center;
    gap: 8px;
}

.job-title-link:hover {
    color: #1d4ed8;
    text-decoration: underline;
}

.hot-badge {
    background: linear-gradient(45deg, #ff6b6b, #ff4757);
    color: white;
    padding: 2px 6px;
    border-radius: 4px;
    font-size: 10px;
    font-weight: bold;
    text-transform: uppercase;
    animation: hotPulse 2s infinite;
}

.experience-tag {
    background: #edf2f7;
    color: #4a5568;
    padding: 2px 8px;
    border-radius: 12px;
    font-size: 11px;
    font-weight: 500;
    width: fit-content;
}

/* Salary Cell */
.salary-amount {
    color: #38a169;
    font-weight: 600;
}

/* Location Cell */
.location-text {
    color: #4a5568;
}

/* Type Cell */
.job-type-badge {
    background: #bee3f8;
    color: #2c5282;
    padding: 4px 8px;
    border-radius: 4px;
    font-size: 12px;
    font-weight: 500;
}

/* Date Cell */
.date-cell {
    text-align: left;
}

.posted-date {
    display: block;
    color: #2d3748;
    font-weight: 500;
}

.time-ago {
    display: block;
    color: #718096;
    font-size: 11px;
    margin-top: 2px;
}

/* Actions Cell */
.action-buttons {
    display: flex;
    gap: 8px;
    align-items: center;
}

.btn-view, .btn-unsave {
    padding: 6px;
    border: 1px solid #e2e8f0;
    border-radius: 4px;
    background: white;
    color: #4a5568;
    cursor: pointer;
    transition: all 0.2s ease;
    display: flex;
    align-items: center;
    justify-content: center;
}

.btn-view:hover {
    background: #f7fafc;
    color: #2563eb;
    border-color: #2563eb;
    transform: translateY(-1px);
}

.btn-unsave:hover {
    background: #fed7d7;
    color: #c53030;
    border-color: #c53030;
    transform: translateY(-1px);
}

/* Pagination */
.pagination-wrapper {
    margin-top: 24px;
    display: flex;
    justify-content: center;
}

/* Empty State */
.empty-state {
    text-align: center;
    padding: 60px 20px;
    background: white;
    border-radius: 12px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
}

.empty-icon {
    margin-bottom: 16px;
    color: #cbd5e0;
}

.empty-title {
    font-size: 20px;
    font-weight: 600;
    color: #2d3748;
    margin: 0 0 8px 0;
}

.empty-description {
    color: #718096;
    margin: 0 0 24px 0;
    line-height: 1.5;
}

.btn-browse-jobs {
    background: #2563eb;
    color: white;
    padding: 10px 20px;
    border-radius: 6px;
    text-decoration: none;
    font-weight: 500;
    transition: background-color 0.2s ease;
}

.btn-browse-jobs:hover {
    background: #1d4ed8;
}

/* Animations */
@keyframes hotPulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.05); }
}

/* Responsive Design */
@media (max-width: 1024px) {
    .main-content {
        padding: 16px;
    }

    .col-stt { width: 50px; }
    .col-company { width: 180px; }
    .col-job { width: 250px; }
    .col-salary { width: 130px; }
    .col-location { width: 130px; }
}

@media (max-width: 768px) {
    .jobs-table {
        font-size: 12px;
    }

    .jobs-table thead th,
    .jobs-table tbody td {
        padding: 12px 8px;
    }

    .company-info {
        flex-direction: column;
        gap: 6px;
        text-align: center;
    }

    .company-logo {
        width: 32px;
        height: 32px;
    }

    .job-title-link {
        font-size: 13px;
    }

    .action-buttons {
        flex-direction: column;
        gap: 4px;
    }
}

@media (max-width: 640px) {
    .table-responsive {
        border-radius: 0;
        margin: 0 -16px;
    }

    .jobs-table {
        min-width: 650px;
    }

    .job-number {
        width: 28px;
        height: 28px;
        font-size: 12px;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Unsave job functionality
    window.unsaveJob = function(jobId) {
        const button = document.querySelector(`[data-job-id="${jobId}"]`);

        if (confirm('Bạn có chắc chắn muốn bỏ lưu công việc này?')) {
            // Show loading state
            button.disabled = true;
            button.style.opacity = '0.6';

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
                    throw new Error('Có lỗi xảy ra, vui lòng thử lại');
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    // Remove the row with animation
                    const row = button.closest('.job-row');
                    row.style.transition = 'all 0.3s ease';
                    row.style.opacity = '0';
                    row.style.transform = 'translateX(-20px)';

                    setTimeout(() => {
                        row.remove();

                        // Check if no jobs left
                        const remainingRows = document.querySelectorAll('.job-row');
                        if (remainingRows.length === 0) {
                            location.reload(); // Reload to show empty state
                        }
                    }, 300);

                    showToast(data.message || 'Đã bỏ lưu công việc thành công', 'success');
                } else {
                    showToast(data.error || 'Có lỗi xảy ra', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showToast(error.message, 'error');
            })
            .finally(() => {
                button.disabled = false;
                button.style.opacity = '1';
            });
        }
    };

    // Toast notification function
    function showToast(message, type = 'success') {
        const existingToast = document.querySelector('.toast-notification');
        if (existingToast) {
            existingToast.remove();
        }

        const toast = document.createElement('div');
        toast.className = `toast-notification toast-${type}`;
        toast.innerHTML = `
            <div class="toast-content">
                <span class="toast-icon">${type === 'success' ? '✓' : '⚠'}</span>
                <span class="toast-message">${message}</span>
                <button class="toast-close" onclick="this.parentElement.parentElement.remove()">×</button>
            </div>
        `;

        document.body.appendChild(toast);

        setTimeout(() => {
            if (toast && toast.parentNode) {
                toast.remove();
            }
        }, 3000);
    }
});

// Toast styles
const toastStyles = `
<style>
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
}

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
</style>
`;

if (!document.querySelector('#toast-styles')) {
    const styleElement = document.createElement('div');
    styleElement.id = 'toast-styles';
    styleElement.innerHTML = toastStyles;
    document.head.appendChild(styleElement);
}
</script>
@endsection
