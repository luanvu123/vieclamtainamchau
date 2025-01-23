@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $news->name }}</h1>
    <p><strong>Trạng thái:</strong> {{ $news->status ? 'Hoạt động' : 'Không hoạt động' }}</p>
    <p><strong>Nổi bật:</strong> {{ $news->isOutstanding ? 'Có' : 'Không' }}</p>
    <p><strong>Quảng cáo:</strong> {{ $news->isBanner ? 'Có' : 'Không' }}</p>
    <p><strong>Mô tả:</strong> {!! $news->description !!}</p>
    <p><strong>Website:</strong> <a href="{{ $news->website }}" target="_blank">{{ $news->website }}</a></p>
    @if ($news->image)
        <img src="{{ asset('storage/' . $news->image) }}" alt="{{ $news->name }}" class="img-thumbnail" style="max-width: 300px;">
    @endif
    <a href="{{ route('news.index') }}" class="btn btn-secondary mt-3">Quay lại</a>
</div>
@endsection
