@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Thêm mới chương trình đào tạo ngôn ngữ</h1>
    <form action="{{ route('language-trainings.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="name">Tên</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="description">Mô tả</label>
            <textarea name="description" class="form-control"></textarea>
        </div>

        <div class="form-group">
            <label for="status">Trạng thái</label>
            <select name="status" class="form-control">
                <option value="1">Hoạt động</option>
                <option value="0">Ngừng hoạt động</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Lưu</button>
    </form>
</div>
@endsection
