@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tạo mới dịch vụ</h1>
    <form action="{{ route('services.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Tên dịch vụ</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="image">Ảnh</label>
            <input type="file" name="image" class="form-control">
        </div>
        <div class="form-group">
            <label for="price">Giá</label>
            <input type="number" name="price" class="form-control" required>
        </div>
        <div class="form-group">
    <label for="typeservice_id">Thể loại dịch vụ</label>
    <select name="typeservice_id" class="form-control" required>
        <option value="">-- Chọn thể loại --</option>
        @foreach($typeservices as $type)
            <option value="{{ $type->id }}">{{ $type->name }}</option>
        @endforeach
    </select>
</div>

        <div class="form-group">
            <label for="description">Mô tả</label>
            <textarea name="description" class="form-control" required></textarea>
        </div>
        <div class="form-group">
    <label for="number_of_weeks">Số tuần</label>
    <select name="number_of_weeks[]" class="form-control" multiple required>
        <option value="1">1 tuần</option>
        <option value="2">2 tuần</option>
        <option value="4">4 tuần</option>
    </select>
</div>

        <div class="form-group">
            <label for="status">Trạng thái</label>
            <select name="status" class="form-control" required>
                <option value="active">Hoạt động</option>
                <option value="inactive">Ngừng hoạt động</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Lưu</button>
    </form>
</div>
@endsection
