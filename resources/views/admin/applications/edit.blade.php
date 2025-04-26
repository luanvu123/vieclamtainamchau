@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Phê duyệt đơn ứng tuyển của {{ $application->candidate->name ?? 'Ứng viên' }}</h3>

    <form action="{{ route('application-manage.update', $application->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="form-group mb-3">
        <label for="approve_application">Trạng thái duyệt:</label>
        <select name="approve_application" id="approve_application" class="form-control" required>
            <option value="Chờ duyệt" {{ $application->approve_application == 'Chờ duyệt' ? 'selected' : '' }}>Chờ duyệt</option>
            <option value="Đã duyệt" {{ $application->approve_application == 'Đã duyệt' ? 'selected' : '' }}>Đã duyệt</option>
            <option value="Nộp lại" {{ $application->approve_application == 'Nộp lại' ? 'selected' : '' }}>Nộp lại</option>
            <option value="Từ chối" {{ $application->approve_application == 'Từ chối' ? 'selected' : '' }}>Từ chối</option>
        </select>
    </div>
    <div class="form-group mb-3">
        <label for="summary">Tóm tắt thông tin ứng viên:</label>
        <textarea id="summary" name="summary" class="form-control" rows="4">{{ old('summary', $application->summary) }}</textarea>
    </div>

    <div class="form-group mb-3">
        <button type="submit" class="btn btn-primary">Cập nhật</button>
    </div>
</form>

</div>
@endsection
