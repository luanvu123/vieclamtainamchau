@extends('layouts.app')

@section('content')
    <h2>Danh sách Địa điểm</h2>
    <a href="{{ route('locations.create') }}" class="btn btn-primary">Thêm Địa điểm</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table" id="user-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên</th>
                <th>Mô tả</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($locations as $location)
                <tr>
                    <td>{{ $location->id }}</td>
                    <td>{{ $location->name }}</td>
                    <td>{!! $location->description !!}</td>
                    <td>{{ $location->status }}</td>
                    <td>
                        <a href="{{ route('locations.show', $location) }}" class="btn btn-info">Xem</a>
                        <a href="{{ route('locations.edit', $location) }}" class="btn btn-warning">Sửa</a>
                        <form action="{{ route('locations.destroy', $location) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Xóa?')">Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>


@endsection
