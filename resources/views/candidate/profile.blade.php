@extends('layouts.layout_candidate_profile')

@section('title', 'Chỉnh sửa hồ sơ')

@section('content')


<div class="main-content">
    <h1>Chỉnh sửa hồ sơ</h1>

            <form method="POST" action="{{ route('candidate.profile.update') }}" enctype="multipart/form-data">
                @csrf
@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

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
                        value="{{ old('phone', $candidate->phone) }}"required>
                </div>


                <div class="form-group">
                    <label for="dob"><i class="fas fa-birthday-cake"></i> Ngày sinh</label>
                    <input type="date" class="form-control" id="dob" name="dob"
                        value="{{ old('dob', $candidate->dob ? $candidate->dob->format('Y-m-d') : '') }}" required>

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
                        value="{{ old('address', $candidate->address) }}"required>
                </div>

                <div class="form-group">
                    <label for="position"><i class="fas fa-briefcase"></i> Vị trí</label>
                    <input type="text" class="form-control" id="position" name="position"
                        value="{{ old('position', $candidate->position) }}"required>
                </div>

                <div class="form-group checkbox-group">
                    <label><i class="fas fa-globe"></i> Công khai hồ sơ</label>
                    <input type="hidden" name="is_public" value="0"> <!-- Giá trị mặc định -->
                    <input type="checkbox" id="is_public" name="is_public" value="1"
                        {{ old('is_public', $candidate->is_public) ? 'checked' : '' }}>
                </div>

                <div class="form-group checkbox-group">
                    <label><i class="fas fa-file-alt"></i> CV công khai</label>
                    <input type="hidden" name="cv_public" value="0"> <!-- Giá trị mặc định -->
                    <input type="checkbox" id="cv_public" name="cv_public" value="1"
                        {{ old('cv_public', $candidate->cv_public) ? 'checked' : '' }}>
                </div>


                <div class="form-group">
                    <label for="linkedin"><i class="fab fa-linkedin"></i> LinkedIn</label>
                    <input type="url" class="form-control" id="linkedin" name="linkedin"
                        value="{{ old('linkedin', $candidate->linkedin) }}">
                </div>

                <div class="form-group">
                    <label for="level"><i class="fas fa-layer-group"></i> Công việc hiện tại</label>
                    <input type="text" class="form-control" id="level" name="level"
                        value="{{ old('level', $candidate->level) }}" required>
                </div>

                <div class="form-group">
                    <label for="desired_level"><i class="fas fa-star"></i> Mong muốn cấp độ</label>
                    <select class="form-control" id="desired_level" name="desired_level" required>
                        <option value="">-- Chọn cấp độ mong muốn --</option>
                        <option value="Quản lý cấp cao"
                            {{ old('desired_level', $candidate->desired_level) == 'Quản lý cấp cao' ? 'selected' : '' }}>
                            Quản lý cấp cao
                        </option>
                        <option value="Quản lý cấp trung"
                            {{ old('desired_level', $candidate->desired_level) == 'Quản lý cấp trung' ? 'selected' : '' }}>
                            Quản lý cấp trung
                        </option>
                        <option value="Quản lý nhóm - giám sát"
                            {{ old('desired_level', $candidate->desired_level) == 'Quản lý nhóm - giám sát' ? 'selected' : '' }}>
                            Quản lý nhóm - giám sát
                        </option>
                        <option value="Chuyên gia"
                            {{ old('desired_level', $candidate->desired_level) == 'Chuyên gia' ? 'selected' : '' }}>
                            Chuyên gia
                        </option>
                        <option value="Chuyên viên - Nhân viên"
                            {{ old('desired_level', $candidate->desired_level) == 'Chuyên viên - Nhân viên' ? 'selected' : '' }}>
                            Chuyên viên - Nhân viên
                        </option>
                        <option value="Cộng tác viên"
                            {{ old('desired_level', $candidate->desired_level) == 'Cộng tác viên' ? 'selected' : '' }}>
                            Cộng tác viên
                        </option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="desired_salary"><i class="fas fa-money-bill-wave"></i> Mong muốn lương</label>
                    <input type="text" class="form-control" id="desired_salary" name="desired_salary"
                        value="{{ old('desired_salary', $candidate->desired_salary) }}" required>
                </div>

                <div class="form-group">
                    <label for="education_level"><i class="fas fa-graduation-cap"></i> Trình độ học vấn</label>
                    <select class="form-control" id="education_level" name="education_level" required>
                        <option value="">-- Chọn trình độ học vấn --</option>
                        <option value="Trên đại học"
                            {{ old('education_level', $candidate->education_level) == 'Trên đại học' ? 'selected' : '' }}>
                            Trên đại học
                        </option>
                        <option value="Đại học"
                            {{ old('education_level', $candidate->education_level) == 'Đại học' ? 'selected' : '' }}>
                            Đại học
                        </option>
                        <option value="Cao đẳng"
                            {{ old('education_level', $candidate->education_level) == 'Cao đẳng' ? 'selected' : '' }}>
                            Cao đẳng
                        </option>
                        <option value="Trung cấp"
                            {{ old('education_level', $candidate->education_level) == 'Trung cấp' ? 'selected' : '' }}>
                            Trung cấp
                        </option>
                        <option value="Trung học"
                            {{ old('education_level', $candidate->education_level) == 'Trung học' ? 'selected' : '' }}>
                            Trung học
                        </option>
                        <option value="Chứng chỉ nghề"
                            {{ old('education_level', $candidate->education_level) == 'Chứng chỉ nghề' ? 'selected' : '' }}>
                            Chứng chỉ nghề
                        </option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="years_of_experience"><i class="fas fa-clock"></i> Số năm kinh nghiệm</label>
                    <input type="number" class="form-control" id="years_of_experience" name="years_of_experience"
                        value="{{ old('years_of_experience', $candidate->years_of_experience) }}" required>
                </div>

                <div class="form-group">
                    <label for="working_form"><i class="fas fa-building"></i> Hình thức làm việc</label>
                    <select class="form-control" id="working_form" name="working_form" required>
                        <option value="">-- Chọn hình thức làm việc --</option>
                        <option value="Toàn thời gian cố định"
                            {{ old('working_form', $candidate->working_form) == 'Toàn thời gian cố định' ? 'selected' : '' }}>
                            Toàn thời gian cố định
                        </option>
                        <option value="Toàn thời gian tạm thời"
                            {{ old('working_form', $candidate->working_form) == 'Toàn thời gian tạm thời' ? 'selected' : '' }}>
                            Toàn thời gian tạm thời
                        </option>
                        <option value="Bán thời gian cố định"
                            {{ old('working_form', $candidate->working_form) == 'Bán thời gian cố định' ? 'selected' : '' }}>
                            Bán thời gian cố định
                        </option>
                        <option value="Bán thời gian tạm thời"
                            {{ old('working_form', $candidate->working_form) == 'Bán thời gian tạm thời' ? 'selected' : '' }}>
                            Bán thời gian tạm thời
                        </option>
                        <option value="Theo hợp đồng tư vấn"
                            {{ old('working_form', $candidate->working_form) == 'Theo hợp đồng tư vấn' ? 'selected' : '' }}>
                            Theo hợp đồng tư vấn
                        </option>
                        <option value="Thực tập"
                            {{ old('working_form', $candidate->working_form) == 'Thực tập' ? 'selected' : '' }}>
                            Thực tập
                        </option>
                        <option value="Khác"
                            {{ old('working_form', $candidate->working_form) == 'Khác' ? 'selected' : '' }}>
                            Khác
                        </option>
                    </select>
                </div>
