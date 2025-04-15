@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Thêm loại đào tạo ngôn ngữ</h3>
    <form action="{{ route('typeLanguagetrainings.store') }}" method="POST">
        @csrf
        @include('admin.typeLanguagetrainings.form')
        <button type="submit" class="btn btn-primary">Lưu</button>
    </form>
</div>
@endsection
