@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Danh sách tin tức</h2>

    <a href="{{ route('news-manage.create') }}" class="btn btn-primary mb-3">+ Thêm tin tức</a>

    <table class="table table-bordered">
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
            @foreach ($news as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->name }}</td>
                    <td>
                        @if($item->image)
                            <img src="{{ asset('storage/' . $item->image) }}" width="60">
                        @endif
                    </td>
                    <td>{{ $item->website }}</td>
                    <td>{{ $item->status }}</td>
                    <td>
                        <a href="{{ route('news-manage.show', $item->id) }}" class="btn btn-info btn-sm">Xem</a>
                        <a href="{{ route('news-manage.edit', $item->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                        <form action="{{ route('news-manage.destroy', $item->id) }}" method="POST"
                              style="display:inline-block">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Bạn chắc chắn xoá?')">Xoá</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

