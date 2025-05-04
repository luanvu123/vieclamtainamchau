@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Danh sách từ khóa tìm kiếm</h1>
        <a href="{{ route('keysearch.create') }}" class="btn btn-primary mb-3">Thêm mới</a>
        <table class="table" id="user-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tên</th>
                    <th>URL</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($keysearches as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->url }}</td>
                        <td>{{ $item->status ? 'Hiện' : 'Ẩn' }}</td>
                        <td>
                            <a href="{{ route('keysearch.edit', $item) }}" class="btn btn-sm btn-warning">Sửa</a>
                            <form action="{{ route('keysearch.destroy', $item) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('Bạn chắc chắn?')">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
