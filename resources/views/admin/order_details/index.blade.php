@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Quản lý chi tiết đơn hàng</h1>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Danh sách chi tiết đơn hàng</h6>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-bordered" id="orderDetailsTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Mã đơn hàng</th>
                                <th>Nhà tuyển dụng</th>
                                <th>Dịch vụ</th>
                                <th>Số lượng</th>
                                <th>Số tuần</th>
                                <th>Thành tiền</th>
                                <th>Ngày hết hạn</th>
                                <th>Đang hoạt động</th>
                                <th>Trạng thái</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orderDetails as $detail)
                                <tr>
                                    <td>{{ $detail->id }}</td>
                                    <td>
                                        <a href="{{ route('manage.orders.show', $detail->order_id) }}">
                                            {{ $detail->order->order_key }}
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ route('manage.employers.show', $detail->order->employer_id) }}">
                                            {{ $detail->order->employer->name }}
                                        </a>
                                    </td>
                                    <td>{{ $detail->service->name }}</td>
                                    <td>{{ $detail->quantity }}</td>
                                    <td>{{ $detail->number_of_weeks }}</td>
                                    <td>₫{{ number_format($detail->total_price, 0) }}</td>
                                    <td>
                                        @if ($detail->expiring_date)
                                            {{ \Carbon\Carbon::parse($detail->expiring_date)->format('d/m/Y') }}
                                            @if (\Carbon\Carbon::parse($detail->expiring_date) < now())
                                                <span class="badge badge-danger">Hết hạn</span>
                                            @else
                                                <span class="badge badge-success">Còn hạn</span>
                                            @endif
                                        @else
                                            Chưa kích hoạt
                                        @endif
                                    </td>
                                    <td>
                                        <form action="{{ route('manage.orderDetails.updateActive', $detail->id) }}"
                                            method="POST">
                                            @csrf
                                            <div class="input-group">
                                                <input type="number" class="form-control form-control-sm"
                                                    name="number_of_active" value="{{ $detail->number_of_active }}" min="0"
                                                    max="{{ $detail->quantity }}">
                                                <div class="input-group-append">
                                                    <button class="btn btn-primary btn-sm" type="submit">Cập nhật</button>
                                                </div>
                                            </div>
                                        </form>
                                    </td>
                                    <td>
                                        @if ($detail->order->status == 'Đã thanh toán')
                                            <span class="badge badge-success">Đã thanh toán</span>
                                        @else
                                            <span class="badge badge-warning">Chưa thanh toán</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-secondary btn-sm dropdown-toggle" type="button"
                                                id="dropdownMenuButton{{ $detail->id }}" data-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                                Tùy chọn
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $detail->id }}">
                                                <a class="dropdown-item"
                                                    href="{{ route('manage.orders.show', $detail->order_id) }}">
                                                    <i class="fas fa-eye fa-sm fa-fw mr-2 text-gray-400"></i>
                                                    Xem đơn hàng
                                                </a>
                                                @if ($detail->order->status == 'Đã thanh toán' && $detail->isActive())
                                                    <a class="dropdown-item" href="#">
                                                        <i class="fas fa-check fa-sm fa-fw mr-2 text-gray-400"></i>
                                                        Kích hoạt dịch vụ
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $orderDetails->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            $('#orderDetailsTable').DataTable({
                "paging": false,
                "info": false,
                "searching": true,
                "ordering": true,
                "order": [[0, 'desc']],
                "language": {
                    "search": "Tìm kiếm:",
                    "zeroRecords": "Không tìm thấy bản ghi nào",
                    "emptyTable": "Không có dữ liệu trong bảng"
                }
            });
        });
    </script>
@endsection
