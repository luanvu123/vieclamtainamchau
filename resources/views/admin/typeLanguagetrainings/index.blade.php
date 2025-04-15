@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Danh sách loại đào tạo ngôn ngữ</h3>
    <a href="{{ route('typeLanguagetrainings.create') }}" class="btn btn-primary mb-3">Thêm mới</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered" id="user-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Slug</th>
                <th>Tên</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($types as $type)
                <tr>
                    <td>{{ $type->id }}</td>
                    <td>{{ $type->slug }}</td>
                    <td>{{ $type->name }}</td>
                    <td>{{ $type->status ? 'Hiển thị' : 'Ẩn' }}</td>
                    <td>
                        <a href="{{ route('typeLanguagetrainings.edit', $type->id) }}" class="btn btn-sm btn-warning">Sửa</a>
                        <form action="{{ route('typeLanguagetrainings.destroy', $type->id) }}" method="POST" style="display:inline-block">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Xác nhận xoá?')">Xoá</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
