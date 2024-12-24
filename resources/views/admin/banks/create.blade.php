@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Thêm ngân hàng</h1>
    <form action="{{ route('banks.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="area">Khu vực:</label>
            <select name="area" id="area" class="form-control">
                <option value="Khu vực miền bắc">Khu vực miền bắc</option>
                <option value="Khu vực miền nam">Khu vực miền nam</option>
            </select>
        </div>
        <div class="form-group">
            <label for="name">Tên ngân hàng:</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="branch">Chi nhánh:</label>
            <input type="text" name="branch" id="branch" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="account_number">Số tài khoản:</label>
            <input type="text" name="account_number" id="account_number" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="content">Nội dung:</label>
              <textarea class="WYSIWYG" name="content" cols="80" rows="6" id="summary6" spellcheck="true"></textarea>
        </div>
        <div class="form-group">
            <label for="image">Ảnh:</label>
            <input type="file" name="image" id="image" class="form-control">
        </div>
        <div class="form-group">
            <label for="logo_bank">Logo ngân hàng:</label>
            <input type="file" name="logo_bank" id="logo_bank" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Lưu</button>
    </form>
</div>
@endsection
