@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Danh sách khóa học đào tạo ngôn ngữ</h1>

        <table class="table" id="user-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tên khóa học</th>
                    <th>Nhà tuyển dụng</th>
                    <th>Ngày bắt đầu</th>
                    <th>Ngày kết thúc</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($languageTrainings as $languageTraining)
                    <tr>
                        <td>{{ $languageTraining->id }}</td>
                        <td>{{ $languageTraining->name }}</td>
                        <td>{{ $languageTraining->employer->email }}</td>
                        <td>{{ \Carbon\Carbon::parse($languageTraining->start_date)->format('d/m/Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($languageTraining->end_date)->format('d/m/Y') }}</td>
                        <td>
                            @if ($languageTraining->status)
                                <span class="badge badge-success">Đang hoạt động</span>
                            @else
                                <span class="badge badge-danger">Không hoạt động</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('language-training-manage.edit', $languageTraining->id) }}" class="btn btn-sm btn-warning">Sửa</a>
                            <form action="{{ route('language-training-manage.destroy', $languageTraining->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
