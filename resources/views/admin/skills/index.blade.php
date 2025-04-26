@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Danh sách kỹ năng</h2>
        <a href="{{ route('skills.create') }}" class="btn btn-primary">Thêm kỹ năng</a>
        <br><br>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <table class="table" id="user-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tên kỹ năng</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($skills as $key => $skill)
                    <tr>
                        <td>{{$key}}</td>
                        <td>{{ $skill->name }}</td>
                        <td>
                            <a href="{{ route('skills.edit', $skill->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                            <form action="{{ route('skills.destroy', $skill->id) }}" method="POST" style="display:inline;">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Xóa kỹ năng này?')">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
