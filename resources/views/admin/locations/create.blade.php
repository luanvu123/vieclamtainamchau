@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Thêm Địa điểm mới</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('locations.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Tên Địa điểm:</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="Nhập tên địa điểm" required>
        </div>

        <div class="form-group">
            <label for="description">Địa chỉ cụ thể:</label>
            <textarea name="description" id="description" class="form-control" placeholder="Nhập mô tả"></textarea>
        </div>

        <div class="form-group">
            <label for="status">Trạng thái:</label>
            <select name="status" id="status" class="form-control">
                <option value="active">Hoạt động</option>
                <option value="inactive">Không hoạt động</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Lưu</button>
        <a href="{{ route('locations.index') }}" class="btn btn-secondary">Hủy</a>
    </form>
</div>

@endsection
