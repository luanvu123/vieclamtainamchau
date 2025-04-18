@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Sửa loại dịch vụ</h3>
    <form action="{{ route('typeservice.update', $typeservice->id) }}" method="POST">
        @csrf @method('PUT')
        <div class="form-group">
            <label>Tên loại dịch vụ</label>
            <input type="text" name="name" value="{{ $typeservice->name }}" class="form-control" required>
            @error('name') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="form-group">
            <label>Trạng thái</label>
            <select name="status" class="form-control" required>
                <option value="active" {{ $typeservice->status == 'active' ? 'selected' : '' }}>Hoạt động</option>
                <option value="inactive" {{ $typeservice->status == 'inactive' ? 'selected' : '' }}>Không hoạt động</option>
            </select>
            @error('status') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <button class="btn btn-primary mt-2">Cập nhật</button>
    </form>
</div>
@endsection
