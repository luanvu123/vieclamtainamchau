@extends('layouts.manage')

@section('content')
<div class="main-content">
    <h1>Thêm quảng cáo mới</h1>

    <form action="{{ route('employer.advertises.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">Tiêu đề</label>
            <input type="text" class="form-control" name="title" value="{{ old('title') }}">
            @error('title') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Hình ảnh</label>
            <input type="file" class="form-control" name="image">
            @error('image') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">Nội dung</label>
            <textarea class="form-control" name="content" rows="5">{{ old('content') }}</textarea>
        </div>


        <button type="submit" class="btn btn-success">Lưu</button>
    </form>
</div>
@endsection
