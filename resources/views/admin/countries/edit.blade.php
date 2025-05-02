@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Chỉnh sửa Quốc gia</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('countries.update', $country->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Tên Quốc gia:</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $country->name }}" required>
            </div>


            <div class="form-group">
                <label for="image">Hình ảnh:</label>
                <input type="file" name="image" id="image" class="form-control">
                <img src="{{ asset('storage/' . $country->image) }}" alt="{{ $country->name }}" width="100" class="mt-2">
            </div>

            <div class="form-group">
                <label for="status">Trạng thái:</label>
                <select name="status" id="status" class="form-control">
                    <option value="active" {{ $country->status === 'active' ? 'selected' : '' }}>Hoạt động</option>
                    <option value="inactive" {{ $country->status === 'inactive' ? 'selected' : '' }}>Không hoạt động</option>
                </select>
            </div>
            <div class="form-group">
                <label for="hot">Từ khóa nổi bật?</label>
                <select name="hot" id="hot" class="form-control">
                    <option value="1" {{ $country->hot ? 'selected' : '' }}>Có</option>
                    <option value="0" {{ !$country->hot ? 'selected' : '' }}>Không</option>
                </select>
            </div>


            <button type="submit" class="btn btn-success">Cập nhật</button>
            <a href="{{ route('countries.index') }}" class="btn btn-secondary">Hủy</a>
        </form>
    </div>
@endsection
