@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Danh sách ứng viên</h1>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <table class="table table-bordered" id="user-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th></th>
                    <th>Tên</th>
                    <th>Email</th>
                    <th>Số điện thoại</th>
                    <th>Ngày tạo</th>
                    <th>Ngày cập nhật</th>
                    <th>Chức năng</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($candidates as $candidate)
                    <tr>
                        <td>{{ $candidate->id }}</td>
                        <td class="text-center">
                            <div class="avatar-container">
                                <img src="{{ asset('storage/avatars/' . $candidate->avatar_candidate) }}" alt="Logo"
                                    class="rounded-circle" style="width: 50px; height: 50px; object-fit: cover;">
                                <!-- Show "New" if the candidate was created within the last 2 hours -->
                                @if ($candidate->created_at >= \Carbon\Carbon::now()->subHours(2))
                                    <span class="new-badge">New</span>
                                @endif
                            </div>
                        </td>
                        <td>{{ $candidate->name }}</td>
                        <td>{{ $candidate->email }}</td>
                        <td>{{ $candidate->phone }}</td>
                        <td>{{ $candidate->created_at->format('d/m/Y H:i') }}</td> <!-- Hiển thị ngày tạo -->
                        <td>{{ $candidate->updated_at->format('d/m/Y H:i') }}</td> <!-- Hiển thị ngày cập nhật -->
                        <td>
                            <a href="{{ route('candidate-manage.edit', $candidate->id) }}"
                                class="btn btn-warning btn-sm">Chỉnh sửa</a>
                            <form action="{{ route('candidate-manage.destroy', $candidate->id) }}" method="POST"
                                style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