<div class="form-group">
    <label><i class="fas fa-language"></i> Ngôn ngữ</label>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#languageModal">
        Thêm / Chỉnh sửa ngôn ngữ
    </button>
</div>
<ul id="selectedLanguages" class="list-group mt-3">
    @foreach($candidate->languages as $lang)
        <li class="list-group-item d-flex justify-content-between align-items-center">
            {{ $lang->name }} - <em>{{ $lang->pivot->proficiency }}</em>
        </li>
    @endforeach
</ul>
<div class="modal fade" id="languageModal" tabindex="-1" role="dialog" aria-labelledby="languageModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="languageModalLabel">Chọn Ngôn ngữ</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Đóng">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        @foreach($allLanguages as $language)
            @php
                $selectedLang = $candidate->languages->firstWhere('id', $language->id);
                $proficiency = optional(optional($selectedLang)->pivot)->proficiency;
            @endphp
            <div class="form-group">
                <label>{{ $language->name }}</label>
                <input type="hidden" name="languages[{{ $language->id }}][id]" value="{{ $language->id }}">
                <select name="languages[{{ $language->id }}][proficiency]" class="form-control">
                    <option value="">-- Chọn mức độ --</option>
                    <option value="basic" {{ $proficiency == 'basic' ? 'selected' : '' }}>Cơ bản</option>
                    <option value="intermediate" {{ $proficiency == 'intermediate' ? 'selected' : '' }}>Trung bình</option>
                    <option value="advanced" {{ $proficiency == 'advanced' ? 'selected' : '' }}>Nâng cao</option>
                    <option value="fluent" {{ $proficiency == 'fluent' ? 'selected' : '' }}>Thông thạo</option>
                </select>
            </div>
        @endforeach
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
        <button type="submit" class="btn btn-primary">Lưu</button>
      </div>
    </div>
  </div>
