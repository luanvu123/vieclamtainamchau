@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Thêm tin tức mới</h1>
    <form action="{{ route('news.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Tên</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
            @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Hình ảnh</label>
            <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image">
            @error('image')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Mô tả</label>
            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description">{{ old('description') }}</textarea>
            @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="website" class="form-label">Website</label>
            <input type="url" class="form-control @error('website') is-invalid @enderror" id="website" name="website" value="{{ old('website') }}">
            @error('website')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Trạng thái</label>
            <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Hoạt động</option>
                <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Không hoạt động</option>
            </select>
            @error('status')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="isOutstanding" class="form-label">Nổi bật</label>
            <select class="form-select @error('isOutstanding') is-invalid @enderror" id="isOutstanding" name="isOutstanding" required>
                <option value="1" {{ old('isOutstanding') == 1 ? 'selected' : '' }}>Có</option>
                <option value="0" {{ old('isOutstanding') == 0 ? 'selected' : '' }}>Không</option>
            </select>
            @error('isOutstanding')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
         <div class="mb-3">
            <label for="isBanner" class="form-label">Quảng cáo</label>
            <select class="form-select @error('isBanner') is-invalid @enderror" id="isBanner" name="isBanner" required>
                <option value="1" {{ old('isBanner') == 1 ? 'selected' : '' }}>Có</option>
                <option value="0" {{ old('isBanner') == 0 ? 'selected' : '' }}>Không</option>
            </select>
            @error('isBanner')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Thêm mới</button>
    </form>
</div>
@endsection

