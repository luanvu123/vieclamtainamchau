@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Chỉnh sửa Danh mục</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('genres.update', $genre->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Tên Danh mục:</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $genre->name) }}" required>
            @error('name') <p class="text-danger">{{ $message }}</p> @enderror
        </div>

        <div class="form-group">
            <label for="status">Trạng thái:</label>
            <select name="status" id="status" class="form-control">
                <option value="active" {{ old('status', $genre->status) === 'active' ? 'selected' : '' }}>Hoạt động</option>
                <option value="inactive" {{ old('status', $genre->status) === 'inactive' ? 'selected' : '' }}>Không hoạt động</option>
            </select>
            @error('status') <p class="text-danger">{{ $message }}</p> @enderror
        </div>

        <button type="submit" class="btn btn-primary">Cập nhật</button>
        <a href="{{ route('genres.index') }}" class="btn btn-secondary">Hủy</a>
    </form>
</div>
@endsection

