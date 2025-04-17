@extends('layouts.manage')

@section('content')
<div class="main-content">
    <h1>Thêm tin tức mới</h1>

    <form action="{{ route('employer.news.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Tên tin tức</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Ảnh</label>
            <input type="file" name="image" class="form-control">
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Mô tả</label>
            <textarea name="description" class="form-control" rows="4">{{ old('description') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="website" class="form-label">Website</label>
            <input type="url" name="website" class="form-control" value="{{ old('website') }}">
        </div>

       

        <button type="submit" class="btn btn-success">Lưu</button>
        <a href="{{ route('employer.news.index') }}" class="btn btn-secondary">Hủy</a>
    </form>
</div>
@endsection
