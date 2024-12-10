@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Danh sách Quốc gia</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('countries.create') }}" class="btn btn-primary mb-3">Thêm Quốc gia mới</a>

    <table class="table table-bordered" id="user-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Tên Quốc gia</th>
                <th>Slug</th>
                <th>Hình ảnh</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($countries as $key => $country)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $country->name }}</td>
                    <td>{{ $country->slug }}</td>
                    <td>
                        <img src="{{ asset('storage/' . $country->image) }}" alt="{{ $country->name }}" width="50">
                    </td>
                    <td>{{ $country->status === 'active' ? 'Hoạt động' : 'Không hoạt động' }}</td>
                    <td>
                        <a href="{{ route('countries.edit', $country->id) }}" class="btn btn-sm btn-warning">Sửa</a>
                        <form action="{{ route('countries.destroy', $country->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc muốn xóa?')">Xóa</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Không có quốc gia nào.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
