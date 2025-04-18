@extends('layouts.manage')
@section('content')


        <div class="main-content">
            <div class="mb-4">
                <a href="{{ route('employer.orders.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left"></i> Quay lại danh sách đơn hàng
                </a>
            </div>

            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h2>Chi tiết đơn hàng #{{ $order->order_key }}</h2>
                    <div>
                        @if($order->status == 'Đã thanh toán')
                            <span class="badge bg-success">{{ $order->status }}</span>
                        @else
                            <span class="badge bg-warning">{{ $order->status }}</span>
                        @endif
                    </div>
                </div>

                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h5>Thông tin đơn hàng</h5>
                            <p><strong>Mã đơn hàng:</strong> {{ $order->order_key }}</p>
                            <p><strong>Ngày đặt:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>
                            <p><strong>Trạng thái:</strong> {{ $order->status }}</p>
                        </div>
                    </div>

                    <h5>Chi tiết dịch vụ</h5>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Dịch vụ</th>
                                    <th>Số lượng</th>
                                    <th>Thời gian</th>
                                    <th>Đơn giá</th>
                                    <th>Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->orderDetails as $detail)
                                    <tr>
                                        <td>{{ $detail->service->name }}</td>
                                        <td>{{ $detail->quantity }}</td>
                                        <td>{{ $detail->number_of_weeks }} tuần</td>
                                        <td>₫{{ number_format($detail->price, 0) }}</td>
                                        <td>₫{{ number_format($detail->total_price, 0) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                          <tfoot>
    <tr>
        <td colspan="4" class="text-end"><strong>Tổng cộng (Chưa bao gồm thuế VAT):</strong></td>
        <td><strong>₫{{ number_format($order->total_price, 0) }}</strong></td>
    </tr>
    <tr>
        <td colspan="4" class="text-end"><strong>Giá trị quy đổi (USD):</strong></td>
        <td><strong>${{ number_format($usdTotal, 2) }}</strong></td>
    </tr>
</tfoot>

                        </table>
                    </div>

                    @if($order->status == 'Chưa thanh toán')
                        <div class="alert alert-info">
                            <h5>Hướng dẫn thanh toán</h5>
                            <p>Vui lòng thực hiện chuyển khoản theo một trong các tài khoản dưới đây:</p>

                            @foreach($banks as $bank)
                                <div class="border p-3 mb-3 rounded bg-light">
                                    <p><strong>Ngân hàng:</strong> {{ $bank->name }} - {{ $bank->branch }}</p>
                                    <p><strong>Chủ tài khoản:</strong> {{ $bank->account_name }}</p>
                                    <p><strong>Số tài khoản:</strong> {{ $bank->account_number }}</p>
                                    <p><strong>Nội dung chuyển khoản:</strong> {{ $order->order_key }}</p>
                                    <p><strong>Số tiền:</strong> ₫{{ number_format($order->total_price, 0) }}</p>

                                    @if($bank->logo_bank)
                                        <img src="{{ asset('storage/' . $bank->image) }}" alt="Logo Ngân hàng"
                                            style="height: 200px;">
                                    @endif
                                </div>
                            @endforeach

                            <p>Sau khi chuyển khoản, vui lòng liên hệ với chúng tôi qua số điện thoại [SỐ ĐIỆN THOẠI] hoặc email
                                [EMAIL] để xác nhận thanh toán.</p>
                        </div>

                    @endif
                </div>
            </div>

        </div>
@endsection