</div>


               <div class="form-group">
    <label for="skills"><i class="fas fa-cogs"></i> Kỹ năng</label>
    <select name="skills[]" id="skills" class="form-control" multiple>
        @foreach($allSkills as $skill)
            <option value="{{ $skill->id }}" {{ in_array($skill->id, $candidate->skills->pluck('id')->toArray()) ? 'selected' : '' }}>
                {{ $skill->name }}
            </option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="soft_skills"><i class="fas fa-lightbulb"></i> Kỹ năng mềm</label>
    <select name="soft_skills[]" id="soft_skills" class="form-control" multiple>
        @foreach($allSoftSkills as $softSkill)
            <option value="{{ $softSkill->id }}"
                {{ in_array($softSkill->id, $candidate->softSkills->pluck('id')->toArray()) ? 'selected' : '' }}>
                {{ $softSkill->name }}
            </option>
        @endforeach
    </select>
</div>

                <div class="form-group">
                    <label for="avatar_candidate"><i class="fas fa-camera"></i> Ảnh đại diện</label>
                    @if ($candidate->avatar_candidate)
                        <div class="mb-3">
                            <img src="{{ asset('storage/avatars/' . $candidate->avatar_candidate) }}" alt="Avatar"
                                class="img-thumbnail" style="max-width: 200px;">
                        </div>
                    @endif
                    <input type="file" class="form-control-file" id="avatar_candidate" name="avatar_candidate">
                </div>

                <div class="form-group text-center">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Cập nhật hồ sơ
                    </button>
                </div>

            </form>



   <!-- Hiển thị danh sách experiences -->
<div class="form-group">
    <label for="experiences">Kinh nghiệm làm việc</label>
    <ul>
    @foreach($experiences as $experience)
        <li class="mb-3">
            <strong><i class="fas fa-building"></i> {{ $experience->company_name }}</strong>
            <span class="ml-2"><i class="fas fa-briefcase"></i> {{ $experience->position }}</span>
            <br>
            <small>
                <i class="fas fa-calendar-alt"></i>
                {{ \Carbon\Carbon::parse($experience->start_date)->format('d/m/Y') }}
                -
                {{ $experience->end_date ? \Carbon\Carbon::parse($experience->end_date)->format('d/m/Y') : 'Hiện tại' }}
            </small>
            <br>
            @if($experience->description)
                <p class="mt-1"></i> {!! $experience->description !!}</p>
            @endif

            <!-- Nút Icon -->
            <button type="button" class="btn btn-sm btn-secondary" data-toggle="modal" data-target="#editExperienceModal-{{ $experience->id }}">
                <i class="fas fa-edit"></i>
            </button>
            <form action="{{ route('candidate.experiences.destroy', $experience->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger">
                    <i class="fas fa-trash-alt"></i>
                </button>
            </form>
        </li>
    @endforeach
</ul>

</div>
<!-- Modal tạo mới hoặc chỉnh sửa kinh nghiệm -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addExperienceModal">
    Thêm Kinh Nghiệm
</button>



