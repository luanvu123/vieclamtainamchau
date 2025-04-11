 @extends('layout')
 @section('content')
      <section class="hotlines-section">
         <div class="sidebar">
            <div class="menu-section">
                <div class="menu-title">Quản lý đăng tuyển dụng</div>
                <a href="{{ route('employer.job-posting.create') }}" class="menu-item">
                    <i>+</i>
                    <span>Tạo tin tuyển dụng</span>
                </a>
                <a href="{{ route('employer.job-posting.index') }}" class="menu-item">
                    <i>📋</i>
                    <span>Quản lý tin đăng</span>
                </a>
                <a href="{{ route('employer.services') }}" class="menu-item">
                    <i>📊</i>
                    <span>Mua dịch vụ</span>
                </a>
                <a href="{{ route('employer.service-active') }}" class="menu-item">
                    <i>❤️</i>
                    <span>Dịch vụ đã mua</span>
                </a>
                 <a href="{{ route('employer.orders.index') }}" class="menu-item">
        <i>🧾</i>
        <span>Lịch sử đơn hàng</span>
    </a>
            </div>

            <div class="menu-section">
                <div class="menu-title">Quản lý ứng viên</div>
                <a href="{{ route('employer.saved-applications') }}" class="menu-item">
                    <i>👥</i>
                    <span>Hồ sơ ứng tuyển</span>
                </a>
                <a href="{{ route('employer.job-posting.find-candidate') }}" class="menu-item">
                    <i>🔍</i>
                    <span>Tìm ứng viên mới</span>
                </a>

            </div>
        </div>

         <div class="main-content">
  <h1>Danh sách đơn hàng</h1>

    @if($orders->isEmpty())
        <div class="alert alert-info">
            Bạn chưa có đơn hàng nào.
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Mã đơn hàng</th>
                        <th>Ngày đặt</th>
                        <th>Tổng tiền</th>
                        <th>Trạng thái</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td>{{ $order->order_key }}</td>
                            <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                            <td>₫{{ number_format($order->total_price, 0) }}</td>
                            <td>
                                @if($order->status == 'Đã thanh toán')
                                    <span class="badge bg-success">{{ $order->status }}</span>
                                @else
                                    <span class="badge bg-warning">{{ $order->status }}</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('employer.orders.show', $order->id) }}" class="btn btn-primary btn-sm">
                                    Xem chi tiết
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center">
            {{ $orders->links() }}
        </div>
    @endif

            </div>



      </section>
 @endsection

