@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Chỉnh sửa thông tin ứng viên</h1>
    <form action="{{ route('candidate-manage.update', $candidate->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Tên</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $candidate->name) }}" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" class="form-control" value="{{ old('email', $candidate->email) }}" required>
        </div>
        <div class="form-group">
            <label for="phone">Số điện thoại</label>
            <input type="text" id="phone" name="phone" class="form-control" value="{{ old('phone', $candidate->phone) }}">
        </div>
        <button type="submit" class="btn btn-success">Cập nhật</button>
    </form>
</div>
@endsection
