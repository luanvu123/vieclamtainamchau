@extends('layouts.manage')

@section('content')
<div class="main-content">
    <h1>Chỉnh sửa quảng cáo</h1>

    <form action="{{ route('employer.advertises.update', $advertise->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">Tiêu đề</label>
            <input type="text" class="form-control" name="title" value="{{ old('title', $advertise->title) }}">
            @error('title') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Hình ảnh</label><br>
            @if ($advertise->image)
                <img src="{{ asset('storage/' . $advertise->image) }}" alt="Hình ảnh" width="100" class="mb-2"><br>
            @endif
            <input type="file" class="form-control" name="image">
            @error('image') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">Nội dung</label>
            <textarea class="form-control" name="content" rows="5">{{ old('content', $advertise->content) }}</textarea>
        </div>

       

        <button type="submit" class="btn btn-success">Cập nhật</button>
    </form>
</div>
@endsection
