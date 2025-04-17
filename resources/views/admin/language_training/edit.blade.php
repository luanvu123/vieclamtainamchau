@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Chỉnh sửa khóa học đào tạo ngôn ngữ</h1>

        <form action="{{ route('language-training-manage.update', $languageTraining->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="employer_id">Nhà tuyển dụng</label>
                <select name="employer_id" class="form-control" required>
                    <option value="">Chọn nhà tuyển dụng</option>
                    @foreach ($employers as $employer)
                        <option value="{{ $employer->id }}" {{ $languageTraining->employer_id == $employer->id ? 'selected' : '' }}>{{ $employer->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="type_language_training_id">Loại đào tạo</label>
                <select name="type_language_training_id" class="form-control" required>
                    <option value="">Chọn loại đào tạo</option>
                    @foreach ($types as $type)
                        <option value="{{ $type->id }}" {{ $languageTraining->type_language_training_id == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="name">Tên khóa học</label>
                <input type="text" name="name" class="form-control" value="{{ $languageTraining->name }}" required>
            </div>

            <div class="form-group">
                <label for="start_date">Ngày bắt đầu</label>
                <input type="date" name="start_date" class="form-control" value="{{ $languageTraining->start_date }}" required>
            </div>

            <div class="form-group">
                <label for="end_date">Ngày kết thúc</label>
                <input type="date" name="end_date" class="form-control" value="{{ $languageTraining->end_date }}" required>
            </div>

            <div class="form-group">
                <label for="description">Mô tả</label>
                <textarea name="description" class="form-control">{{ $languageTraining->description }}</textarea>
            </div>

            <div class="form-group">
                <label for="image">Hình ảnh</label>
                <input type="file" name="image" class="form-control">
                @if ($languageTraining->image)
                    <img src="{{ asset('storage/' . $languageTraining->image) }}" alt="Image" class="mt-2" width="100">
                @endif
            </div>

            <button type="submit" class="btn btn-primary">Cập nhật</button>
        </form>
    </div>
@endsection
