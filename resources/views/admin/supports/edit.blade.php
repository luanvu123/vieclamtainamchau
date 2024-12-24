@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Sửa thông tin tư vấn</h1>

    <form action="{{ route('support-manage.update', $support->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="phone">Số điện thoại</label>
            <input type="tel" id="phone" name="phone" class="form-control" value="{{ $support->phone }}" readonly>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" class="form-control" value="{{ $support->email }}" readonly>
        </div>

        <div class="form-group">
            <label for="description_info">Mô tả</label>
            <textarea id="description_info" name="description_info" class="form-control" readonly>{{ $support->description_info }}</textarea>
        </div>

        <div class="form-group">
            <label for="status">Trạng thái</label>
            <select id="status" name="status" class="form-control" required>
                <option value="pending" {{ $support->status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="completed" {{ $support->status == 'completed' ? 'selected' : '' }}>Completed</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Cập nhật</button>
    </form>
</div>
@endsection
