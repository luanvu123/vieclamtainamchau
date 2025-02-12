@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Thêm đăng ký du học</h1>

    <form action="{{ route('register-study.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="name">Tên</label>
            <input type="text" id="name" name="name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="phone">Số điện thoại</label>
            <input type="tel" id="phone" name="phone" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="address">Địa chỉ</label>
            <input type="text" id="address" name="address" class="form-control">
        </div>

        <div class="form-group">
            <label for="study_abroad_id">Chương trình</label>
            <select id="study_abroad_id" name="study_abroad_id" class="form-control" required>
                @foreach ($studyAbroads as $studyAbroad)
                    <option value="{{ $studyAbroad->id }}">{{ $studyAbroad->title }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="notes">Ghi chú</label>
            <textarea id="notes" name="notes" class="form-control"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Đăng ký</button>
    </form>
</div>
@endsection
