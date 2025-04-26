@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Danh sách dịch vụ</h1>
    <a href="{{ route('services.create') }}" class="btn btn-primary">Tạo mới dịch vụ</a>
    <table class="table mt-3" id="user-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên dịch vụ</th>
                <th>Ảnh</th>
                <th>Giá</th>
                <th>Mô tả</th>
                <th>Trạng thái</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($services as $service)
                <tr>
                    <td>{{ $service->id }}</td>
                    <td>{{ $service->name }}</td>
                    <td>
                        @if ($service->image)
                            <img src="{{ asset('storage/' . $service->image) }}" alt="Ảnh dịch vụ" width="50">
                        @endif
                    </td>
                  <td>{{ number_format($service->price, 0, ',', '.') }} VNĐ</td>

                    <td>{!! $service->description !!}</td>
                    <td>{{ $service->status == 'active' ? 'Hoạt động' : 'Ngừng hoạt động' }}</td>
                    <td>
                        <a href="{{ route('services.edit', $service->id) }}" class="btn btn-warning">Chỉnh sửa</a>
                        <form action="{{ route('services.destroy', $service->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

