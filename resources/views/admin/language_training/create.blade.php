@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Tạo mới khóa học đào tạo ngôn ngữ</h1>

        <form action="{{ route('language-training-manage.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="employer_id">Nhà tuyển dụng</label>
                <select name="employer_id" class="form-control" required>
                    <option value="">Chọn nhà tuyển dụng</option>
                    @foreach ($employers as $employer)
                        <option value="{{ $employer->id }}">{{ $employer->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="type_language_training_id">Loại đào tạo</label>
                <select name="type_language_training_id" class="form-control" required>
                    <option value="">Chọn loại đào tạo</option>
                    @foreach ($types as $type)
                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="name">Tên khóa học</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="start_date">Ngày bắt đầu</label>
                <input type="date" name="start_date" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="end_date">Ngày kết thúc</label>
                <input type="date" name="end_date" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="description">Mô tả</label>
                <textarea name="description" class="form-control"></textarea>
            </div>

            <div class="form-group">
                <label for="image">Hình ảnh</label>
                <input type="file" name="image" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Lưu</button>
        </form>
    </div>
@endsection
