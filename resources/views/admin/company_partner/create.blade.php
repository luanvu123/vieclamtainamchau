@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Thêm đối tác</h2>
    <form action="{{ route('company-partners.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="name">Tên đối tác</label>
            <input type="text" name="name" class="form-control" required value="{{ old('name') }}">
        </div>
        <div class="mb-3">
            <label for="image">Ảnh</label>
            <input type="file" name="image" class="form-control">
        </div>
        <div class="mb-3">
            <label for="status">Trạng thái</label>
            <select name="status" class="form-control">
                <option value="1">Hiện</option>
                <option value="0">Ẩn</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Lưu</button>
    </form>
</div>
@endsection
