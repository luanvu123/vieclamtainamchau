@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Chỉnh sửa tin tức</h2>

    <form action="{{ route('news-manage.update', $news->id) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')

        <div class="mb-3">
            <label class="form-label">Tên</label>
            <input type="text" name="name" class="form-control" value="{{ $news->name }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Ảnh hiện tại</label><br>
            @if($news->image)
                <img src="{{ asset('storage/' . $news->image) }}" width="100"><br><br>
            @endif
            <input type="file" name="image" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Website</label>
            <input type="url" name="website" class="form-control" value="{{ $news->website }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Mô tả</label>
            <textarea name="description" class="form-control" rows="4">{{ $news->description }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Trạng thái</label>
            <select name="status" class="form-control">
                <option value="active" {{ $news->status == 'active' ? 'selected' : '' }}>Hoạt động</option>
                <option value="inactive" {{ $news->status == 'inactive' ? 'selected' : '' }}>Không hoạt động</option>
            </select>
        </div>

        <button class="btn btn-success">Cập nhật</button>
        <a href="{{ route('news-manage.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection
