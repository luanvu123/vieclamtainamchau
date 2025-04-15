@extends('layouts.manage')
@section('content')


        <div class="main-content">


  <h2>Thêm khóa đào tạo ngôn ngữ</h2>

    <form action="{{ route('employer.languagetrainings.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        @include('employer.languagetrainings.form')

        <button type="submit" class="btn btn-success">Lưu</button>
        <a href="{{ route('employer.languagetrainings.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>

        </div>

@endsection
