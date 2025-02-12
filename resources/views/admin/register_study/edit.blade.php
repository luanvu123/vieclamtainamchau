@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Sửa thông tin đăng ký</h1>

    <form action="{{ route('register-study.update', $registerStudy->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="status">Trạng thái</label>
            <select id="status" name="status" class="form-control">
                <option value="pending" {{ $registerStudy->status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="completed" {{ $registerStudy->status == 'completed' ? 'selected' : '' }}>Completed</option>
            </select>
        </div>

        <div class="form-group">
            <label for="notes">Ghi chú</label>
            <textarea id="notes" name="notes" class="form-control">{{ $registerStudy->notes }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Cập nhật</button>
    </form>
</div>
@endsection
