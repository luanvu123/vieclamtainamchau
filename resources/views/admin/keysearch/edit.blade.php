@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Chỉnh sửa từ khóa tìm kiếm</h2>

    <form action="{{ route('keysearch.update', $keysearch->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Tên từ khóa</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $keysearch->name) }}" required>
        </div>

        <div class="form-group">
            <label for="url">URL liên kết</label>
            <input type="text" class="form-control" id="url" name="url" value="{{ old('url', $keysearch->url) }}" required>
        </div>

        <div class="form-group">
            <label for="status">Trạng thái</label>
            <select name="status" id="status" class="form-control" required>
                <option value="1" {{ old('status', $keysearch->status) == '1' ? 'selected' : '' }}>Hiện</option>
                <option value="0" {{ old('status', $keysearch->status) == '0' ? 'selected' : '' }}>Ẩn</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Cập nhật</button>
        <a href="{{ route('keysearch.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection
