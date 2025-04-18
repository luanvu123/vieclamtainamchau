@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Danh sách loại dịch vụ</h3>
    <a href="{{ route('typeservice.create') }}" class="btn btn-primary mb-3">Thêm loại dịch vụ</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered" id="user-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Tên</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($typeservices as $key=> $type)
                <tr>
                    <td>{{$key}}</td>
                    <td>{{ $type->name }}</td>
                    <td>{{ $type->status }}</td>
                    <td>
                        <a href="{{ route('typeservice.edit', $type->id) }}" class="btn btn-sm btn-warning">Sửa</a>
                        <form action="{{ route('typeservice.destroy', $type->id) }}" method="POST"
                            style="display:inline-block" onsubmit="return confirm('Bạn có chắc muốn xóa?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger">Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
