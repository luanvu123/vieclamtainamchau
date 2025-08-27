@extends('layouts.manage')

@section('content')
<style>
    .dashboard-stats {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }

    .stat-card {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 25px;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        position: relative;
        overflow: hidden;
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 100px;
        height: 100px;
        background: rgba(255,255,255,0.1);
        border-radius: 50%;
        transform: translate(30px, -30px);
    }

    .stat-card.active { background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%); }
    .stat-card.pending { background: linear-gradient(135deg, #ffeaa7 0%, #fab1a0 100%); }
    .stat-card.inactive { background: linear-gradient(135deg, #74b9ff 0%, #0984e3 100%); }
    .stat-card.rejected { background: linear-gradient(135deg, #fd79a8 0%, #e84393 100%); }
    .stat-card.views { background: linear-gradient(135deg, #a29bfe 0%, #6c5ce7 100%); }
    .stat-card.applications { background: linear-gradient(135deg, #fd79a8 0%, #fdcb6e 100%); }

    .stat-number {
        font-size: 2.5rem;
        font-weight: bold;
        margin: 10px 0;
        position: relative;
        z-index: 2;
    }

    .stat-label {
        font-size: 0.9rem;
        opacity: 0.9;
        position: relative;
        z-index: 2;
    }

    .stat-icon {
        position: absolute;
        top: 20px;
        right: 20px;
        font-size: 2rem;
        opacity: 0.3;
        z-index: 1;
    }

    .filter-section {
        background: white;
        padding: 25px;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        margin-bottom: 30px;
    }

    .filter-row {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        align-items: end;
    }

    .filter-group {
        display: flex;
        flex-direction: column;
    }

    .filter-group label {
        margin-bottom: 8px;
        font-weight: 600;
        color: #333;
    }

    .filter-group select, .filter-group input {
        padding: 12px 15px;
        border: 2px solid #e1e5e9;
        border-radius: 8px;
        font-size: 14px;
        transition: all 0.3s ease;
    }

    .filter-group select:focus, .filter-group input:focus {
        outline: none;
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }

    .btn-filter {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 12px 25px;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
        text-align: center;
    }

    .btn-filter:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
        color: white;
        text-decoration: none;
    }

    .job-table-container {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }

    .job-table {
        width: 100%;
        border-collapse: collapse;
        margin: 0;
    }

    .job-table thead {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: #333;
    }

    .job-table th {
        padding: 18px 15px;
        text-align: left;
        font-weight: 600;
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .job-table td {
        padding: 18px 15px;
        border-bottom: 1px solid #f1f3f4;
        vertical-align: middle;
    }

    .job-table tbody tr:hover {
        background-color: #f8f9ff;
        transform: scale(1.01);
        transition: all 0.2s ease;
    }

    .job-title {
        font-weight: 600;
        color: #333;
        margin-bottom: 5px;
    }

    .job-meta {
        font-size: 12px;
        color: #666;
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
    }

    .status-badge {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .status-active { background: #d4edda; color: #155724; }
    .status-pending { background: #fff3cd; color: #856404; }
    .status-inactive { background: #d1ecf1; color: #0c5460; }
    .status-rejected { background: #f8d7da; color: #721c24; }

    .metric-item {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 8px 12px;
        background: #f8f9fa;
        border-radius: 6px;
        font-size: 13px;
        font-weight: 500;
    }

    .metric-views { border-left: 3px solid #6c5ce7; }
    .metric-applications { border-left: 3px solid #00b894; }

    .action-buttons {
        display: flex;
        gap: 8px;
    }

    .btn-action {
        padding: 8px 15px;
        border: none;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s ease;
        text-decoration: none;
        display: inline-block;
    }

    .btn-edit {
        background: #e3f2fd;
        color: #1976d2;
    }

    .btn-edit:hover {
        background: #1976d2;
        color: white;
    }

    .btn-delete {
        background: #ffebee;
        color: #d32f2f;
    }

    .btn-delete:hover {
        background: #d32f2f;
        color: white;
    }

    .btn-applications {
        background: #e8f5e8;
        color: #2e7d32;
        text-decoration: none;
        padding: 8px 12px;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 600;
        transition: all 0.2s ease;
    }

    .btn-applications:hover {
        background: #2e7d32;
        color: white;
        text-decoration: none;
    }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }

    .empty-icon {
        font-size: 4rem;
        color: #ddd;
        margin-bottom: 20px;
    }

    .pagination-wrapper {
        margin-top: 25px;
        display: flex;
        justify-content: center;
    }

    .main-content {
        padding: 30px;
        background: #f8f9fa;
        min-height: 100vh;
    }

    .page-header {
        margin-bottom: 30px;
    }

    .page-title {
        font-size: 2rem;
        font-weight: 700;
        color: #333;
        margin-bottom: 10px;
    }

    .page-subtitle {
        color: #666;
        font-size: 1rem;
    }

    .date-badge {
        font-size: 12px;
        padding: 4px 8px;
        background: #f1f3f4;
        border-radius: 4px;
        color: #333;
        font-weight: 500;
    }

    .hot-badge {
        background: linear-gradient(45deg, #ff6b6b, #ee5a24);
        color: white;
        padding: 2px 8px;
        border-radius: 12px;
        font-size: 10px;
        font-weight: bold;
        text-transform: uppercase;
        margin-left: 8px;
    }
</style>

@section('content')
<div class="main-content">
    <div class="page-header">
        <h1 class="page-title">Quản lý tin tuyển dụng việc làm mới</h1>
        <p class="page-subtitle">Theo dõi và quản lý toàn bộ tin đăng tuyển dụng của bạn</p>
    </div>

    <!-- Dashboard Statistics -->
    <div class="dashboard-stats">
        @php
            $totalJobs = $jobPostings->count();
            $activeJobs = $jobPostings->where('status', 'active')->count();
            $pendingJobs = $jobPostings->where('status', 'pending')->count();
            $inactiveJobs = $jobPostings->where('status', 'inactive')->count();
            $rejectedJobs = $jobPostings->where('status', 'rejected')->count();
            $totalViews = $jobPostings->sum('views');
            $totalApplications = $jobPostings->sum(function($job) { return $job->applications->count(); });
        @endphp

        <div class="stat-card">
            <div class="stat-icon">📊</div>
            <div class="stat-number">{{ $totalJobs }}</div>
            <div class="stat-label">Tổng tin đăng</div>
        </div>

        <div class="stat-card active">
            <div class="stat-icon">✅</div>
            <div class="stat-number">{{ $activeJobs }}</div>
            <div class="stat-label">Đang hoạt động</div>
        </div>

        <div class="stat-card pending">
            <div class="stat-icon">⏳</div>
            <div class="stat-number">{{ $pendingJobs }}</div>
            <div class="stat-label">Chờ duyệt</div>
        </div>

        <div class="stat-card views">
            <div class="stat-icon">👁️</div>
            <div class="stat-number">{{ number_format($totalViews) }}</div>
            <div class="stat-label">Tổng lượt xem</div>
        </div>

        <div class="stat-card applications">
            <div class="stat-icon">📄</div>
            <div class="stat-number">{{ $totalApplications }}</div>
            <div class="stat-label">Tổng ứng tuyển</div>
        </div>

        <div class="stat-card inactive">
            <div class="stat-icon">📈</div>
            <div class="stat-number">{{ $totalViews > 0 ? number_format(($totalApplications / $totalViews) * 100, 1) : 0 }}%</div>
            <div class="stat-label">Tỷ lệ chuyển đổi</div>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="filter-section">
        <form method="GET" action="{{ route('employer.job-posting.export') }}">
            <div class="filter-row">
                <div class="filter-group">
                    <label for="status">Trạng thái</label>
                    <select name="status" id="status">
                        <option value="">-- Tất cả trạng thái --</option>
                        <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>
                            ✅ Hoạt động
                        </option>
                        <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>
                            ⏸️ Không hoạt động
                        </option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>
                            ⏳ Chờ duyệt
                        </option>
                        <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>
                            ❌ Bị từ chối
                        </option>
                    </select>
                </div>

                <div class="filter-group">
                    <label for="search">Tìm kiếm</label>
                    <input type="text" name="search" id="search" placeholder="Tìm theo tên công việc..."
                           value="{{ request('search') }}">
                </div>

                <div class="filter-group">
                    <label for="date_from">Từ ngày</label>
                    <input type="date" name="date_from" id="date_from" value="{{ request('date_from') }}">
                </div>

                <div class="filter-group">
                    <label for="date_to">Đến ngày</label>
                    <input type="date" name="date_to" id="date_to" value="{{ request('date_to') }}">
                </div>

                <div class="filter-group">
                    <label>&nbsp;</label>
                    <button type="submit" class="btn-filter">🔍 Lọc kết quả</button>
                </div>
            </div>
        </form>
    </div>

    @php
        $statusLabels = [
            'active' => 'Hoạt động',
            'inactive' => 'Không hoạt động',
            'pending' => 'Chờ duyệt',
            'rejected' => 'Bị từ chối',
        ];
    @endphp

  @if ($jobPostings->isNotEmpty())
    <div class="job-table-container">
        <table class="job-table" id="job-table">
            <thead>
                <tr>
                    <th style="width: 10px;">#</th>
                    <th style="width: 45%;">Thông tin công việc</th>
                    <th style="width: 10%;">Trạng thái</th>
                    <th style="width: 15%;">Thống kê</th>
                    <th style="width: 12%;">Thời hạn</th>
                    <th style="width: 18%;">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($jobPostings as $key => $job)
                    <tr>
                        <td>
                            <strong>{{ $key + 1 }}</strong>
                        </td>

                        <td>
                            <div class="job-title">
                                {{ $job->title }}
                                @if($job->isHot)
                                    <span class="hot-badge">Hot</span>
                                @endif
                            </div>
                            <div class="job-meta">
                                <span><i class="fa fa-briefcase"></i> {{ $job->type ?? 'Không xác định' }}</span>
                                <span><i class="fa fa-map-marker"></i> {{ $job->location ?? 'Không xác định' }}</span>
                                @if($job->salary)
                                    <span><i class="fa fa-money"></i> {{ $job->salary }}</span>
                                @endif
                                @if($job->experience)
                                    <span><i class="fa fa-star"></i> {{ $job->experience }}</span>
                                @endif
                            </div>
                        </td>

                        <td>
                            <div class="status-indicator">
                                @if($job->status == 'active')
                                    <span class="status-active" title="Đang hoạt động">
                                        <i class="fa fa-toggle-on" style="color: #28a745; font-size: 20px;"></i>
                                    </span>
                                @else
                                    <span class="status-inactive" title="Tạm dừng">
                                        <i class="fa fa-toggle-off" style="color: #dc3545; font-size: 20px;"></i>
                                    </span>
                                @endif
                            </div>
                        </td>

                        <td>
                            <div style="display: flex; flex-direction: column; gap: 8px;">
                                <div class="metric-item metric-views">
                                    <span><i class="fa fa-eye"></i></span>
                                    <span>{{ number_format($job->views) }}</span>
                                </div>
                               <div class="metric-item metric-applications">
    <span><i class="fa fa-file-text"></i></span>
    <a href="{{ route('employer.job-posting.applications', $job->id) }}" class="btn-applications">
        {{
            $job->applications
                ->whereIn('approve_application', ['Đã duyệt', 'Nộp lại', 'Từ chối'])
                ->count()
        }} đã nộp
    </a>
</div>

                            </div>
                        </td>

                        <td>
                            @if($job->closing_date)
                                <div class="date-badge">
                                    {{ \Carbon\Carbon::parse($job->closing_date)->format('d/m/Y') }}
                                </div>
                            @else
                                <span class="date-badge">Không giới hạn</span>
                            @endif
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('employer.job-posting.edit', $job->id) }}" class="btn-action btn-edit"
                                    title="Chỉnh sửa">
                                    <i class="fa fa-edit"></i>
                                </a>

                                <form action="{{ route('employer.job-posting.destroy', $job->id) }}" method="POST"
                                    style="display:inline;"
                                    onsubmit="return confirm('Bạn có chắc chắn muốn xóa tin đăng này?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-action btn-delete" title="Xóa">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@else
        <div class="empty-state">
            <div class="empty-icon">📭</div>
            <h3 style="color: #666; margin-bottom: 10px;">Chưa có tin đăng nào</h3>
            <p style="color: #999; margin-bottom: 25px;">
                Bạn chưa có tin đăng tuyển dụng việc làm mới nào. Hãy tạo tin đăng đầu tiên!
            </p>
            <a href="{{ route('employer.job-posting.create') }}" class="btn-filter">
                ➕ Tạo tin đăng mới
            </a>
        </div>
    @endif
</div>

<script>
    // Auto-submit form when changing status
    document.getElementById('status').addEventListener('change', function() {
        this.form.submit();
    });

    // Enhanced table interactions
    document.addEventListener('DOMContentLoaded', function() {
        const tableRows = document.querySelectorAll('#job-table tbody tr');

        tableRows.forEach(row => {
            row.addEventListener('mouseenter', function() {
                this.style.transform = 'scale(1.01)';
                this.style.zIndex = '10';
                this.style.position = 'relative';
            });

            row.addEventListener('mouseleave', function() {
                this.style.transform = 'scale(1)';
                this.style.zIndex = '1';
            });
        });
    });

    // Confirm delete with better UX
    function confirmDelete(jobTitle) {
        return confirm(`Bạn có chắc chắn muốn xóa tin đăng "${jobTitle}"?\n\nHành động này không thể hoàn tác.`);
    }
</script>

@endsection

