@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Cập nhật đối tác</h2>
    <form action="{{ route('company-partners.update', $companyPartner) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name">Tên đối tác</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $companyPartner->name) }}" required>
        </div>
        <div class="mb-3">
            <label for="image">Ảnh</label>
            <input type="file" name="image" class="form-control">
            @if($companyPartner->image)
                <div class="mt-2">
                    <img src="{{ asset('storage/' . $companyPartner->image) }}" width="100">
                </div>
            @endif
        </div>
        <div class="mb-3">
            <label for="status">Trạng thái</label>
            <select name="status" class="form-control">
                <option value="1" {{ $companyPartner->status ? 'selected' : '' }}>Hiện</option>
                <option value="0" {{ !$companyPartner->status ? 'selected' : '' }}>Ẩn</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Cập nhật</button>
    </form>
</div>
@endsection
