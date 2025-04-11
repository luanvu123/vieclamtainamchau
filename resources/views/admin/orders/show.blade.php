<!-- resources/views/manage/orders/show.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 text-gray-800">Chi tiết đơn hàng #{{ $order->order_key }}</h1>
        <a href="{{ route('manage.orders.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Quay lại
        </a>
    </div>

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

    <div class="row">
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Thông tin đơn hàng</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th width="40%">ID đơn hàng</th>
                                    <td>{{ $order->id }}</td>
                                </tr>
                                <tr>
                                    <th>Mã đơn hàng</th>
                                    <td>{{ $order->order_key }}</td>
                                </tr>
                                <tr>
                                    <th>Nhà tuyển dụng</th>
                                    <td>
                                        <a href="{{ route('manage.employers.show', $order->employer_id) }}">
                                            {{ $order->employer->name }}
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Tổng tiền</th>
                                    <td>₫{{ number_format($order->total_price, 0) }}</td>
                                </tr>
                                <tr>
                                    <th>Trạng thái</th>
                                    <td>
                                        <form action="{{ route('manage.orders.updateStatus', $order->id) }}" method="POST">
                                            @csrf
                                            <div class="input-group">
                                                <select class="form-control" name="status">
                                                    <option value="Chưa thanh toán" {{ $order->status == 'Chưa thanh toán' ? 'selected' : '' }}>Chưa thanh toán</option>
                                                    <option value="Đã thanh toán" {{ $order->status == 'Đã thanh toán' ? 'selected' : '' }}>Đã thanh toán</option>
                                                </select>
                                                <div class="input-group-append">
                                                    <button class="btn btn-primary" type="submit">Cập nhật</button>
                                                </div>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Ngày tạo</th>
                                    <td>{{ $order->created_at->format('d/m/Y H:i:s') }}</td>
                                </tr>
                                <tr>
                                    <th>Ngày cập nhật</th>
                                    <td>{{ $order->updated_at->format('d/m/Y H:i:s') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Chi tiết dịch vụ</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Dịch vụ</th>
                            <th>Số lượng</th>
                            <th>Số tuần</th>
                            <th>Đơn giá</th>
                            <th>Thành tiền</th>
                            <th>Ngày hết hạn</th>
                            <th>Đã kích hoạt</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->orderDetails as $detail)
                            <tr>
                                <td>{{ $detail->id }}</td>
                                <td>{{ $detail->service->name }}</td>
                                <td>{{ $detail->quantity }}</td>
                                <td>{{ $detail->number_of_weeks }}</td>
                                <td>₫{{ number_format($detail->price, 0) }}</td>
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
                                    <form action="{{ route('manage.orderDetails.updateActive', $detail->id) }}" method="POST">
                                        @csrf
                                        <div class="input-group">
                                            <input type="number" class="form-control" name="number_of_active" value="{{ $detail->number_of_active }}" min="0" max="{{ $detail->quantity }}">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary" type="submit">Cập nhật</button>
                                            </div>
                                        </div>
                                    </form>
                                </td>
                                <td>
                                    <a href="#" class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