<!-- Modal Thêm Kinh Nghiệm -->
<div class="modal fade" id="addExperienceModal" tabindex="-1" role="dialog" aria-labelledby="addExperienceModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addExperienceModalLabel">Thêm Kinh Nghiệm</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('candidate.experiences.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="company_name">Tên công ty</label>
                        <input type="text" class="form-control" id="company_name" name="company_name" required>
                    </div>
                    <div class="form-group">
                        <label for="position">Vị trí</label>
                        <input type="text" class="form-control" id="position" name="position" required>
                    </div>
                    <div class="form-group">
                        <label for="start_date">Ngày bắt đầu</label>
                        <input type="date" class="form-control" id="start_date" name="start_date" required>
                    </div>
                    <div class="form-group">
                        <label for="end_date">Ngày kết thúc</label>
                        <input type="date" class="form-control" id="end_date" name="end_date">
                    </div>
                    <div class="form-group">
                        <label for="description">Mô tả</label>
                        <textarea class="form-control" id="description" name="description"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary">Lưu</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Sửa Kinh Nghiệm -->
@foreach($experiences as $experience)
<div class="modal fade" id="editExperienceModal-{{ $experience->id }}" tabindex="-1" role="dialog" aria-labelledby="editExperienceModalLabel-{{ $experience->id }}" aria-hidden="true">

    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editExperienceModalLabel-{{ $experience->id }}">Sửa Kinh Nghiệm</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('candidate.experiences.update', $experience->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="company_name">Tên công ty</label>
                        <input type="text" class="form-control" id="company_name" name="company_name" value="{{ old('company_name', $experience->company_name) }}" required>
                    </div>
                    <div class="form-group">
                        <label for="position">Vị trí</label>
                        <input type="text" class="form-control" id="position" name="position" value="{{ old('position', $experience->position) }}" required>
                    </div>
                    <div class="form-group">
                        <label for="start_date">Ngày bắt đầu</label>
                       <input type="date" class="form-control" id="start_date" name="start_date"
    value="{{ old('start_date', \Carbon\Carbon::parse($experience->start_date)->format('Y-m-d')) }}" required>

                    </div>
                    <div class="form-group">
                        <label for="end_date">Ngày kết thúc</label>
                      <input type="date" class="form-control" id="end_date" name="end_date"
    value="{{ old('end_date', $experience->end_date ? \Carbon\Carbon::parse($experience->end_date)->format('Y-m-d') : '') }}">

                    </div>
                    <div class="form-group">
                        <label for="description">Mô tả</label>
                        <textarea class="form-control" id="description" name="description">{{ old('description', $experience->description) }}</textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
<div class="form-group">
    <label for="educations">Học vấn</label>
    <ul>
        @foreach($educations as $education)
            <li class="mb-3">
                <strong><i class="fas fa-university"></i> {{ $education->institution_name }}</strong>
                <span class="ml-2"><i class="fas fa-user-graduate"></i> {{ $education->degree }}</span>
                @if($education->field_of_study)
                    <span class="ml-2"><i class="fas fa-book"></i> {{ $education->field_of_study }}</span>
                @endif
                <br>
                <small>
                    <i class="fas fa-calendar-alt"></i>
                    {{ \Carbon\Carbon::parse($education->start_date)->format('d/m/Y') }}
                    -
                    {{ $education->end_date ? \Carbon\Carbon::parse($education->end_date)->format('d/m/Y') : 'Hiện tại' }}
                </small>
                <br>
                @if($education->description)
                    <p class="mt-1"><i class="fas fa-align-left"></i> {{ $education->description }}</p>
                @endif

                <!-- Icon Sửa/Xóa -->
                <button type="button" class="btn btn-sm btn-secondary" data-toggle="modal" data-target="#editEducationModal-{{ $education->id }}">
                    <i class="fas fa-edit"></i>
                </button>
                <form action="{{ route('candidate.educations.destroy', $education->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </form>
            </li>
        @endforeach
    </ul>
</div>
<!-- Nút thêm -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addEducationModal">
    Thêm Học Vấn
</button>

<!-- Modal Thêm -->
<div class="modal fade" id="addEducationModal" tabindex="-1" role="dialog" aria-labelledby="addEducationModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{ route('candidate.educations.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Thêm Học Vấn</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Tên trường</label>
                        <input type="text" class="form-control" name="institution_name" required>
                    </div>
                    <div class="form-group">
                        <label>Bằng cấp</label>
                        <input type="text" class="form-control" name="degree" required>
                    </div>
                    <div class="form-group">
                        <label>Ngành học</label>
                        <input type="text" class="form-control" name="field_of_study">
                    </div>
                    <div class="form-group">
                        <label>Ngày bắt đầu</label>
                        <input type="date" class="form-control" name="start_date" required>
                    </div>
                    <div class="form-group">
                        <label>Ngày kết thúc</label>
                        <input type="date" class="form-control" name="end_date">
                    </div>
                    <div class="form-group">
                        <label>Mô tả</label>
                        <textarea class="form-control" name="description"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary">Lưu</button>
                </div>
            </div>
        </form>
    </div>
</div>
@foreach($educations as $education)
<div class="modal fade" id="editEducationModal-{{ $education->id }}" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <form action="{{ route('candidate.educations.update', $education->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Sửa Học Vấn</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Tên trường</label>
                        <input type="text" class="form-control" name="institution_name" value="{{ old('institution_name', $education->institution_name) }}" required>
                    </div>
                    <div class="form-group">
                        <label>Bằng cấp</label>
                        <input type="text" class="form-control" name="degree" value="{{ old('degree', $education->degree) }}" required>
                    </div>
                    <div class="form-group">
                        <label>Ngành học</label>
                        <input type="text" class="form-control" name="field_of_study" value="{{ old('field_of_study', $education->field_of_study) }}">
                    </div>
                    <div class="form-group">
                        <label>Ngày bắt đầu</label>
                        <input type="date" class="form-control" name="start_date" value="{{ old('start_date', \Carbon\Carbon::parse($education->start_date)->format('Y-m-d')) }}" required>
                    </div>
                    <div class="form-group">
                        <label>Ngày kết thúc</label>
                        <input type="date" class="form-control" name="end_date" value="{{ old('end_date', $education->end_date ? \Carbon\Carbon::parse($education->end_date)->format('Y-m-d') : '') }}">
                    </div>
                    <div class="form-group">
                        <label>Mô tả</label>
                        <textarea class="form-control" name="description">{{ old('description', $education->description) }}</textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endforeach


<div class="form-group">
    <label for="educations">CV</label>
<ul class="list-group">
    @foreach($candidate->cvs as $cv)
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <div>
                <strong>{{ $cv->title }}</strong> -
                <a href="{{ asset('storage/' . $cv->file_path) }}" target="_blank">{{ $cv->file_name }}</a>
                <small>({{ number_format($cv->file_size, 1) }} KB)</small>
            </div>
            <div class="d-flex align-items-center gap-2">
                <span class="badge badge-{{ $cv->pivot->is_primary ? 'success' : 'secondary' }}">
                    {{ $cv->pivot->is_primary ? 'Chính' : 'Phụ' }}
                </span>

                <!-- Nút Xóa -->
                <form action="{{ route('candidate.deleteCV', $cv->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc muốn xóa CV này?')" class="ml-2">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger" title="Xóa CV">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </form>
            </div>
        </li>
    @endforeach
</ul>

</div>
<!-- Nút mở modal -->
<button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#uploadCVModal">
    <i class="fas fa-plus"></i> Thêm CV
</button>

<!-- Modal -->
<div class="modal fade" id="uploadCVModal" tabindex="-1" role="dialog" aria-labelledby="uploadCVModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form action="{{ route('candidate.uploadCV') }}" method="POST" enctype="multipart/form-data" class="modal-content">
      @csrf
      <div class="modal-header">
        <h5 class="modal-title" id="uploadCVModalLabel">Tải lên CV mới</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Đóng">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <div class="form-group">
            <label for="title">Tên CV</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="cv">Chọn file CV</label>
            <input type="file" name="cv" class="form-control" accept=".pdf,.doc,.docx" required>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
        <button type="submit" class="btn btn-success">Tải lên</button>
      </div>
    </form>
  </div>
</div>

</div>
@endsection
