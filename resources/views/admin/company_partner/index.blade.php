@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Danh sách đối tác</h2>
    <a href="{{ route('company-partners.create') }}" class="btn btn-primary mb-3">Thêm đối tác</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered" id="user-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Tên</th>
                <th>Ảnh</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($partners as $partner)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $partner->name }}</td>
                <td>
                    @if($partner->image)
                        <img src="{{ asset('storage/' . $partner->image) }}" width="100">
                    @endif
                </td>
                <td>{{ $partner->status ? 'Hiện' : 'Ẩn' }}</td>
                <td>
                    <a href="{{ route('company-partners.edit', $partner) }}" class="btn btn-sm btn-warning">Sửa</a>
                    <form action="{{ route('company-partners.destroy', $partner) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Xác nhận xóa?')">Xóa</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
