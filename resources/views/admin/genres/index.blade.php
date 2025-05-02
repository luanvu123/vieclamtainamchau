@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Danh sách danh mục</h1>
        <a href="{{ route('genres.create') }}"class="btn btn-primary mb-3">Tạo mới</a>

        @if(session('success'))
            <p>{{ session('success') }}</p>
        @endif


<table class="table table-bordered" id="user-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tên</th>
                    <th>Slug</th>
                    <th>Trạng thái</th>
                    <th>Nổi bật</th>

                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($genres as $key=> $genre)
                    <tr>
                        <td>{{ $key }}</td>
                        <td>{{ $genre->name }}</td>
                        <td>{{ $genre->slug }}</td>
                        <td>{{ ucfirst($genre->status) }}</td>
                        <td>{{ $genre->hot ? 'Có' : 'Không' }}</td>

                        <td>
                            <a href="{{ route('genres.edit', $genre->id) }}"  class="btn btn-sm btn-warning">Sửa</a>
                            <form action="{{ route('genres.destroy', $genre->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" type="submit" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
