@extends('layout')

@section('title', 'Chỉnh sửa hồ sơ')

@section('content')
    <style>
   /* Container styling */
.container {
    width: 100%;
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
}

/* Auth card styling */
.auth-card {
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    padding: 30px;
    max-width: 800px;
    margin: 40px auto;
}

/* Header styling */
.auth-header {
    margin-bottom: 30px;
}

.auth-header h2 {
    color: #333;
    font-size: 24px;
    margin: 10px 0 0;
}

.header-icon {
    font-size: 32px;
    color: #dc3545; /* Changed to red */
    margin-bottom: 10px;
}

/* Form group styling */
.form-group {
    margin-bottom: 20px;
}

.form-group label {
    display: block;
    margin-bottom: 8px;
    font-weight: 500;
    color: #555;
}

.form-group label i {
    width: 20px;
    margin-right: 8px;
    color: #dc3545; /* Changed to red */
}

.checkbox-group {
    display: flex;
    align-items: center;
    gap: 10px;
}

.checkbox-group label {
    margin-bottom: 0;
}

.form-control {
    width: 100%;
    padding: 10px 12px;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 16px;
    transition: border-color 0.3s;
}

.form-control:focus {
    border-color: #dc3545; /* Changed to red */
    outline: none;
    box-shadow: 0 0 0 3px rgba(220, 53, 69, 0.25); /* Changed to red with opacity */
}

/* Checkbox styling */
input[type="checkbox"] {
    width: 18px;
    height: 18px;
    margin-right: 8px;
    cursor: pointer;
}

/* File input styling */
.form-control-file {
    padding: 8px 0;
}

/* Button styling */
.btn {
    padding: 12px 24px;
    border-radius: 4px;
    font-size: 16px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s;
}

.btn i {
    margin-right: 8px;
}

.btn-primary {
    background-color: #dc3545; /* Changed to red */
    border: none;
    color: white;
}

.btn-primary:hover {
    background-color: #c82333; /* Darker red for hover */
}

