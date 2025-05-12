@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Thông tin liên hệ </h1>

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
            <h4 class="mt-4">Thông tin liên hệ cho Nhà tuyển dụng</h4>

            <div class="form-group">
                <label for="number_employer_1">Hotline cho Nhà tuyển dụng:</label>
                <input type="text" name="number_employer_1" id="number_employer_1" class="form-control"
                    value="{{ $info->number_employer_1 ?? '' }}">
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



            <h4 class="mt-4">Thông tin liên hệ cho Người tìm việc</h4>

            <div class="form-group">
                <label for="number_job_seeker_1">Hotline cho người tìm việc:</label>
                <input type="text" name="number_job_seeker_1" id="number_job_seeker_1" class="form-control"
                    value="{{ $info->number_job_seeker_1 ?? '' }}">
            </div>

            <div class="form-group">
                <label for="facebook_candidate">Facebook cho người tìm việc:</label>
                <input type="text" name="facebook_candidate" id="facebook_candidate" class="form-control"
                    value="{{ $info->facebook_candidate ?? '' }}">
            </div>

            <div class="form-group">
                <label for="email_candidate">Email cho người tìm việc:</label>
                <input type="email" name="email_candidate" id="email_candidate" class="form-control"
                    value="{{ $info->email_candidate ?? '' }}">
            </div>
   <div class="form-group">
                <label for="zalo">Zalo:</label>
                <input type="text" name="zalo" id="zalo" class="form-control" value="{{ $info->zalo ?? '' }}">
            </div>
            <button type="submit" class="btn btn-success">Cập nhật</button>
            <a href="{{ route('home') }}" class="btn btn-secondary">Hủy</a>
        </form>
    </div>
@endsection
