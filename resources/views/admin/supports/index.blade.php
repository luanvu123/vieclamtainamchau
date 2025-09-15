@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>Danh sách tư vấn</h1>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <table class="table" id="user-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Số điện thoại</th>
                    <th>Email</th>
                    <th>Loại</th>
                    <th>Mô tả</th>
                    <th>Trạng thái</th>
                    <th>Ngày tạo</th>
                    <th>Ngày phản hồi</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($supports as $index => $support)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $support->phone }}
                            @if ($support->created_at >= \Carbon\Carbon::now()->subHours(2))
                                <span class="badge badge-danger">New</span>
                            @endif
                        </td>
                        <td>{{ $support->email }}</td>
                        <td>{{ $support->type_title }}</td>
                        <td>{{ $support->description_info }}</td>
                        <td>{{ $support->status }}</td>
                        <td>
                            <div class="text-muted small">
                                {{ $support->created_at->format('d/m/Y H:i') }}
                            </div>
                        </td>
                        <td>
                            @if ($support->updated_at && !$support->created_at->eq($support->updated_at))
                                <div class="text-success small">
                                    {{ $support->updated_at->format('d/m/Y H:i') }}
                                </div>
                            @else
                                <div class="text-muted small">
                                    Chưa phản hồi
                                </div>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('support-manage.edit', $support->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                            <form action="{{ route('support-manage.destroy', $support->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Bạn có chắc muốn xóa?')">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <style>
    /* CSS để làm đẹp bảng */
    .table th {
        background-color: #f8f9fa;
        font-weight: 600;
        border-top: none;
    }

    .table td {
        vertical-align: middle;
    }

    .badge {
        font-size: 0.75em;
    }

    .text-muted {
        color: #6c757d !important;
    }

    .text-success {
        color: #28a745 !important;
    }

    .small {
        font-size: 0.875em;
    }

    .btn-sm {
        padding: 0.25rem 0.5rem;
        font-size: 0.875rem;
        margin-right: 5px;
    }

    /* Responsive cho mobile */
    @media (max-width: 768px) {
        .table-responsive {
            font-size: 0.875rem;
        }

        .btn-sm {
            padding: 0.2rem 0.4rem;
            font-size: 0.75rem;
        }
    }
    </style>
@endsection
