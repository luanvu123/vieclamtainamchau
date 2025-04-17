@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Sửa Quảng Cáo</h2>

    <!-- Hiển thị thông báo thành công hoặc lỗi -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Form sửa thông tin quảng cáo -->
    <form action="{{ route('advertises-manage.update', $advertise->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="title">Tiêu đề</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $advertise->title) }}" required>
            @error('title')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="image">Hình ảnh</label>
            <input type="file" class="form-control" id="image" name="image">
            @if ($advertise->image)
                <img src="{{ asset('storage/' . $advertise->image) }}" width="100" class="mt-2">
            @endif
            @error('image')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="content">Nội dung</label>
            <textarea class="form-control" id="content" name="content" rows="5">{{ old('content', $advertise->content) }}</textarea>
            @error('content')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="status">Trạng thái</label>
            <select class="form-control" id="status" name="status">
                <option value="1" {{ $advertise->status == 1 ? 'selected' : '' }}>Hiển thị</option>
                <option value="0" {{ $advertise->status == 0 ? 'selected' : '' }}>Ẩn</option>
            </select>
            @error('status')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Cập nhật Quảng Cáo</button>
    </form>

    <a href="{{ route('advertises-manage.index') }}" class="btn btn-secondary mt-3">Quay lại danh sách</a>
</div>
@endsection
