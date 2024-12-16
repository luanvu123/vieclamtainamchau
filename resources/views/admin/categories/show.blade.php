<?php
?>
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Chi tiết danh mục</h1>
    <div class="card">
        <div class="card-header">{{ $category->name }}</div>
        <div class="card-body">
            @if ($category->image)
                <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" class="img-fluid mb-3">
            @else
                <p>Không có hình ảnh</p>
            @endif
            <p><strong>Trạng thái:</strong> {{ $category->status == 1 ? 'Hoạt động' : 'Không hoạt động' }}</p>
            <p><strong>Slug:</strong> {{ $category->slug }}</p>
        </div>
    </div>
    <a href="{{ route('categories.index') }}" class="btn btn-primary mt-3">Quay lại danh sách</a>
</div>
@endsection
