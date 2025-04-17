@extends('layouts.manage')
@section('content')
<div class="main-content">
    <h1>Danh sách tin tức</h1>
    <a href="{{ route('employer.news.create') }}" class="btn btn-primary mb-3">Thêm mới</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Tên</th>
                <th>Ảnh</th>
                <th>Website</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($newsList as $news)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $news->name }}</td>
                    <td>
                        @if ($news->image)
                            <img src="{{ asset('storage/' . $news->image) }}" alt="" width="80">
                        @else
                            Không có ảnh
                        @endif
                    </td>
                    <td>{{ $news->website }}</td>
                    <td>{{ $news->status ? 'Hoạt động' : 'Ngừng' }}</td>
                    <td>
                        <a href="{{ route('employer.news.edit', $news->id) }}" class="btn btn-warning">Sửa</a>
                        <form action="{{ route('employer.news.destroy', $news->id) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Xóa?')">Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
