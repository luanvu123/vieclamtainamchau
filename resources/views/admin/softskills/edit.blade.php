@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Chỉnh sửa kỹ năng mềm</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('soft-skills.update', $softSkill->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Tên kỹ năng mềm</label>
            <input type="text" name="name" id="name" class="form-control" required value="{{ old('name', $softSkill->name) }}">
        </div>

        <button type="submit" class="btn btn-primary mt-3">Cập nhật</button>
        <a href="{{ route('soft-skills.index') }}" class="btn btn-secondary mt-3">Huỷ</a>
    </form>
</div>
@endsection
