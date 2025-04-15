@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Cập nhật loại đào tạo ngôn ngữ</h3>
    <form action="{{ route('typeLanguagetrainings.update', $typeLanguagetraining->id) }}" method="POST">
        @csrf @method('PUT')
        @include('admin.typeLanguagetrainings.form')
        <button type="submit" class="btn btn-success">Cập nhật</button>
    </form>
</div>
@endsection
