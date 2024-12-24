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
                <th>Khu vực</th>
                <th>Tên ngân hàng</th>
                <th>Chi nhánh</th>
                <th>Số tài khoản</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($banks as $bank)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $bank->area }}</td>
                    <td>{{ $bank->name }}</td>
                    <td>{{ $bank->branch }}</td>
                    <td>{{ $bank->account_number }}</td>
                    <td>{{ $bank->status == 1 ? 'Hoạt động' : 'Ngừng hoạt động' }}</td>
                    <td>
                        <a href="{{ route('banks.edit', $bank->id) }}" class="btn btn-primary btn-sm">Sửa</a>
                        <form action="{{ route('banks.destroy', $bank->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">Chưa có thông tin ngân hàng.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
