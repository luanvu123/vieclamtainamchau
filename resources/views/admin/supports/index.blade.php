@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Danh sách tư vấn</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table" id="user-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Số điện thoại</th>
                    <th>Email</th>
                    <th>Loại</th>
                    <th>Mô tả</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($supports as $support)
                    <tr>
                        <td>{{ $support->id }}</td>
                        <td>{{ $support->phone }}
                            @if ($support->created_at >= \Carbon\Carbon::now()->subHours(2))
                                <span class="badge badge-danger">New</span>
                            @endif
                        </td>
                        <td>{{ $support->email }}</td>
                        <td>{{ $support->type_title }}</td>
                        <td>{{ $support->description_info }}</td>
                        <td>{{ $support->status }}</td>
                        <td>
                            <a href="{{ route('support-manage.edit', $support->id) }}" class="btn btn-warning">Sửa</a>
                            <form action="{{ route('support-manage.destroy', $support->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
