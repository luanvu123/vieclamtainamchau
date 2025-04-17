@extends('layouts.manage')

@section('content')
<div class="main-content">
    <h1>Chỉnh sửa tin tức</h1>

    <form action="{{ route('employer.news.update', $news->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Tên tin tức</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $news->name) }}" required>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Ảnh hiện tại</label><br>
            @if ($news->image)
                <img src="{{ asset('storage/' . $news->image) }}" alt="Ảnh hiện tại" width="120" class="mb-2">
            @else
                <p>Không có ảnh</p>
            @endif
            <input type="file" name="image" class="form-control">
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Mô tả</label>
            <textarea name="description" class="form-control" rows="4">{{ old('description', $news->description) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="website" class="form-label">Website</label>
            <input type="url" name="website" class="form-control" value="{{ old('website', $news->website) }}">
        </div>
        <button type="submit" class="btn btn-primary">Cập nhật</button>
        <a href="{{ route('employer.news.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection
