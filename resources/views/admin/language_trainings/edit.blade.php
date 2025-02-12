@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Chỉnh sửa chương trình đào tạo ngôn ngữ</h1>
    <form action="{{ route('language-trainings.update', $languageTraining->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Tên</label>
            <input type="text" name="name" class="form-control" value="{{ $languageTraining->name }}" required>
        </div>

        <div class="form-group">
            <label for="description">Mô tả</label>
            <textarea name="description" class="form-control">{{ $languageTraining->description }}</textarea>
        </div>

        <div class="form-group">
            <label for="status">Trạng thái</label>
            <select name="status" class="form-control">
                <option value="1" {{ $languageTraining->status ? 'selected' : '' }}>Hoạt động</option>
                <option value="0" {{ !$languageTraining->status ? 'selected' : '' }}>Ngừng hoạt động</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Cập nhật</button>
    </form>
</div>
@endsection
