@extends('layouts.manage')
@section('content')


    <div class="main-content">

        <h1>Danh sách chương trình du học</h1>
        <a href="{{ route('employer.study-abroads.create') }}" class="btn btn-primary mb-3">Thêm mới</a>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table" id="user-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tên</th>
                    <th>Ảnh</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($studyAbroads as $studyAbroad)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $studyAbroad->name }}</td>
                        <td>
                            @if ($studyAbroad->image)
                                <img src="{{ asset('storage/' . $studyAbroad->image) }}" alt="Hình ảnh" width="80">
                            @else
                                Không có ảnh
                            @endif
                        </td>
                        <td>{{ $studyAbroad->status ? 'Hoạt động' : 'Ngừng hoạt động' }}</td>
                        <td>
                            <a href="{{ route('employer.study-abroads.edit', $studyAbroad->id) }}"
                                class="btn btn-warning">Sửa</a>
                          <a href="{{ route('employer.study-abroads.candidates', $studyAbroad->id) }}" class="btn btn-info">
    Ứng viên
    @if ($studyAbroad->candidates_today_count > 0)
        <span class="badge bg-danger ms-1">({{ $studyAbroad->candidates_today_count }})</span>
    @endif
</a>


                            <form action="{{ route('employer.study-abroads.destroy', $studyAbroad->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Bạn có chắc muốn xóa?')">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection
