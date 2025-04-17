@extends('layouts.manage')

@section('content')
    <div class="main-content">
        <h1>Danh sách ứng viên đăng ký - {{ $studyAbroad->name }}</h1>

        <a href="{{ route('employer.study-abroads.index') }}" class="btn btn-secondary mb-3">← Quay lại danh sách</a>

        @if($candidates->isEmpty())
            <div class="alert alert-info">Chưa có ứng viên đăng ký tư vấn.</div>
        @else
            <table class="table table-bordered" id="user-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Họ tên</th>
                        <th>Số điện thoại</th>
                        <th>Địa chỉ</th>
                        <th>Ngày đăng ký</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($candidates as $key => $item)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->phone }}</td>
                            <td>{{ $item->address }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
