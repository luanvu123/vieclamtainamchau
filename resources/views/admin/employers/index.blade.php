@extends('layouts.app')

@section('content')
    <style>
        .service-features .feature-item {
            padding: 10px;
            border-radius: 4px;
            background-color: #f8f9fa;
            margin-bottom: 10px;
        }

        .service-features .feature-item i {
            margin-right: 6px;
        }

        .service-time {
            margin-top: 4px;
            margin-left: 24px;
            font-size: 0.85em;
        }

        .service-time small {
            display: block;
            line-height: 1.4;
        }
    </style>
    <div class="container-fluid px-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="mt-4">Quản lý nhà tuyển dụng</h1>
        </div>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Danh sách nhà tuyển dụng
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="user-table">
                        <thead>
                            <tr>
                                <th><i class="fas fa-number"></i> #</th>
                                <th><i class="fas fa-image"></i> Logo</th>
                                <th><i class="fas fa-building"></i> Tên công ty</th>
                                <th><i class="fas fa-info-circle"></i> Thông tin cơ bản</th>
                                <th><i class="fas fa-check-circle"></i> Trạng thái</th>
                                <th><i class="fas fa-star"></i> Gói dịch vụ</th>
                                <th><i class="fas fa-cogs"></i> Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($employers as $employer)
                                <tr>
                                    <td>{{ $employer->id }}</td>
                                    <td class="text-center">
                                        <div class="avatar-container">
                                            <img src="{{ asset('storage/' . $employer->avatar) }}" alt="Logo"
                                                class="rounded-circle"
                                                style="width: 50px; height: 50px; object-fit: cover;">
                                            <!-- Show "New" if the employer was created within the last 2 hours -->
                                            @if ($employer->created_at >= \Carbon\Carbon::now()->subHours(2))
                                                <span class="new-badge">New</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <div class="fw-bold">{{ $employer->company_name }}</div>
                                        <small class="text-muted">MST: {{ $employer->mst }}</small>
                                    </td>
                                    <td>
                                        <div><i class="fas fa-user"></i> {{ $employer->name }}</div>
                                        <div><i class="fas fa-envelope"></i> {{ $employer->email }}</div>
                                        <div><i class="fas fa-phone"></i> {{ $employer->phone }}</div>
                                        <div><i class="fas fa-map-marker-alt"></i> {{ $employer->address }}</div>
                                    </td>
                                    <td>
                                        <div class="mb-1">
                                            <span class="badge {{ $employer->status ? 'bg-success' : 'bg-danger' }}">
                                                <i class="fas {{ $employer->status ? 'fa-check' : 'fa-times' }}"></i>
                                                {{ $employer->status ? 'Đang hoạt động' : 'Đã khóa' }}
                                            </span>
                                        </div>
                                        <div class="mb-1">
                                            <span
                                                class="badge {{ $employer->verification_token === null ? 'bg-success' : 'bg-warning' }}">
                                                <i class="fas fa-envelope"></i>
                                                {{ $employer->verification_token === null ? 'Đã xác thực email' : 'Chưa xác thực email' }}
                                            </span>
                                        </div>

                                        <div>
                                            <span
                                                class="badge {{ $employer->isVerifyCompany ? 'bg-success' : 'bg-warning' }}">
                                                <i class="fas fa-building"></i>
                                                {{ $employer->isVerifyCompany ? 'Đã xác thực công ty' : 'Chưa xác thực công ty' }}
                                            </span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="service-features">
                                            @if ($employer->IsBasicnews)
                                                <div class="feature-item">
                                                    <i class="fas fa-newspaper text-primary"></i> Tin cơ bản
                                                    @if ($employer->IsBasicnews_updated_at)
                                                        <div class="service-time">
                                                            <small class="text-muted">
                                                                <i class="fas fa-clock"></i>
                                                                {{ $employer->IsBasicnews_updated_at->format('H:i d/m/Y') }}
                                                                <span class="d-block ms-3">
                                                                    {{ $employer->IsBasicnews_updated_at->diffForHumans() }}
                                                                </span>
                                                            </small>
                                                        </div>
                                                    @endif
                                                </div>
                                            @endif

                                            @if ($employer->isUrgentrecruitment)
                                                <div class="feature-item">
                                                    <i class="fas fa-bolt text-warning"></i> Tìm ứng viên
                                                    @if ($employer->isUrgentrecruitment_updated_at)
                                                        <div class="service-time">
                                                            <small class="text-muted">
                                                                <i class="fas fa-clock"></i>
                                                                {{ $employer->isUrgentrecruitment_updated_at->format('H:i d/m/Y') }}
                                                                <span class="d-block ms-3">
                                                                    {{ $employer->isUrgentrecruitment_updated_at->diffForHumans() }}
                                                                </span>
                                                            </small>
                                                        </div>
                                                    @endif
                                                </div>
                                            @endif

                                            @if ($employer->IsPartner)
                                                <div class="feature-item">
                                                    <i class="fas fa-crown text-warning"></i> Đối tác
                                                    @if ($employer->IsPartner_updated_at)
                                                        <div class="service-time">
                                                            <small class="text-muted">
                                                                <i class="fas fa-clock"></i>
                                                                {{ $employer->IsPartner_updated_at->format('H:i d/m/Y') }}
                                                                <span class="d-block ms-3">
                                                                    {{ $employer->IsPartner_updated_at->diffForHumans() }}
                                                                </span>
                                                            </small>
                                                        </div>
                                                    @endif
                                                </div>
                                            @endif

                                            @if ($employer->IsHoteffect)
                                                <div class="feature-item">
                                                    <i class="fas fa-fire text-danger"></i> Nổi bật
                                                    @if ($employer->IsHoteffect_updated_at)
                                                        <div class="service-time">
                                                            <small class="text-muted">
                                                                <i class="fas fa-clock"></i>
                                                                {{ $employer->IsHoteffect_updated_at->format('H:i d/m/Y') }}
                                                                <span class="d-block ms-3">
                                                                    {{ $employer->IsHoteffect_updated_at->diffForHumans() }}
                                                                </span>
                                                            </small>
                                                        </div>
                                                    @endif
                                                </div>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('manage.employers.show', $employer->id) }}"
                                                class="btn btn-info btn-sm" title="Xem danh sách việc làm">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('manage.employers.edit', $employer->id) }}"
                                                class="btn btn-warning btn-sm" title="Chỉnh sửa">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#deleteModal{{ $employer->id }}" title="Xóa">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>

                                        <!-- Delete Modal -->
                                        <div class="modal fade" id="deleteModal{{ $employer->id }}" tabindex="-1">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Xác nhận xóa</h5>
                                                        <button type="button" class="btn-close"
                                                            data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Bạn có chắc chắn muốn xóa nhà tuyển dụng
                                                        "{{ $employer->company_name }}" không?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Hủy</button>
                                                        <form
                                                            action="{{ route('manage.employers.destroy', $employer->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">Xác nhận
                                                                xóa</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
        <style>
            .service-features {
                display: flex;
                flex-direction: column;
                gap: 0.5rem;
            }

            .feature-item {
                font-size: 0.875rem;
                display: flex;
                align-items: center;
                gap: 0.5rem;
            }

            .badge {
                display: inline-flex;
                align-items: center;
                gap: 0.25rem;
                padding: 0.5rem 0.75rem;
            }

            .btn-group {
                gap: 0.25rem;
            }

            .table> :not(caption)>*>* {
                vertical-align: middle;
            }
        </style>
    @endpush

    @push('scripts')
        <script>
            $(document).ready(function() {
                $('#employersTable').DataTable({
                    language: {
                        url: "//cdn.datatables.net/plug-ins/1.10.25/i18n/Vietnamese.json"
                    },
                    ordering: true,
                    pageLength: 25,
                    responsive: true
                });
            });
        </script>
    @endpush
@endsection
