@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Danh sách đăng ký du học</h1>

    <a href="{{ route('register-study.create') }}" class="btn btn-primary mb-3">Thêm đăng ký</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table" id="user-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Tên</th>
                <th>Điện thoại</th>
                <th>Địa chỉ</th>
                <th>Chương trình</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($registerStudies as $registerStudy)
            <tr>
                <td>{{ $registerStudy->id }}</td>
                <td>{{ $registerStudy->name }}</td>
                <td>{{ $registerStudy->phone }}</td>
                <td>{{ $registerStudy->address }}</td>
                <td>{{ $registerStudy->studyAbroad->name ?? 'N/A' }}</td>
                <td>{{ ucfirst($registerStudy->status) }}</td>
                <td>
                    <a href="{{ route('register-study.edit', $registerStudy->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                    <form action="{{ route('register-study.destroy', $registerStudy->id) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Xóa đăng ký này?')">Xóa</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endsection
