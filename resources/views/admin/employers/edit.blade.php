@extends('layouts.app')

@section('content')
    <div class="container-fluid px-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="mt-4">Chỉnh sửa nhà tuyển dụng</h1>
            <a href="{{ route('manage.employers.show', $employer) }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Quay lại
            </a>
        </div>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('manage.employers.update', $employer) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tên công ty</label>
                            <input type="text" class="form-control @error('company_name') is-invalid @enderror"
                                name="company_name" value="{{ old('company_name', $employer->company_name) }}" required>
                            @error('company_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Mã số thuế</label>
                            <input type="text" class="form-control @error('mst') is-invalid @enderror" name="mst"
                                value="{{ old('mst', $employer->mst) }}" required>
                            @error('mst')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Người liên hệ</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                value="{{ old('name', $employer->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                                value="{{ old('email', $employer->email) }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Số điện thoại</label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone"
                                value="{{ old('phone', $employer->phone) }}" required>
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Quy mô công ty</label>
                            <input type="text" class="form-control @error('scale') is-invalid @enderror" name="scale"
                                value="{{ old('scale', $employer->scale) }}" required>
                            @error('scale')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 mb-3">
                            <label class="form-label">Địa chỉ</label>
                            <input type="text" class="form-control @error('address') is-invalid @enderror" name="address"
                                value="{{ old('address', $employer->address) }}" required>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Website</label>
                            <input type="url" class="form-control @error('website') is-invalid @enderror" name="website"
                                value="{{ old('website', $employer->website) }}">
                            @error('website')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Facebook</label>
                            <input type="url" class="form-control @error('facebook') is-invalid @enderror"
                                name="facebook" value="{{ old('facebook', $employer->facebook) }}">
                            @error('facebook')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Twitter</label>
                            <input type="url" class="form-control @error('twitter') is-invalid @enderror" name="twitter"
                                value="{{ old('twitter', $employer->twitter) }}">
                            @error('twitter')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 mb-3">
                            <label class="form-label">Logo công ty</label>
                            <input type="file" class="form-control @error('logo') is-invalid @enderror" name="logo">
                            @if ($employer->logo)
                                <div class="mt-2">
                                    <img src="{{ asset('storage/' . $employer->logo) }}" alt="Current Logo"
                                        style="height: 100px;">
                                </div>
                            @endif
                            @error('logo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 mb-3">
                            <label class="form-label">Mô tả chi tiết</label>
                            <textarea class="form-control @error('detail') is-invalid @enderror" name="detail" rows="5">{{ old('detail', $employer->detail) }}</textarea>
                            @error('detail')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12 mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="status" value="1"
                                    {{ $employer->status ? 'checked' : '' }}>
                                <label class="form-check-label">Trạng thái hoạt động</label>
                            </div>
                        </div>

                        <div class="col-12 mb-3">
                            <h5>Dịch vụ nâng cao</h5>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="IsBasicnews"
                                            value="1" {{ $employer->IsBasicnews ? 'checked' : '' }}>
                                        <label class="form-check-label">Tin cơ bản</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="isUrgentrecruitment"
                                            value="1" {{ $employer->isUrgentrecruitment ? 'checked' : '' }}>
                                        <label class="form-check-label">Tuyển gấp</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="IsPartner" value="1"
                                            {{ $employer->IsPartner ? 'checked' : '' }}>
                                        <label class="form-check-label">Đối tác</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="IsHoteffect"
                                            value="1" {{ $employer->IsHoteffect ? 'checked' : '' }}>
                                        <label class="form-check-label">Nổi bật</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Lưu thay đổi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('styles')
        <style>
            .form-label {
                font-weight: 500;
            }

            .form-switch {
                padding-left: 2.5em;
            }

            .form-check-input {
                cursor: pointer;
            }
        </style>
    @endpush

    @push('scripts')
        <script>
            // Add CKEditor if needed
            if (typeof CKEDITOR !== 'undefined') {
                CKEDITOR.replace('detail');
            }
        </script>
    @endpush
@endsection
