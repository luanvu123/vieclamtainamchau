@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Cập nhật kỹ năng</h2>
    <form action="{{ route('skills.update', $skill->id) }}" method="POST">
        @csrf @method('PUT')
        <div class="form-group">
            <label for="name">Tên kỹ năng:</label>
            <input type="text" name="name" class="form-control" value="{{ $skill->name }}" required>
        </div>
        <button class="btn btn-primary">Cập nhật</button>
    </form>
</div>
@endsection
