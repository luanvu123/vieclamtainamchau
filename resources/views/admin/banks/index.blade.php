@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Danh sách ngân hàng</h1>

        <a href="{{ route('banks.create') }}" class="btn btn-success mb-3">Thêm ngân hàng mới</a>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-bordered">
            <thead>
    <tr>
        <th>#</th>
        <th>Tên ngân hàng</th>
        <th>Ảnh</th>
        <th>Chủ tài khoản</th>
        <th>Số tài khoản</th>
        <th>Chi nhánh</th>
        <th>Mã SWIFT</th>
        <th>Trạng thái</th>
        <th>Hành động</th>
    </tr>
</thead>
<tbody>
    @foreach ($banks as $key => $bank)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $bank->name }}</td>
            <td>
                @if ($bank->image)
                    <img src="{{ asset('storage/' . $bank->image) }}" alt="Ảnh ngân hàng" width="60" height="60" style="object-fit: cover; border-radius: 8px;">
                @else
                    <img src="{{ asset('frontend/img/default_bank.png') }}" alt="No image" width="60" height="60" style="object-fit: cover; border-radius: 8px;">
                @endif
            </td>
            <td>{{ $bank->account_name }}</td>
            <td>{{ $bank->account_number }}</td>
            <td>{{ $bank->branch }}</td>
            <td>{{ $bank->swift_code ?? 'Chưa có' }}</td>
            <td>
                @if ($bank->status == 1)
                    <span class="badge badge-success">Hoạt động</span>
                @else
                    <span class="badge badge-secondary">Ẩn</span>
                @endif
            </td>
            <td>
                <a href="{{ route('banks.edit', $bank->id) }}" class="btn btn-sm btn-warning">Sửa</a>
                <form action="{{ route('banks.destroy', $bank->id) }}" method="POST" style="display:inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc muốn xoá?')">Xoá</button>
                </form>
            </td>
        </tr>
    @endforeach
</tbody>

        </table>
    </div>
@endsection
