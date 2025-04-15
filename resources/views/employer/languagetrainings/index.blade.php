@extends('layouts.manage')
@section('content')


        <div class="main-content">


 <h2>Danh sách khóa đào tạo ngôn ngữ</h2>

    <a href="{{ route('employer.languagetrainings.create') }}" class="btn btn-primary mb-3">Thêm mới</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Tên</th>
                <th>Loại</th>
                <th>Ngày bắt đầu</th>
                <th>Ngày kết thúc</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($languageTrainings as $training)
                <tr>
                    <td>{{ $training->name }}</td>
                    <td>{{ $training->typeLanguageTraining->name ?? '---' }}</td>
                    <td>{{ $training->start_date }}</td>
                    <td>{{ $training->end_date }}</td>
                    <td>{{ $training->status ? 'Hiển thị' : 'Ẩn' }}</td>
                    <td>
                        <a href="{{ route('employer.languagetrainings.edit', $training->id) }}" class="btn btn-sm btn-warning">Sửa</a>
                        <form action="{{ route('employer.languagetrainings.destroy', $training->id) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Bạn chắc chắn muốn xóa?')">Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

        </div>

@endsection
