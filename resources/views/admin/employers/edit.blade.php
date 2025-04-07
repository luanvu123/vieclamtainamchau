@extends('layouts.app')

@section('content')
    <div id="titlebar">
        <div class="row">
            <div class="col-md-12">
                <h2><i class="fas fa-building"></i> Chỉnh sửa nhà tuyển dụng</h2>

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

                <form action="{{ route('manage.employers.update', $employer) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong><i class="fas fa-building"></i> Tên công ty:</strong>
                            <input type="text" class="form-control @error('company_name') is-invalid @enderror"
                                name="company_name" value="{{ old('company_name', $employer->company_name) }}" required>
                            @error('company_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong><i class="fas fa-file-invoice"></i> Mã số thuế:</strong>
                            <input type="text" class="form-control @error('mst') is-invalid @enderror" name="mst"
                                value="{{ old('mst', $employer->mst) }}" required>
                            @error('mst')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong><i class="fas fa-user-tie"></i> Người liên hệ:</strong>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                value="{{ old('name', $employer->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong><i class="fas fa-envelope"></i> Email:</strong>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                                value="{{ old('email', $employer->email) }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong><i class="fas fa-phone"></i> Số điện thoại:</strong>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone"
                                value="{{ old('phone', $employer->phone) }}" required>
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong><i class="fas fa-users"></i> Quy mô công ty:</strong>
                            <input type="text" class="form-control @error('scale') is-invalid @enderror" name="scale"
                                value="{{ old('scale', $employer->scale) }}" required>
                            @error('scale')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong><i class="fas fa-map-marker-alt"></i> Địa chỉ:</strong>
                            <input type="text" class="form-control @error('address') is-invalid @enderror" name="address"
                                value="{{ old('address', $employer->address) }}" required>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong><i class="fas fa-globe"></i> Website:</strong>
                            <input type="url" class="form-control @error('website') is-invalid @enderror" name="website"
                                value="{{ old('website', $employer->website) }}">
                            @error('website')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong><i class="fab fa-facebook"></i> Facebook:</strong>
                            <input type="url" class="form-control @error('facebook') is-invalid @enderror"
                                name="facebook" value="{{ old('facebook', $employer->facebook) }}">
                            @error('facebook')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong><i class="fab fa-twitter"></i> Twitter:</strong>
                            <input type="url" class="form-control @error('twitter') is-invalid @enderror" name="twitter"
                                value="{{ old('twitter', $employer->twitter) }}">
                            @error('twitter')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong><i class="fas fa-image"></i> Logo công ty:</strong>
                            <input type="file" class="form-control @error('logo') is-invalid @enderror" name="logo">
                            @if ($employer->avatar)
                                <img src="{{ asset('storage/' . $employer->avatar) }}" alt="Current Logo"
                                    style="height: 100px; margin-top: 10px;">
                            @endif
                            @error('logo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong><i class="fas fa-info-circle"></i> Mô tả chi tiết:</strong>
                            <textarea class="form-control @error('detail') is-invalid @enderror" name="detail" rows="5">{{ old('detail', $employer->detail) }}</textarea>
                            @error('detail')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong><i class="fas fa-user-shield"></i> Quản lý bởi:</strong>
                            <select class="form-control @error('user_id') is-invalid @enderror" name="user_id">
                                <option value="">-- Không chọn --</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}"
                                        {{ old('user_id', $employer->user_id) == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }} ({{ $user->email }})
                                    </option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong><i class="fas fa-toggle-on"></i> Trạng thái:</strong>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="status" value="1"
                                    {{ $employer->status ? 'checked' : '' }}>
                                <label class="form-check-label">Trạng thái hoạt động</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong><i class="fas fa-check-circle"></i> Xác thực:</strong>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="isVerifyCompany" value="1"
                                    {{ $employer->isVerifyCompany ? 'checked' : '' }}>
                                <label class="form-check-label">Đã xác thực số điện thoại</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong><i class="fas fa-star"></i> Dịch vụ nâng cao:</strong>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="service-card">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" name="IsBasicnews"
                                                value="1" {{ $employer->IsBasicnews ? 'checked' : '' }}>
                                            <label class="form-check-label">
                                                <i class="fas fa-newspaper text-primary"></i> Tin cơ bản
                                            </label>
                                        </div>
                                        @if ($employer->IsBasicnews_updated_at)
                                            <div class="service-update-info">
                                                <small class="text-muted">
                                                    <i class="fas fa-clock"></i>
                                                    {{ $employer->IsBasicnews_updated_at->format('H:i d/m/Y') }}
                                                    <span class="d-block ms-3">
                                                        {{ $employer->IsBasicnews_updated_at->diffForHumans() }}
                                                    </span>
                                                </small>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="service-card">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" name="IsHome"
                                                value="1" {{ $employer->IsHome ? 'checked' : '' }}>
                                            <label class="form-check-label">
                                                <i class="fas fa-home text-primary"></i> Trang chủ
                                            </label>
                                        </div>
                                        @if ($employer->IsHome_updated_at)
                                            <div class="service-update-info">
                                                <small class="text-muted">
                                                    <i class="fas fa-clock"></i>
                                                    {{ $employer->IsHome_updated_at->format('H:i d/m/Y') }}
                                                    <span class="d-block ms-3">
                                                        {{ $employer->IsHome_updated_at->diffForHumans() }}
                                                    </span>
                                                </small>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="service-card">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" name="isUrgentrecruitment"
                                                value="1" {{ $employer->isUrgentrecruitment ? 'checked' : '' }}>
                                            <label class="form-check-label">
                                                <i class="fas fa-bolt text-warning"></i> Tìm ứng viên
                                            </label>
                                        </div>
                                        @if ($employer->isUrgentrecruitment_updated_at)
                                            <div class="service-update-info">
                                                <small class="text-muted">
                                                    <i class="fas fa-clock"></i>
                                                    {{ $employer->isUrgentrecruitment_updated_at->format('H:i d/m/Y') }}
                                                    <span class="d-block ms-3">
                                                        {{ $employer->isUrgentrecruitment_updated_at->diffForHumans() }}
                                                    </span>
                                                </small>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="service-card">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" name="IsPartner"
                                                value="1" {{ $employer->IsPartner ? 'checked' : '' }}>
                                            <label class="form-check-label">
                                                <i class="fas fa-crown text-warning"></i> Đối tác
                                            </label>
                                        </div>
                                        @if ($employer->IsPartner_updated_at)
                                            <div class="service-update-info">
                                                <small class="text-muted">
                                                    <i class="fas fa-clock"></i>
                                                    {{ $employer->IsPartner_updated_at->format('H:i d/m/Y') }}
                                                    <span class="d-block ms-3">
                                                        {{ $employer->IsPartner_updated_at->diffForHumans() }}
                                                    </span>
                                                </small>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="service-card">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" name="IsHoteffect"
                                                value="1" {{ $employer->IsHoteffect ? 'checked' : '' }}>
                                            <label class="form-check-label">
                                                <i class="fas fa-fire text-danger"></i> Nổi bật
                                            </label>
                                        </div>
                                        @if ($employer->IsHoteffect_updated_at)
                                            <div class="service-update-info">
                                                <small class="text-muted">
                                                    <i class="fas fa-clock"></i>
                                                    {{ $employer->IsHoteffect_updated_at->format('H:i d/m/Y') }}
                                                    <span class="d-block ms-3">
                                                        {{ $employer->IsHoteffect_updated_at->diffForHumans() }}
                                                    </span>
                                                </small>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <a href="{{ route('manage.employers.show', $employer) }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Quay lại
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Lưu thay đổi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
