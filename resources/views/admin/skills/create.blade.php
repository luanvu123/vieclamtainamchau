@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Thêm kỹ năng</h2>
    <form action="{{ route('skills.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Tên kỹ năng:</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <button class="btn btn-success">Lưu</button>
    </form>
</div>
@endsection
