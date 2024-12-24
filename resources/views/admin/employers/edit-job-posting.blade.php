@extends('layouts.app')

@section('content')
    <div class="main-content">
        <h1 class="mb-4">Chỉnh sửa bài đăng tuyển dụng</h1>
        <div class="container">
            <form
                action="{{ route('employer.admin.job-postings.update', ['employerId' => $employer->id, 'jobPostingId' => $jobPosting->id]) }}"
                method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="title" class="form-label">Email</label>
                    <input class="search-field" type="text" name="email" value="{{ $employer->email }}" readonly>
                </div>

                <div class="mb-3">
                    <label for="title" class="form-label">Tiêu đề</label>
                    <input type="text" id="title" name="title" class="form-control"
                        value="{{ old('title', $jobPosting->title) }}" required>
                    @error('title')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="type" class="form-label">Loại công việc</label>
                    <select id="type" name="type" class="form-select" required>
                        <option value="fulltime" {{ $jobPosting->type == 'fulltime' ? 'selected' : '' }}>Fulltime
                        </option>
                        <option value="parttime" {{ $jobPosting->type == 'parttime' ? 'selected' : '' }}>Parttime
                        </option>
                        <option value="intern" {{ $jobPosting->type == 'intern' ? 'selected' : '' }}>Thực tập</option>
                        <option value="freelance" {{ $jobPosting->type == 'freelance' ? 'selected' : '' }}>Freelance
                        </option>
                    </select>
                    @error('type')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="age_range" class="form-label">Độ tuổi</label>
                    <input type="text" id="age_range" name="age_range" class="form-control"
                        value="{{ old('age_range', $jobPosting->age_range) }}">
                    @error('age_range')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="location" class="form-label">Địa điểm</label>
                    <input type="text" id="location" name="location" class="form-control"
                        value="{{ old('location', $jobPosting->location) }}">
                    @error('location')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="experience" class="form-label">Kinh nghiệm yêu cầu</label>
                    <select id="experience" name="experience" class="form-control">
                        <option value="Không yêu cầu" {{ $jobPosting->experience == 'Không yêu cầu' ? 'selected' : '' }}>
                            Không yêu cầu</option>
                        <option value="1 năm" {{ $jobPosting->experience == '1 năm' ? 'selected' : '' }}>1 năm
                        </option>
                        <option value="2 năm" {{ $jobPosting->experience == '2 năm' ? 'selected' : '' }}>2 năm
                        </option>
                        <option value="3 năm" {{ $jobPosting->experience == '3 năm' ? 'selected' : '' }}>3 năm
                        </option>
                        <option value="4 năm" {{ $jobPosting->experience == '4 năm' ? 'selected' : '' }}>4 năm
                        </option>
                        <option value="5 năm" {{ $jobPosting->experience == '5 năm' ? 'selected' : '' }}>5 năm
                        </option>
                        <option value="5+ năm" {{ $jobPosting->experience == '5+ năm' ? 'selected' : '' }}>5+ năm
                        </option>
                    </select>
                    @error('experience')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="rank" class="form-label">Cấp bậc</label>
                    <select id="rank" name="rank" class="form-control">
                        <option value="Nhân viên" {{ $jobPosting->rank == 'Nhân viên' ? 'selected' : '' }}>Nhân viên
                        </option>
                        <option value="Thực tập sinh" {{ $jobPosting->rank == 'Thực tập sinh' ? 'selected' : '' }}>
                            Thực tập sinh</option>
                        <option value="Quản lý" {{ $jobPosting->rank == 'Quản lý' ? 'selected' : '' }}>Quản lý
                        </option>
                        <option value="Khác" {{ $jobPosting->rank == 'Khác' ? 'selected' : '' }}>Khác</option>
                    </select>
                    @error('rank')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="number_of_recruits" class="form-label">Số lượng tuyển dụng</label>
                    <input type="number" id="number_of_recruits" name="number_of_recruits" class="form-control"
                        value="{{ old('number_of_recruits', $jobPosting->number_of_recruits) }}">
                    @error('number_of_recruits')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="sex" class="form-label">Giới tính</label>
                    <select id="sex" name="sex" class="form-control">
                        <option value="Nam" {{ $jobPosting->sex == 'Nam' ? 'selected' : '' }}>Nam</option>
                        <option value="Nữ" {{ $jobPosting->sex == 'Nữ' ? 'selected' : '' }}>Nữ</option>
                        <option value="Không yêu cầu" {{ $jobPosting->sex == 'Không yêu cầu' ? 'selected' : '' }}>
                            Không yêu cầu</option>
                    </select>
                    @error('sex')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="skills_required" class="form-label">Kỹ năng yêu cầu</label>
                    <input type="text" id="skills_required" name="skills_required" class="form-control"
                        value="{{ old('skills_required', $jobPosting->skills_required) }}">
                    @error('skills_required')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Mô tả công việc</label>
                    <textarea id="description" name="description" class="form-control" rows="4" required>{{ old('description', $jobPosting->description) }}</textarea>
                    @error('description')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="application_email_url" class="form-label">Email ứng tuyển</label>
                    <input type="email" id="application_email_url" name="application_email_url" class="form-control"
                        value="{{ old('application_email_url', $jobPosting->application_email_url) }}" required>
                    @error('application_email_url')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="closing_date" class="form-label">Hạn chót</label>
                    <input type="date" id="closing_date" name="closing_date" class="form-control"
                        value="{{ old('closing_date', $jobPosting->closing_date) }}">
                    @error('closing_date')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="salary" class="form-label">Mức lương</label>
                    <input type="text" id="salary" name="salary" class="form-control"
                        value="{{ old('salary', $jobPosting->salary) }}">
                    @error('salary')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="categories" class="form-label">Danh mục</label>
                    <select id="categories" name="categories[]" class="form-select" multiple>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ in_array($category->id, $jobPosting->categories->pluck('id')->toArray()) ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('categories')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="countries" class="form-label">Quốc gia</label>
                    <select id="countries" name="countries[]" class="form-select" multiple>
                        @foreach ($countries as $country)
                            <option value="{{ $country->id }}"
                                {{ in_array($country->id, $jobPosting->countries->pluck('id')->toArray()) ? 'selected' : '' }}>
                                {{ $country->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('countries')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="genres" class="form-label">Thể loại công việc</label>
                    <select id="genres" name="genres[]" class="form-select" multiple>
                        @foreach ($genres as $genre)
                            <option value="{{ $genre->id }}"
                                {{ in_array($genre->id, $jobPosting->genres->pluck('id')->toArray()) ? 'selected' : '' }}>
                                {{ $genre->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('genres')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Trạng thái</label>
                    <select id="status" name="status" class="form-select" required>
                        <option value="active" {{ $jobPosting->status == 'active' ? 'selected' : '' }}>
                            Đang hoạt động
                        </option>
                        <option value="inactive" {{ $jobPosting->status == 'inactive' ? 'selected' : '' }}>
                            Tạm ngưng
                        </option>
                        <option value="pending" {{ $jobPosting->status == 'pending' ? 'selected' : '' }}>
                            Chờ duyệt
                        </option>
                        <option value="rejected" {{ $jobPosting->status == 'rejected' ? 'selected' : '' }}>
                            Từ chối
                        </option>
                    </select>
                    @error('status')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="title" class="form-label">Email công ty</label>
                    <input class="search-field" type="text" value="{{ $employer->email }}" readonly>
                </div>



                <div class="mb-3">
                    <label for="rejection_reason" class="form-label">Lý do từ chối (nếu có)</label>
                    <textarea id="rejection_reason" name="rejection_reason" class="form-control" rows="3">{{ old('rejection_reason', $jobPosting->rejection_reason) }}</textarea>
                    @error('rejection_reason')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Cập nhật bài đăng</button>
                    <a href="{{ route('manage.employers.show', $employer->id) }}" class="btn btn-secondary">Quay lại</a>
                </div>
            </form>
        </div>
    </div>

    <style>
        .form-actions {
            margin-top: 20px;
            display: flex;
            gap: 10px;
        }

        .btn {
            padding: 8px 16px;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn-primary {
            background-color: #007bff;
            color: white;
            border: none;
        }

        .btn-secondary {
            background-color: #6c757d;
            color: white;
            text-decoration: none;
            border: none;
        }

        .btn:hover {
            opacity: 0.9;
        }

        .status-active {
            color: #28a745;
        }

        .status-inactive {
            color: #dc3545;
        }

        .status-pending {
            color: #ffc107;
        }

        .status-rejected {
            color: #6c757d;
        }
    </style>

    <script>
        // Show/hide rejection reason based on status
        document.getElementById('status').addEventListener('change', function() {
            const rejectionReasonField = document.getElementById('rejection_reason').closest('.mb-3');
            if (this.value === 'rejected') {
                rejectionReasonField.style.display = 'block';
            } else {
                rejectionReasonField.style.display = 'none';
            }
        });

        // Initialize on page load
        window.addEventListener('load', function() {
            const status = document.getElementById('status').value;
            const rejectionReasonField = document.getElementById('rejection_reason').closest('.mb-3');
            rejectionReasonField.style.display = status === 'rejected' ? 'block' : 'none';
        });
    </script>
@endsection
