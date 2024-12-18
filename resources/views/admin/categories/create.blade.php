@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Thêm ngành nghề mới</h1>
    <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Tên danh mục</label>
            <input type="text" name="name" class="form-control" id="name" required>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Hình ảnh</label>
            <input type="file" name="image" class="form-control" id="image">
        </div>
        <button type="submit" class="btn btn-success">Thêm</button>
    </form>
</div>
@endsection
