@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Thêm chương trình Du học nghề</h1>

    <form action="{{ route('study-abroad-manage.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="name">Tên chương trình</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
        </div>

        <div class="form-group">
            <label for="short_detail">Mô tả ngắn</label>
            <textarea name="short_detail" class="form-control">{{ old('short_detail') }}</textarea>
        </div>

        <div class="form-group">
            <label for="description">Mô tả chi tiết</label>
            <textarea name="description" class="form-control" rows="5">{{ old('description') }}</textarea>
        </div>

        <div class="form-group">
            <label for="image">Ảnh</label>
            <input type="file" name="image" class="form-control-file">
        </div>

        <div class="form-group">
            <label for="status">Trạng thái</label>
            <select name="status" class="form-control">
                <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Hoạt động</option>
                <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Không hoạt động</option>
            </select>
        </div>
<!-- Danh mục -->
<div class="form-group">
    <label for="categories">Danh mục</label>
    <select name="categories[]" class="form-control" multiple>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
    </select>
</div>

<!-- Quốc gia -->
<div class="form-group">
    <label for="countries">Quốc gia</label>
    <select name="countries[]" class="form-control" multiple>
        @foreach ($countries as $country)
            <option value="{{ $country->id }}">{{ $country->name }}</option>
        @endforeach
    </select>
</div>

        <button type="submit" class="btn btn-primary">Lưu</button>
        <a href="{{ route('study-abroad-manage.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection
