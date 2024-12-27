@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Thêm Quốc gia mới</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('countries.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Tên Quốc gia:</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="Nhập tên quốc gia" required>
        </div>



        <div class="form-group">
            <label for="image">Hình ảnh:</label>
            <input type="file" name="image" id="image" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="status">Trạng thái:</label>
            <select name="status" id="status" class="form-control">
                <option value="active">Hoạt động</option>
                <option value="inactive">Không hoạt động</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Lưu</button>
        <a href="{{ route('countries.index') }}" class="btn btn-secondary">Hủy</a>
    </form>
</div>
@endsection
