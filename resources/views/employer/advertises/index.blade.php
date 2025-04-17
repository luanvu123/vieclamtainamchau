@extends('layouts.manage')

@section('content')
<div class="main-content">
    <h1>Danh sách quảng cáo</h1>

    <a href="{{ route('employer.advertises.create') }}" class="btn btn-primary mb-3">Thêm mới</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table" id="advertise-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Tiêu đề</th>
                <th>Hình ảnh</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($advertises as $advertise)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $advertise->title }}</td>
                    <td>
                        @if ($advertise->image)
                            <img src="{{ asset('storage/' . $advertise->image) }}" alt="Hình ảnh" width="80">
                        @else
                            Không có ảnh
                        @endif
                    </td>
                    <td>{{ $advertise->status ? 'Hiển thị' : 'Ẩn' }}</td>
                    <td>
                        <a href="{{ route('employer.advertises.edit', $advertise->id) }}" class="btn btn-warning">Sửa</a>
                        <form action="{{ route('employer.advertises.destroy', $advertise->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" onclick="return confirm('Bạn có chắc muốn xóa?')">Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
