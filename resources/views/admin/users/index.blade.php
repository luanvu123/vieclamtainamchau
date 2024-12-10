@extends('layouts.app')

@section('content')
    <div class="containe-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="table-responsive">

                    <a href="{{ route('users.create') }}" class="button margin-top-30">Thêm tài khoản</a>
                    <!-- Table -->
                    <table id="user-table" class="display">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th><i class="fa fa-user"></i> Họ và tên</th>
                                <th><i class="fa fa-file-text"></i> Email</th>
                                <th><i class="fa fa-phone"></i> Số điện thoại</th>
                                <th><i class="fa fa-user-edit"></i> Phân quyền</th>
                                <th><i class="fa fa-calendar"></i> Ngày tạo</th>
                                <th><i class="fa fa-toggle-on"></i> Trạng thái</th>

                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $key => $user)
                                <tr>
                                    <td>{{ $key }}</td>
                                    <td class="title">{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->phone }}</td>
                                    <td>
                                        @if (!empty($user->getRoleNames()))
                                            @foreach ($user->getRoleNames() as $v)
                                                <label class="badge badge-success">{{ $v }}</label>
                                            @endforeach
                                        @endif
                                    </td>
                                    <td>{{ $user->created_at->format('M d, Y') }}</td>
                                    <td>
                                        <select id="{{ $user->id }}"class="user_choose">
                                            @if ($user->status == 0)
                                                <option value="1">Hoạt động</option>
                                                <option selected value="0">Ngừng hoạt động</option>
                                            @else
                                                <option selected value="1">Hoạt động</option>
                                                <option value="0">Ngừng hoạt động</option>
                                            @endif
                                        </select>
                                    </td>
                                    <td class="action">
                                        <a href="{{ route('users.edit', $user->id) }}"><i class="fa fa-pencil"></i>
                                            Edit</a>
                                        <a href="{{ route('users.show', $user->id) }}"><i class="fa fa-eye"></i>
                                            show</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>




                </div>
            </div>
        </div>
    </div>
@endsection
