@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Danh sách tin tức</h1>
    <a href="{{ route('news.create') }}" class="btn btn-primary mb-3">Thêm tin tức mới</a>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <table class="table table-bordered" id="user-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Tên</th>
                <th>Hình ảnh</th>
                <th>Mô tả</th>
                <th>Website</th>
                <th>Trạng thái</th>
                <th>Nổi bật</th>
                <th>Quảng cáo</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($news as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->name }}</td>
                    <td>
                        @if ($item->image)
                            <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}" style="max-width: 100px;">
                        @else
                            <span>Không có hình ảnh</span>
                        @endif
                    </td>
                    <td>{{ \Illuminate\Support\Str::limit($item->description, 50) }}</td>
                    <td><a href="{{ $item->website }}" target="_blank">{{ $item->website }}</a></td>
                    <td>{{ $item->status ? 'Hoạt động' : 'Không hoạt động' }}</td>
                    <td>{{ $item->isOutstanding ? 'Có' : 'Không' }}</td>
                     <td>{{ $item->isBanner ? 'Có' : 'Không' }}</td>
                    <td>
                        <a href="{{ route('news.show', $item->id) }}" class="btn btn-info btn-sm">Xem</a>
                        <a href="{{ route('news.edit', $item->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                        <form action="{{ route('news.destroy', $item->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa tin tức này không?')">Xóa</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">Không có tin tức nào.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Phân trang -->
    <div class="d-flex justify-content-center">
        {{ $news->links() }}
    </div>
</div>
@endsection
