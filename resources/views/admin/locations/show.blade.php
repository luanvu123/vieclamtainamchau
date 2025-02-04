@extends('layouts.app')

@section('content')
    <h2>Chi tiết Địa điểm</h2>

    <p><strong>ID:</strong> {{ $location->id }}</p>
    <p><strong>Tên:</strong> {{ $location->name }}</p>
    <p><strong>Mô tả:</strong> {{ $location->description }}</p>
    <p><strong>Trạng thái:</strong> {{ $location->status == 'active' ? 'Hoạt động' : 'Không hoạt động' }}</p>

    <a href="{{ route('locations.edit', $location) }}" class="btn btn-warning">Chỉnh sửa</a>
    <a href="{{ route('locations.index') }}" class="btn btn-secondary">Quay lại</a>

    <form action="{{ route('locations.destroy', $location) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc muốn xóa?')">Xóa</button>
    </form>
@endsection
