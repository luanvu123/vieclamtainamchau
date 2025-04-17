@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Chi tiết tin tức</h2>

    <div class="mb-3">
        <strong>Tên:</strong> {{ $news->name }}
    </div>

    @if($news->image)
        <div class="mb-3">
            <strong>Ảnh:</strong><br>
            <img src="{{ asset('storage/' . $news->image) }}" width="300">
        </div>
    @endif

    <div class="mb-3">
        <strong>Website:</strong> <a href="{{ $news->website }}" target="_blank">{{ $news->website }}</a>
    </div>

    <div class="mb-3">
        <strong>Mô tả:</strong><br>
        <p>{{ $news->description }}</p>
    </div>

    <div class="mb-3">
        <strong>Trạng thái:</strong> {{ $news->status }}
    </div>

    <a href="{{ route('news-manage.index') }}" class="btn btn-secondary">Quay lại</a>
</div>
@endsection
