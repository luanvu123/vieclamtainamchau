@extends('layouts.app')

@section('content')


    <!-- Titlebar -->
    <div id="titlebar">
        <div class="row">
            <div class="col-md-12">
                <h2>My Profile</h2>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-6">
            <div class="message-avatar">

                @if ($user->avatar)
                    <img src="{{ asset('storage/' . $user->avatar) }}">
                @else
                    <img src="http://www.gravatar.com/avatar/00000000000000000000000000000000?d=mm&amp;s=300" alt="">
                @endif
            </div>
            <h5>Họ và tên: {{ $user->name }}</h5>
            <p>Email: {{ $user->email }}</p>
            <p>Giới tính: {{ $user->gender }}</p>
            <p>Địa chỉ: {{ $user->address }}</p>
            <p>Số điện thoại: {{ $user->phone }}</p>
            <p>Ngày sinh: {{ $user->date }}</p>
            <p>Ngôn ngữ: {{ $user->language }}</p>

            <p class="mb-0">Role: @if (!empty($user->getRoleNames()))
                    @foreach ($user->getRoleNames() as $v)
                        <span class="badge badge-success">{{ $v }}</span>
                    @endforeach
                @endif
            </p>

            <p>Status: {{ $user->status == 1 ? 'Active' : 'Inactive' }}</p>
        </div>
        <div class="col-md-6">
            <!-- Add additional fields as needed -->
            <p>Google: {{ $user->google }}</p>
            <p>Skype: {{ $user->skype }}</p>
            <p>Slack: {{ $user->slack }}</p>
            <p>Instagram: {{ $user->instagram }}</p>
            <p>Facebook: {{ $user->facebook }}</p>
            <p>Paypal: {{ $user->paypal }}</p>
        </div>
    </div>
@endsection
