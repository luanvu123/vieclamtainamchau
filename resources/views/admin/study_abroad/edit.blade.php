@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Chỉnh sửa chương trình Du học nghề</h1>

    <form action="{{ route('study-abroad-manage.update', $studyAbroad->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Tên chương trình</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $studyAbroad->name) }}" required>
        </div>

        <div class="form-group">
            <label for="short_detail">Mô tả ngắn</label>
            <textarea name="short_detail" class="form-control">{{ old('short_detail', $studyAbroad->short_detail) }}</textarea>
        </div>

        <div class="form-group">
            <label for="description">Mô tả chi tiết</label>
            <textarea name="description" class="form-control" rows="5">{{ old('description', $studyAbroad->description) }}</textarea>
        </div>

        <div class="form-group">
            <label for="image">Ảnh hiện tại</label><br>
            @if ($studyAbroad->image)
                <img src="{{ asset('storage/' . $studyAbroad->image) }}" alt="image" width="200">
            @else
                <p>Không có ảnh</p>
            @endif
            <br><br>
            <label for="image">Cập nhật ảnh mới (nếu có)</label>
            <input type="file" name="image" class="form-control-file">
        </div>
<!-- Danh mục -->
<div class="form-group">
    <label for="categories">Danh mục</label>
    <select name="categories[]" class="form-control" multiple>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}"
                {{ $studyAbroad->categories->contains($category->id) ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
</div>

<!-- Quốc gia -->
<div class="form-group">
    <label for="countries">Quốc gia</label>
    <select name="countries[]" class="form-control" multiple>
        @foreach ($countries as $country)
            <option value="{{ $country->id }}"
                {{ $studyAbroad->countries->contains($country->id) ? 'selected' : '' }}>
                {{ $country->name }}
            </option>
        @endforeach
    </select>
</div>

        <div class="form-group">
            <label for="status">Trạng thái</label>
            <select name="status" class="form-control">
                <option value="1" {{ $studyAbroad->status ? 'selected' : '' }}>Hoạt động</option>
                <option value="0" {{ !$studyAbroad->status ? 'selected' : '' }}>Không hoạt động</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Cập nhật</button>
        <a href="{{ route('study-abroad-manage.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection
