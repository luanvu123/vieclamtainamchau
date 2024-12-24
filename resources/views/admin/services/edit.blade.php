@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Chỉnh sửa dịch vụ</h1>
    <form action="{{ route('services.update', $service->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Tên dịch vụ</label>
            <input type="text" name="name" class="form-control" value="{{ $service->name }}" required>
        </div>
        <div class="form-group">
            <label for="image">Ảnh</label>
            @if ($service->image)
                <div>
                    <img src="{{ asset('storage/' . $service->image) }}" alt="Ảnh dịch vụ" width="100">
                </div>
            @endif
            <input type="file" name="image" class="form-control">
        </div>
        <div class="form-group">
            <label for="price">Giá</label>
            <input type="number" name="price" class="form-control" value="{{ $service->price }}" required>
        </div>
        <div class="form-group">
            <label for="description">Mô tả</label>
            <textarea name="description" class="form-control" required>{{ $service->description }}</textarea>
        </div>
        <div class="form-group">
            <label for="status">Trạng thái</label>
            <select name="status" class="form-control" required>
                <option value="active" {{ $service->status == 'active' ? 'selected' : '' }}>Hoạt động</option>
                <option value="inactive" {{ $service->status == 'inactive' ? 'selected' : '' }}>Ngừng hoạt động</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Cập nhật</button>
    </form>
</div>
@endsection
