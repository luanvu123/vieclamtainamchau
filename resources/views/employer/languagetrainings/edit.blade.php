@extends('layout')
@section('content')
    <section class="hotlines-section">
        <div class="sidebar">
            <div class="menu-section">
                <div class="menu-title">Quản lý đăng tuyển dụng</div>
                <a href="{{ route('employer.job-posting.create') }}" class="menu-item">
                    <i>+</i>
                    <span>Tạo tin tuyển dụng</span>
                </a>
                <a href="{{ route('employer.job-posting.index') }}" class="menu-item">
                    <i>📋</i>
                    <span>Quản lý tin đăng</span>
                </a>
                <a href="{{ route('employer.services') }}" class="menu-item">
                    <i>📊</i>
                    <span>Mua dịch vụ</span>
                </a>
                <a href="{{ route('employer.service-active') }}" class="menu-item">
                    <i>❤️</i>
                    <span>Dịch vụ đã mua</span>
                </a>
                <a href="{{ route('employer.orders.index') }}" class="menu-item">
                    <i>🧾</i>
                    <span>Lịch sử đơn hàng</span>
                </a>
            </div>

            <div class="menu-section">
                <div class="menu-title">Quản lý ứng viên</div>
                <a href="{{ route('employer.saved-applications') }}" class="menu-item">
                    <i>👥</i>
                    <span>Hồ sơ ứng tuyển</span>
                </a>
                <a href="{{ route('employer.job-posting.find-candidate') }}" class="menu-item">
                    <i>🔍</i>
                    <span>Tìm ứng viên mới</span>
                </a>
            </div>
        </div>

        <div class="main-content">


            <h2>Chỉnh sửa khóa đào tạo: {{ $languagetraining->name }}</h2>

            <form action="{{ route('employer.languagetrainings.update', $languagetraining->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                @include('employer.languagetrainings.form', ['languagetraining' => $languagetraining])

                <button type="submit" class="btn btn-success">Cập nhật</button>
                <a href="{{ route('employer.languagetrainings.index') }}" class="btn btn-secondary">Quay lại</a>
            </form>

        </div>
    </section>
@endsection
