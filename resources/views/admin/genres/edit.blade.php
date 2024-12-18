@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Sửa Danh mục</h1>
    <form action="{{ route('genres.update', $genre->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name">Tên:</label>
            <input type="text" name="name" id="name" value="{{ $genre->name }}">
            @error('name') <p>{{ $message }}</p> @enderror
        </div>
        <div class="mb-3">
            <label for="status">Trạng thái:</label>
            <select name="status" id="status">
                <option value="active" {{ $genre->status === 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ $genre->status === 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
            @error('status') <p>{{ $message }}</p> @enderror
        </div>
        <button type="submit">Cập nhật</button>
    </form>
</div>
@endsection
