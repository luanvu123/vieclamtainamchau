@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Chỉnh sửa dịch vụ</h1>
    <form action="{{ route('services.update', $service->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Tên dịch vụ</label>
            <input type="text" name="name" class="form-control" value="{{ $service->name }}" required>
        </div>
        <div class="form-group">
            <label for="image">Ảnh</label>
            @if ($service->image)
                <div>
                    <img src="{{ asset('storage/' . $service->image) }}" alt="Ảnh dịch vụ" width="100">
                </div>
            @endif
            <input type="file" name="image" class="form-control">
        </div>
        <div class="form-group">
            <label for="price">Giá</label>
            <input type="number" name="price" class="form-control" value="{{ $service->price }}" required>
        </div>
        <div class="form-group">
            <label for="description">Mô tả</label>
            <textarea name="description" class="form-control" required>{{ $service->description }}</textarea>
        </div>
        <div class="form-group">
    <label for="typeservice_id">Chọn loại:</label>
    <select name="typeservice_id" class="form-control" required>
        <option value="">-- Chọn thể loại --</option>
        @foreach ($typeservices as $type)
            <option value="{{ $type->id }}" {{ $service->typeservice_id == $type->id ? 'selected' : '' }}>
                {{ $type->name }}
            </option>
        @endforeach
    </select>
</div>

         <div class="form-group">
            <label>Chọn số tuần áp dụng:</label><br>
            @foreach([1, 2, 4] as $week)
                <div class="form-check form-check-inline">
                    <input type="checkbox" class="form-check-input" name="number_of_weeks[]" value="{{ $week }}"
                        {{ in_array($week, $service->weeks->pluck('number_of_weeks')->toArray()) ? 'checked' : '' }}>
                    <label class="form-check-label">{{ $week }} tuần</label>
                </div>
            @endforeach
        </div>
        <div class="form-group">
            <label for="status">Trạng thái</label>
            <select name="status" class="form-control" required>
                <option value="active" {{ $service->status == 'active' ? 'selected' : '' }}>Hoạt động</option>
                <option value="inactive" {{ $service->status == 'inactive' ? 'selected' : '' }}>Ngừng hoạt động</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Cập nhật</button>
    </form>
</div>
@endsection
