@extends('layouts.manage')
@section('content')

        <div class="main-content">


            <h2>Chỉnh sửa khóa đào tạo: {{ $languagetraining->name }}</h2>

            <form action="{{ route('employer.languagetrainings.update', $languagetraining->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                @include('employer.languagetrainings.form', ['languagetraining' => $languagetraining])

                <button type="submit" class="btn btn-success">Cập nhật</button>
                <a href="{{ route('employer.languagetrainings.index') }}" class="btn btn-secondary">Quay lại</a>
            </form>

        </div>

@endsection
