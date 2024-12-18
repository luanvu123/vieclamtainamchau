@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Thêm thể loại mới</h1>
    <form action="{{ route('genres.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Tên thể loại</label>
            <input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}" required>
            @error('name')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Trạng thái</label>
            <select name="status" class="form-select" id="status" required>
                <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
            @error('status')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <button type="submit" class="btn btn-success">Thêm</button>
    </form>
</div>
@endsection

