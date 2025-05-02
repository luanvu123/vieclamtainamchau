@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Chỉnh sửa Thông Tin Website</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('info.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="logo">Logo:</label>
            <input type="file" name="logo" id="logo" class="form-control">
            @if ($info->logo)
                <img src="{{ asset('storage/' . $info->logo) }}" alt="Logo" width="100" class="mt-2">
            @endif
        </div>

        <div class="form-group">
            <label for="title">Tiêu đề:</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ $info->title ?? '' }}" required>
        </div>

        <div class="form-group">
            <label for="subtitle">Phụ đề:</label>
            <input type="text" name="subtitle" id="subtitle" class="form-control" value="{{ $info->subtitle ?? '' }}">
        </div>

        <div class="form-group">
            <label for="phone">Số điện thoại:</label>
            <input type="text" name="phone" id="phone" class="form-control" value="{{ $info->phone ?? '' }}" required>
        </div>

        <div class="form-group">
            <label for="gmail">Email:</label>
            <input type="email" name="gmail" id="gmail" class="form-control" value="{{ $info->gmail ?? '' }}" required>
        </div>

        <div class="form-group">
            <label for="copyright">Bản quyền:</label>
            <input type="text" name="copyright" id="copyright" class="form-control" value="{{ $info->copyright ?? '' }}">
        </div>

        <div class="form-group">
            <label for="newspaper">Báo chí:</label>
            <input type="text" name="newspaper" id="newspaper" class="form-control" value="{{ $info->newspaper ?? '' }}">
        </div>

        <div class="form-group">
            <label for="footer_company">Công ty ở footer:</label>
             <textarea name="footer_company" id="description" class="form-control">{{ $info->footer_company}}</textarea>
        </div>

        <div class="form-group">
            <label for="url_facebook">Facebook:</label>
            <input type="text" name="url_facebook" id="url_facebook" class="form-control" value="{{ $info->url_facebook ?? '' }}">
        </div>

        <div class="form-group">
            <label for="url_youtube">YouTube:</label>
            <input type="text" name="url_youtube" id="url_youtube" class="form-control" value="{{ $info->url_youtube ?? '' }}">
        </div>

        <div class="form-group">
            <label for="url_partner">Đối tác:</label>
            <input type="text" name="url_partner" id="url_partner" class="form-control" value="{{ $info->url_partner ?? '' }}">
        </div>
        <button type="submit" class="btn btn-success">Cập nhật</button>
        <a href="{{ route('home') }}" class="btn btn-secondary">Hủy</a>
    </form>
</div>
@endsection
