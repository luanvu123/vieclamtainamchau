@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Chỉnh sửa ngân hàng</h1>

    <form action="{{ route('banks.update', $bank->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="area">Khu vực:</label>
            <select name="area" id="area" class="form-control">
                <option value="Khu vực miền bắc" {{ $bank->area == 'Khu vực miền bắc' ? 'selected' : '' }}>Khu vực miền bắc</option>
                <option value="Khu vực miền nam" {{ $bank->area == 'Khu vực miền nam' ? 'selected' : '' }}>Khu vực miền nam</option>
            </select>
        </div>

        <div class="form-group">
            <label for="name">Tên ngân hàng:</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $bank->name }}" required>
        </div>

        <div class="form-group">
            <label for="branch">Chi nhánh:</label>
            <input type="text" name="branch" id="branch" class="form-control" value="{{ $bank->branch }}" required>
        </div>

        <div class="form-group">
            <label for="account_number">Số tài khoản:</label>
            <input type="text" name="account_number" id="account_number" class="form-control" value="{{ $bank->account_number }}" required>
        </div>

        <div class="form-group">
            <label for="content">Nội dung:</label>

               <textarea class="WYSIWYG" name="content" cols="80" rows="6" id="summary6" spellcheck="true">{!! $bank->content !!}</textarea>
        </div>

        <div class="form-group">
            <label for="image">Ảnh hiện tại:</label><br>
            @if ($bank->image)
                <img src="{{ asset('storage/' . $bank->image) }}" alt="Bank Image" width="100"><br>
            @endif
            <label for="image">Cập nhật ảnh:</label>
            <input type="file" name="image" id="image" class="form-control">
        </div>

        <div class="form-group">
            <label for="logo_bank">Logo hiện tại:</label><br>
            @if ($bank->logo_bank)
                <img src="{{ asset('storage/' . $bank->logo_bank) }}" alt="Bank Logo" width="100"><br>
            @endif
            <label for="logo_bank">Cập nhật logo:</label>
            <input type="file" name="logo_bank" id="logo_bank" class="form-control">
        </div>

        <div class="form-group">
            <label for="status">Trạng thái:</label>
            <select name="status" id="status" class="form-control">
                <option value="1" {{ $bank->status == 1 ? 'selected' : '' }}>Hoạt động</option>
                <option value="0" {{ $bank->status == 0 ? 'selected' : '' }}>Ngừng hoạt động</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Cập nhật</button>
    </form>
</div>
@endsection
