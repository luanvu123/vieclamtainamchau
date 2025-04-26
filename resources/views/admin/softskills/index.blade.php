@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Danh sách kỹ năng mềm</h1>
        <a href="{{ route('soft-skills.create') }}" class="btn btn-primary mb-3">Thêm kỹ năng mềm</a>

        <table class="table table-bordered" id="user-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tên</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($softSkills as $key => $skill)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $skill->name }}</td>
                        <td>
                            <a href="{{ route('soft-skills.edit', $skill->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                            <form action="{{ route('soft-skills.destroy', $skill->id) }}" method="POST"
                                style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Xác nhận xoá?')"
                                    class="btn btn-danger btn-sm">Xoá</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
