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

       
         <h4 class="mt-4">Thông tin liên hệ cho Nhà tuyển dụng</h4>

    <div class="form-group">
        <label for="number_employer_1">Hotline cho Nhà tuyển dụng:</label>
        <input type="text" name="number_employer_1" id="number_employer_1" class="form-control" value="{{ $info->number_employer_1 ?? '' }}">
    </div>

    <div class="form-group">
        <label for="whatsapp">WhatsApp:</label>
        <input type="text" name="whatsapp" id="whatsapp" class="form-control" value="{{ $info->whatsapp ?? '' }}">
    </div>

    <div class="form-group">
        <label for="wechat">WeChat:</label>
        <input type="text" name="wechat" id="wechat" class="form-control" value="{{ $info->wechat ?? '' }}">
    </div>

    <div class="form-group">
        <label for="facebook">Facebook:</label>
        <input type="text" name="facebook" id="facebook" class="form-control" value="{{ $info->facebook ?? '' }}">
    </div>

    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" class="form-control" value="{{ $info->email ?? '' }}">
    </div>

    <div class="form-group">
        <label for="zalo">Zalo:</label>
        <input type="text" name="zalo" id="zalo" class="form-control" value="{{ $info->zalo ?? '' }}">
    </div>

    <h4 class="mt-4">Thông tin liên hệ cho Người tìm việc</h4>

    <div class="form-group">
        <label for="number_job_seeker_1">Hotline cho người tìm việc:</label>
        <input type="text" name="number_job_seeker_1" id="number_job_seeker_1" class="form-control" value="{{ $info->number_job_seeker_1 ?? '' }}">
    </div>

    <div class="form-group">
        <label for="facebook_candidate">Facebook cho người tìm việc:</label>
        <input type="text" name="facebook_candidate" id="facebook_candidate" class="form-control" value="{{ $info->facebook_candidate ?? '' }}">
    </div>

    <div class="form-group">
        <label for="email_candidate">Email cho người tìm việc:</label>
        <input type="email" name="email_candidate" id="email_candidate" class="form-control" value="{{ $info->email_candidate ?? '' }}">
    </div>

        <button type="submit" class="btn btn-success">Cập nhật</button>
        <a href="{{ route('home') }}" class="btn btn-secondary">Hủy</a>
    </form>
</div>
@endsection
