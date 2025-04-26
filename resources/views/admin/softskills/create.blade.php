@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Thêm kỹ năng mềm mới</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('soft-skills.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Tên kỹ năng mềm</label>
            <input type="text" name="name" id="name" class="form-control" required value="{{ old('name') }}">
        </div>

        <button type="submit" class="btn btn-success mt-3">Lưu</button>
        <a href="{{ route('soft-skills.index') }}" class="btn btn-secondary mt-3">Huỷ</a>
    </form>
</div>
@endsection
