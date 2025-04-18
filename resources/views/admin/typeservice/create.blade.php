@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Thêm loại dịch vụ</h3>
    <form action="{{ route('typeservice.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Tên loại dịch vụ</label>
            <input type="text" name="name" class="form-control" required>
            @error('name') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="form-group">
            <label>Trạng thái</label>
            <select name="status" class="form-control" required>
                <option value="active">Hoạt động</option>
                <option value="inactive">Không hoạt động</option>
            </select>
            @error('status') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <button class="btn btn-success mt-2">Lưu</button>
    </form>
</div>
@endsection
