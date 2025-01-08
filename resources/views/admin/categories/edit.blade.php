<?php
?>
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Sửa ngành nghề</h1>
        <form action="{{ route('categories.update', $category) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Tên danh mục</label>
                <input type="text" name="name" class="form-control" id="name" value="{{ $category->name }}"
                    required>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Hình ảnh</label>
                <input type="file" name="image" class="form-control" id="image">
                @if ($category->image)
                    <div class="mt-2">
                        <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" width="100">
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label for="isHot">Du học nghề</label>
                <input type="checkbox" id="isHot" name="isHot" value="1"
                    {{ old('isHot', $category->isHot ?? 0) ? 'checked' : '' }}>
            </div>

            <select name="status" class="form-control" id="status">
                <option value="active" {{ $category->status === 'active' ? 'selected' : '' }}>Hoạt động</option>
                <option value="inactive" {{ $category->status === 'inactive' ? 'selected' : '' }}>Không hoạt động</option>
            </select>



            <button type="submit" class="btn btn-success">Cập nhật</button>
        </form>
    </div>
@endsection
