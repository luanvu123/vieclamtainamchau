@extends('layouts.manage')

@section('content')
<div class="main-content">
    <h1>Danh sách tài khoản ngân hàng</h1>

    @if ($banks->isNotEmpty())
        <table class="job-table" id="user-table">
            <thead>
                <tr>
                    <th>#</th>
                      <th>#</th>
                    <th>Tên ngân hàng</th>
                    <th>Chi nhánh</th>
                    <th>Số tài khoản</th>
                    <th>Tên tài khoản</th>
                    <th>Swift Code</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($banks as $key => $bank)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                          <td>
                            @if($bank->image)
                                <img src="{{ asset('storage/' .$bank->image) }}" alt="{{ $bank->name }}" style="width: 100px; height: auto;">
                            @else
                                <span>Không có logo</span>
                            @endif
                        </td>
                        <td>{{ $bank->name }}</td>
                        <td>{{ $bank->branch }}</td>
                        <td>{{ $bank->account_number }}</td>
                        <td>{{ $bank->account_name }}</td>
                        <td>{{ $bank->swift_code }}</td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p style="text-align: center; font-size: 16px; color: gray;">Không có thông tin ngân hàng nào.</p>
    @endif

    <div class="bank-info">
        <h2>Thông tin chuyển khoản</h2>
        <p>Khi chuyển khoản, vui lòng ghi rõ nội dung theo mẫu sau:</p>
        <div class="content-box">
            <p><strong>Nội dung chuyển khoản:</strong> [Tên công ty] - [Dịch vụ] - [Mã đơn hàng nếu có]</p>
            <p><strong>Ví dụ:</strong> Công ty ABC - Tin cơ bản - ORD12345</p>
        </div>

        <div class="note-box">
            <h3>Lưu ý:</h3>
            <ul>
                <li>Vui lòng chuyển khoản đúng số tài khoản và nội dung</li>
                <li>Sau khi chuyển khoản, vui lòng chụp ảnh biên lai và gửi qua email hoặc tải lên hệ thống</li>
                <li>Thời gian xác nhận thanh toán: 24-48h làm việc</li>
            </ul>
        </div>
    </div>
</div>

<style>
    .bank-info {
        margin-top: 30px;
        background-color: #f9f9f9;
        padding: 20px;
        border-radius: 5px;
    }

    .content-box {
        background-color: #eaeaea;
        padding: 15px;
        border-left: 4px solid #007bff;
        margin: 15px 0;
    }

    .note-box {
        background-color: #fff8dc;
        padding: 15px;
        border-radius: 5px;
        margin-top: 20px;
    }

    .note-box h3 {
        color: #ff6b6b;
        margin-top: 0;
    }

    .job-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    .job-table th, .job-table td {
        border: 1px solid #ddd;
        padding: 12px;
        text-align: left;
    }

    .job-table th {
        background-color: #f2f2f2;
        font-weight: bold;
    }

    .job-table tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    .job-table tr:hover {
        background-color: #f1f1f1;
    }
</style>
@endsection
