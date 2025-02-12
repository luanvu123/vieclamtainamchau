@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Danh sách chương trình đào tạo ngôn ngữ</h1>
    <a href="{{ route('language-trainings.create') }}" class="btn btn-primary mb-3">Thêm mới</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered" id="user-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($languageTrainings as $training)
                <tr>
                    <td>{{ $training->id }}</td>
                    <td>{{ $training->name }}</td>
                    <td>{{ $training->status ? 'Hoạt động' : 'Ngừng hoạt động' }}</td>
                    <td>
                        <a href="{{ route('language-trainings.edit', $training->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                        <form action="{{ route('language-trainings.destroy', $training->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