/* Alert styling */
.alert {
    padding: 12px 20px;
    border-radius: 4px;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.alert i {
    font-size: 18px;
}

.alert-success {
    background-color: #d4edda;
    border-color: #c3e6cb;
    color: #155724;
}

/* Responsive design */
@media (max-width: 768px) {
    .container {
        padding: 10px;
    }

    .auth-card {
        padding: 20px;
        margin: 20px auto;
    }

    .auth-header h2 {
        font-size: 20px;
    }

    .header-icon {
        font-size: 28px;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .btn {
        width: 100%;
        padding: 10px 20px;
    }
}

@media (max-width: 480px) {
    .auth-card {
        padding: 15px;
        margin: 10px auto;
    }

    .header-icon {
        font-size: 24px;
    }

    .form-control {
        font-size: 14px;
        padding: 8px 10px;
    }

    .btn {
        font-size: 14px;
    }

    .form-group label i {
        width: 16px;
        font-size: 14px;
    }
}
    </style>
    <div class="container">
        <div class="auth-card">
            <div class="auth-header text-center">
                <i class="fas fa-user-edit header-icon"></i>
                <h2>Chỉnh sửa hồ sơ</h2>
            </div>

            @if (session('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i>
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('candidate.profile.update') }}" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="name"><i class="fas fa-user"></i> Tên</label>
                    <input type="text" class="form-control" id="name" name="name"
                        value="{{ old('name', $candidate->name) }}" required>
                </div>

                <div class="form-group">
                    <label for="email"><i class="fas fa-envelope"></i> Email</label>
                    <input type="email" class="form-control" id="email" name="email"
                        value="{{ old('email', $candidate->email) }}" readonly>
                </div>

                <div class="form-group">
                    <label for="phone"><i class="fas fa-phone"></i> Số điện thoại</label>
                    <input type="text" class="form-control" id="phone" name="phone"
                        value="{{ old('phone', $candidate->phone) }}">
                </div>


                <div class="form-group">
                    <label for="dob"><i class="fas fa-birthday-cake"></i> Ngày sinh</label>
                    <input type="date" class="form-control" id="dob" name="dob"
                        value="{{ old('dob', $candidate->dob) }}">
                </div>

                <div class="form-group">
                    <label for="gender"><i class="fas fa-venus-mars"></i> Giới tính</label>
                    <select class="form-control" id="gender" name="gender">
                        <option value="male" {{ old('gender', $candidate->gender) == 'male' ? 'selected' : '' }}>Nam
                        </option>
                        <option value="female" {{ old('gender', $candidate->gender) == 'female' ? 'selected' : '' }}>Nữ
                        </option>
                        <option value="other" {{ old('gender', $candidate->gender) == 'other' ? 'selected' : '' }}>Khác
                        </option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="address"><i class="fas fa-map-marker-alt"></i> Địa chỉ</label>
                    <input type="text" class="form-control" id="address" name="address"
                        value="{{ old('address', $candidate->address) }}">
                </div>

                <div class="form-group">
                    <label for="position"><i class="fas fa-briefcase"></i> Vị trí</label>
                    <input type="text" class="form-control" id="position" name="position"
                        value="{{ old('position', $candidate->position) }}">
                </div>

                <div class="form-group checkbox-group">
                    <label><i class="fas fa-globe"></i> Công khai</label>
                    <input type="checkbox" id="is_public" name="is_public"
                        {{ old('is_public', $candidate->is_public) ? 'checked' : '' }}>
                </div>

                <div class="form-group checkbox-group">
                    <label><i class="fas fa-file-alt"></i> CV công khai</label>
                    <input type="checkbox" id="cv_public" name="cv_public"
                        {{ old('cv_public', $candidate->cv_public) ? 'checked' : '' }}>
                </div>

                <div class="form-group">
                    <label for="linkedin"><i class="fab fa-linkedin"></i> LinkedIn</label>
                    <input type="url" class="form-control" id="linkedin" name="linkedin"
                        value="{{ old('linkedin', $candidate->linkedin) }}">
                </div>

                <div class="form-group">
                    <label for="level"><i class="fas fa-layer-group"></i> Cấp độ</label>
                    <input type="text" class="form-control" id="level" name="level"
                        value="{{ old('level', $candidate->level) }}">
                </div>

                <div class="form-group">
                    <label for="desired_level"><i class="fas fa-star"></i> Mong muốn cấp độ</label>
                    <input type="text" class="form-control" id="desired_level" name="desired_level"
                        value="{{ old('desired_level', $candidate->desired_level) }}">
                </div>

                <div class="form-group">
                    <label for="desired_salary"><i class="fas fa-money-bill-wave"></i> Mong muốn lương</label>
                    <input type="number" class="form-control" id="desired_salary" name="desired_salary"
                        value="{{ old('desired_salary', $candidate->desired_salary) }}">
                </div>

                <div class="form-group">
                    <label for="education_level"><i class="fas fa-graduation-cap"></i> Trình độ học vấn</label>
                    <input type="text" class="form-control" id="education_level" name="education_level"
                        value="{{ old('education_level', $candidate->education_level) }}">
                </div>

                <div class="form-group">
                    <label for="years_of_experience"><i class="fas fa-clock"></i> Số năm kinh nghiệm</label>
                    <input type="number" class="form-control" id="years_of_experience" name="years_of_experience"
                        value="{{ old('years_of_experience', $candidate->years_of_experience) }}">
                </div>

                <div class="form-group">
                    <label for="working_form"><i class="fas fa-building"></i> Hình thức làm việc</label>
                    <input type="text" class="form-control" id="working_form" name="working_form"
                        value="{{ old('working_form', $candidate->working_form) }}">
                </div>

                <div class="form-group">
                    <label for="avatar_candidate"><i class="fas fa-camera"></i> Ảnh đại diện</label>
                    <input type="file" class="form-control-file" id="avatar_candidate" name="avatar_candidate">
                </div>

                <div class="form-group">
                    <label for="cv_path"><i class="fas fa-file-upload"></i> CV</label>
                    <input type="file" class="form-control-file" id="cv_path" name="cv_path">
                </div>

                <div class="form-group text-center">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Cập nhật hồ sơ
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
