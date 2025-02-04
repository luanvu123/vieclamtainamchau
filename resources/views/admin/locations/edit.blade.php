@extends('layouts.app')

@section('content')
   <div class="container">
    <h1 class="mb-4">Chỉnh sửa Địa điểm</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('locations.update', $location->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Tên Địa điểm:</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $location->name }}" required>
        </div>

        <div class="form-group">
            <label for="description">Mô tả:</label>
            <textarea name="description" id="description" class="form-control">{{ $location->description }}</textarea>
        </div>

        <div class="form-group">
            <label for="status">Trạng thái:</label>
            <select name="status" id="status" class="form-control">
                <option value="active" {{ $location->status == 'active' ? 'selected' : '' }}>Hoạt động</option>
                <option value="inactive" {{ $location->status == 'inactive' ? 'selected' : '' }}>Không hoạt động</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Cập nhật</button>
        <a href="{{ route('locations.index') }}" class="btn btn-secondary">Hủy</a>
    </form>
</div>

@endsection
