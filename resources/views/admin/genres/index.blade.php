@extends('layouts.app')

@section('content')
    <h1>Danh sách danh mục</h1>
    <a href="{{ route('genres.create') }}">Tạo mới</a>

    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <table  class="table"  id="user-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên</th>
                <th>Slug</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($genres as $genre)
                <tr>
                    <td>{{ $genre->id }}</td>
                    <td>{{ $genre->name }}</td>
                    <td>{{ $genre->slug }}</td>
                    <td>{{ ucfirst($genre->status) }}</td>
                    <td>
                        <a href="{{ route('genres.edit', $genre->id) }}">Sửa</a>
                        <form action="{{ route('genres.destroy', $genre->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
