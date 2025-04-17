@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Thêm tin tức mới</h2>

    <form action="{{ route('news-manage.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="form-label">Tên</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Ảnh</label>
            <input type="file" name="image" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Website</label>
            <input type="url" name="website" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Mô tả</label>
            <textarea name="description" class="form-control" rows="4"></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Trạng thái</label>
            <select name="status" class="form-control">
                <option value="active">Hoạt động</option>
                <option value="inactive">Không hoạt động</option>
            </select>
        </div>

        <button class="btn btn-success">Lưu</button>
        <a href="{{ route('news-manage.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection
