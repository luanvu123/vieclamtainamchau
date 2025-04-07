@extends('layouts.app')

@section('content')
    <div id="titlebar">
        <div class="row">
            <div class="col-md-12">
                <h2><i class="fas fa-user-edit"></i> Edit User</h2>

                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong><i class="fas fa-exclamation-triangle"></i> Whoops!</strong> There were some problems with your
                        input.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong><i class="fas fa-user"></i> Họ và tên:</strong>
                            <input type="text" name="name" value="{{ $user->name }}" class="form-control"
                                placeholder="Name">
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong><i class="fas fa-envelope"></i> Email:</strong>
                            <input type="email" name="email" value="{{ $user->email }}" class="form-control"
                                placeholder="Email">
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong><i class="fas fa-lock"></i> Mật khẩu:</strong>
                            <input type="password" name="password" class="form-control" placeholder="Password">
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong><i class="fas fa-lock"></i> Nhập lại mật khẩu:</strong>
                            <input type="password" name="confirm-password" class="form-control"
                                placeholder="Confirm Password">
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong><i class="fas fa-circle"></i> Trạng thái:</strong>
                            <select name="status" class="form-control">
                                <option value="active" {{ $user->status == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ $user->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-xs-2 col-sm-2 col-md-2">
                        <div class="form-group">
                            <strong><i class="fas fa-venus-mars"></i> Giới tính:</strong>
                            <select name="gender" class="form-control">
                                <option value="">Chọn giới tính</option>
                                <option value="Nam" {{ $user->gender == 'Nam' ? 'selected' : '' }}>Nam</option>
                                <option value="Nữ" {{ $user->gender == 'Nữ' ? 'selected' : '' }}>Nữ</option>
                                <option value="Khác" {{ $user->gender == 'Khác' ? 'selected' : '' }}>Khác</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong><i class="fas fa-map-marker-alt"></i> Địa chỉ:</strong>
                            <input type="text" name="address" value="{{ $user->address }}" class="form-control"
                                placeholder="Address">
                        </div>
                    </div>

                    <div class="col-xs-2 col-sm-2 col-md-2">
                        <div class="form-group">
                            <strong><i class="fas fa-palette"></i> Màu yêu thích:</strong>
                            <input type="color" name="favorite_color" value="{{ $user->favorite_color }}"
                                class="form-control">
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong><i class="fas fa-image"></i> Ảnh đại diện:</strong>
                            @if ($user->avatar)
                                <img src="{{ asset('storage/' . $user->avatar) }}" alt="Avatar" style="max-width: 100px;">
                            @endif
                            <input type="file" name="avatar" class="form-control">
                        </div>
                    </div>

                    <div class="col-xs-2 col-sm-2 col-md-2">
                        <div class="form-group">
                            <strong><i class="fas fa-calendar"></i> Ngày sinh:</strong>
                            <input type="date" name="date" value="{{ $user->date }}" class="form-control">
                        </div>
                    </div>

                    <div class="col-xs-2 col-sm-2 col-md-2">
                        <div class="form-group">
                            <strong><i class="fas fa-phone"></i> Số điện thoại:</strong>
                            <input type="text" name="phone" value="{{ $user->phone }}" class="form-control"
                                placeholder="Phone">
                        </div>
                    </div>

                    <div class="col-xs-2 col-sm-2 col-md-2">
                        <div class="form-group">
                            <strong><i class="fas fa-language"></i> Ngôn ngữ:</strong>
                            <input type="text" name="language" value="{{ $user->language }}" class="form-control"
                                placeholder="Language">
                        </div>
                    </div>

                    <div class="col-xs-2 col-sm-2 col-md-2">
                        <div class="form-group">
                            <strong><i class="fab fa-google"></i> Google:</strong>
                            <input type="text" name="google" value="{{ $user->google }}" class="form-control"
                                placeholder="Google">
                        </div>
                    </div>

                    <div class="col-xs-2 col-sm-2 col-md-2">
                        <div class="form-group">
                            <strong><i class="fab fa-skype"></i> Skype:</strong>
                            <input type="text" name="skype" value="{{ $user->skype }}" class="form-control"
                                placeholder="Skype">
                        </div>
                    </div>

                    <div class="col-xs-2 col-sm-2 col-md-2">
                        <div class="form-group">
                            <strong><i class="fab fa-slack"></i> Slack:</strong>
                            <input type="text" name="slack" value="{{ $user->slack }}" class="form-control"
                                placeholder="Slack">
                        </div>
                    </div>

                    <div class="col-xs-2 col-sm-2 col-md-2">
                        <div class="form-group">
                            <strong><i class="fab fa-instagram"></i> Instagram:</strong>
                            <input type="text" name="instagram" value="{{ $user->instagram }}" class="form-control"
                                placeholder="Instagram">
                        </div>
                    </div>

                    <div class="col-xs-2 col-sm-2 col-md-2">
                        <div class="form-group">
                            <strong><i class="fab fa-facebook"></i> Facebook:</strong>
                            <input type="text" name="facebook" value="{{ $user->facebook }}" class="form-control"
                                placeholder="Facebook">
                        </div>
                    </div>

                    <div class="col-xs-2 col-sm-2 col-md-2">
                        <div class="form-group">
                            <strong><i class="fab fa-paypal"></i> PayPal:</strong>
                            <input type="text" name="paypal" value="{{ $user->paypal }}" class="form-control"
                                placeholder="PayPal">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong><i class="fas fa-user-tag"></i> Role:</strong>
                            <select name="roles[]" class="form-control" multiple>
                                @foreach($roles as $key => $value)
                                    <option value="{{ $key }}" {{ in_array($key, $userRole) ? 'selected' : '' }}>
                                        {{ $value }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Lưu
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
