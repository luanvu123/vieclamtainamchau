@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Thêm ngân hàng</h1>
        <form action="{{ route('banks.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="name">Tên ngân hàng:</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="account_name">Chủ tài khoản:</label>
                <input type="text" name="account_name" id="account_name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="swift_code">Mã SWIFT:</label>
                <input type="text" name="swift_code" id="swift_code" class="form-control">
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
                <label for="image">QR code:</label>
                <input type="file" name="image" id="image" class="form-control">
            </div>
           
            <button type="submit" class="btn btn-primary">Lưu</button>
        </form>
    </div>
@endsection
