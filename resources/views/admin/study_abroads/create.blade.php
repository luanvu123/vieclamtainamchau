@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Thêm mới chương trình du học</h1>
    <form action="{{ route('study-abroads.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="name">Tên chương trình</label>
            <input type="text" name="name" class="form-control" required>
        </div> 

        <div class="form-group">
            <label for="image">Hình ảnh</label>
            <input type="file" name="image" class="form-control">
        </div>

        <div class="form-group">
            <label for="description">Mô tả</label>
            <textarea name="description" class="form-control"></textarea>
        </div>
         <div class="form-group">
            <label for="short_detail">Mô tả ngắn</label>
            <input type="text" name="short_detail" class="form-control" required>
        </div>


        <div class="form-group">
            <label for="status">Trạng thái</label>
            <select name="status" class="form-control">
                <option value="1">Hoạt động</option>
                <option value="0">Ngừng hoạt động</option>
            </select>
        </div>

        <div class="form-group">
            <label for="categories">Ngành nghề</label>
            <select id="categories" name="categories[]" class="form-control" multiple>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            @error('categories')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="countries">Quốc gia</label>
            <select id="countries" name="countries[]" class="form-control" multiple>
                @foreach ($countries as $country)
                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                @endforeach
            </select>
            @error('countries')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Lưu</button>
    </form>
</div>
@endsection
