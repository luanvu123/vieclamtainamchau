@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Danh sách ngành nghề</h1>
    <a href="{{ route('categories.create') }}" class="btn btn-primary mb-3">Thêm danh mục mới</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table" id="user-table">
        <thead>
            <tr>
                <th>id</th>
                <th>Tên</th>
                <th>Hình ảnh</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
            <tr>
                <td>{{$category->id}}</td>
                <td>{{ $category->name }}</td>
                <td>
                    @if ($category->image)
                        <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" width="50">
                    @else
                        Không có hình ảnh
                    @endif
                </td>
               <td>{{ $category->status == 'active' ? 'Hoạt động' : 'Không hoạt động' }}</td>

                <td>
                    <a href="{{ route('categories.edit', $category) }}" class="btn btn-warning btn-sm">Sửa</a>
                    <form action="{{ route('categories.destroy', $category) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
