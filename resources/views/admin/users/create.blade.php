@extends('layouts.app')

@section('content')
    <style>
        #dashboard .row {
            margin-bottom: 21px;
        }
    </style>

    <div id="titlebar">
        <div class="row">
            <div class="col-md-12">
                <h2>Tạo tài khoản quản trị </h2>
            </div>
        </div>
    </div>
    <div class="row">

        <div class="card">
            <div class="card-body p-4">
                <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3 row">
                        <label for="name" class="col-sm-3 col-form-label">Họ và Tên</label>
                        <div class="col-sm-9">
                            <div class="position-relative input-icon">
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Enter Your Name">

                            </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="email" class="col-sm-3 col-form-label">Email</label>
                        <div class="col-sm-9">
                            <div class="position-relative input-icon">
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="Enter Your Email">

                            </div>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="password" class="col-sm-3 col-form-label">Mật khẩu</label>
                        <div class="col-sm-9">
                            <div class="position-relative input-icon">
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="Enter Your Password">

                            </div>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="confirm-password" class="col-sm-3 col-form-label">Nhập lại mật khẩu</label>
                        <div class="col-sm-9">
                            <div class="position-relative input-icon">
                                <input type="password" class="form-control" id="confirm-password" name="confirm-password"
                                    placeholder="Confirm Your Password">

                            </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="roles" class="col-sm-3 col-form-label">Phân quyền</label>
                        <div class="col-sm-9">
                            <select class="form-select" id="roles" name="roles[]" multiple>
                                @foreach ($roles as $key => $role)
                                    <option value="{{ $key }}">{{ $role }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="gender" class="col-sm-3 col-form-label">Giới tính</label>
                        <div class="col-sm-9">
                            <select class="form-select" id="gender" name="gender">
                                <option value="Nam">Nam</option>
                                <option value="Nữ">Nữ</option>
                                <option value="Khác">Khác</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="avatar" class="col-sm-3 col-form-label">Ảnh đại diện</label>
                        <div class="col-sm-9">
                            <input type="file" class="form-control" id="avatar" name="avatar">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="favorite_color" class="col-sm-3 col-form-label">Màu yêu thích</label>
                        <div class="col-sm-9">
                            <input type="color" class="form-control" id="favorite_color" name="favorite_color">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="address" class="col-sm-3 col-form-label">Địa chỉ</label>
                        <div class="col-sm-9">
                            <div class="position-relative input-icon">
                                <input type="text" class="form-control" id="address" name="address"
                                    placeholder="Enter Your Address">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="address" class="col-sm-3 col-form-label">Ngày tháng năm sinh</label>
                        <div class="col-sm-9">
                            <div class="position-relative input-icon">
                                <input type="date" class="form-control" id="date" name="date"
                                    placeholder="Enter Your Address">
                            </div>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="language" class="col-sm-3 col-form-label">Ngôn ngữ </label>
                        <div class="col-sm-9">
                            <div class="position-relative input-icon">
                                <input type="text" class="form-control" id="language" name="language"
                                    placeholder="Enter Your Language">
                            </div>

                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="google" class="col-sm-3 col-form-label">Google</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="google" name="google">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="skype" class="col-sm-3 col-form-label">Skype</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="skype" name="skype">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="slack" class="col-sm-3 col-form-label">Slack</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="slack" name="slack">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="instagram" class="col-sm-3 col-form-label">Instagram</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="instagram" name="instagram">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="facebook" class="col-sm-3 col-form-label">Facebook</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="facebook" name="facebook">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="paypal" class="col-sm-3 col-form-label">Paypal</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="paypal" name="paypal">
                        </div>
                    </div>


                    <div class="mb-3 row">
                        <div class="col-sm-9 offset-sm-3">
                            <button type="submit" class="btn btn-primary px-4">Tạo</button>
                            <a href="{{ route('users.index') }}" class="btn btn-secondary">Quay lại</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection
