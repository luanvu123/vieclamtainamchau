@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Danh sách Quảng cáo</h2>
    <a href="{{ route('advertises-manage.create') }}" class="btn btn-primary mb-3">+ Thêm Quảng Cáo</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Tiêu đề</th>
                <th>Ảnh</th>
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
                            <img src="{{ asset('storage/' . $advertise->image) }}" width="60">
                        @endif
                    </td>
                    <td>{{ $advertise->status ? 'Hiển thị' : 'Ẩn' }}</td>
                    <td>
                        <a href="{{ route('advertises-manage.edit', $advertise->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                        <form action="{{ route('advertises-manage.destroy', $advertise->id) }}" method="POST" style="display:inline-block">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Bạn chắc chắn xoá quảng cáo này?')">Xoá</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
