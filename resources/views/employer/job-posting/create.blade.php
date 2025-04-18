@extends('layouts.manage')
@section('content')

    <div class="main-content">
        <h1 class="mb-4">Tạo bài đăng tuyển dụng</h1>
        <div class="container">
            <form action="{{ route('employer.job-posting.store') }}" method="POST">
                @csrf
                @if ($basicServiceDetails->count() || $hotServiceDetails->count())
                    <div class="alert alert-success">
                        <h5>Bạn có gói còn hiệu lực:</h5>
                        <ul>
                            @foreach ($basicServiceDetails as $detail)
                                <li>
                                    <strong>Tin cơ bản</strong> - Hết hạn:
                                    <strong>{{ \Carbon\Carbon::parse($detail->expiring_date)->format('d/m/Y') }}</strong> -
                                    Số lượt sử dụng còn lại: <strong>{{ $detail->number_of_active }}</strong>
                                </li>
                            @endforeach
                            @foreach ($hotServiceDetails as $detail)
                                <li>
                                    <strong>Tin nổi bật</strong> - Hết hạn:
                                    <strong>{{ \Carbon\Carbon::parse($detail->expiring_date)->format('d/m/Y') }}</strong> -
                                    Số lượt sử dụng còn lại: <strong>{{ $detail->number_of_active }}</strong>
                                </li>
                            @endforeach
                            @foreach ($specialServiceDetails as $detail)
                                <li>
                                    <strong>Tin đặc biệt</strong> - Hết hạn:
                                    <strong>{{ \Carbon\Carbon::parse($detail->expiring_date)->format('d/m/Y') }}</strong> -
                                    Số lượt sử dụng còn lại: <strong>{{ $detail->number_of_active }}</strong>
                                </li>
                            @endforeach

                        </ul>

                        {{-- Radio chọn gói sử dụng --}}
                        <div class="mt-3">
                            <label><strong>Chọn loại tin đăng:</strong></label><br>
                            @if ($basicServiceDetails->count())
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="service_type" id="basic_service"
                                        value="Tin cơ bản" required>
                                    <label class="form-check-label" for="basic_service">Tin cơ bản</label>
                                </div>
                            @endif
                            @if ($hotServiceDetails->count())
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="service_type" id="hot_service"
                                        value="Tin nổi bật" required>
                                    <label class="form-check-label" for="hot_service">Tin nổi bật</label>
                                </div>
                            @endif
                            @if ($specialServiceDetails->count())
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="service_type" id="special_service"
                                        value="Tin đặc biệt" required>
                                    <label class="form-check-label" for="special_service">Tin đặc biệt</label>
                                </div>
                            @endif

                            @error('service_type')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <!-- Title -->
                    <div class="mb-3">
                        <label for="title" class="form-label">Tiêu đề</label>
                        <input type="text" id="title" name="title" class="form-control" value="{{ old('title') }}" required>
                        @error('title')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- Categories -->
                    <div class="mb-3">
                        <label for="categories" class="form-label">Chọn ngành nghề và Du học nghề</label>
                        <select id="categories" name="categories[]" class="form-select" multiple>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('categories')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- Genres -->
                    <div class="mb-3">
                        <label for="genres" class="form-label">Chọn danh mục Xuất khẩu lao động</label>
                        <select id="genres" name="genres[]" class="form-select" multiple>
                            @foreach ($genres as $genre)
                                <option value="{{ $genre->id }}">{{ $genre->name }}</option>
                            @endforeach
                        </select>
                        @error('genres')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>



                    <!-- Type -->
                    <div class="mb-3">
                        <label for="type" class="form-label">Loại công việc</label>
                        <select id="type" name="type" class="form-select" required>
                            <option value="fulltime">Fulltime</option>
                            <option value="parttime">Parttime</option>
                            <option value="intern">Thực tập</option>
                            <option value="freelance">Freelance</option>
                        </select>
                        @error('type')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Age Range -->
                    <div class="mb-3">
                        <label for="age_range" class="form-label">Độ tuổi</label>
                        <input type="text" id="age_range" name="age_range" class="form-control" value="{{ old('age_range') }}">
                        @error('age_range')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Location -->
                    <div class="mb-3">
                        <label for="location" class="form-label">Địa điểm</label>
                        <input type="text" id="location" name="location" class="form-control" value="{{ old('location') }}">
                        @error('location')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="experience" class="form-label">Kinh nghiệm yêu cầu</label>
                        <select id="experience" name="experience"
                            class="form-control @error('experience') is-invalid @enderror">
                            <option value="" disabled selected>Chọn kinh nghiệm</option>
                            <option value="Không yêu cầu" {{ old('experience') == 'Không yêu cầu' ? 'selected' : '' }}>
                                Không yêu cầu</option>
                            <option value="1 năm" {{ old('experience') == '1 năm' ? 'selected' : '' }}>1 năm</option>
                            <option value="2 năm" {{ old('experience') == '2 năm' ? 'selected' : '' }}>2 năm</option>
                            <option value="3 năm" {{ old('experience') == '3 năm' ? 'selected' : '' }}>3 năm</option>
                            <option value="4 năm" {{ old('experience') == '4 năm' ? 'selected' : '' }}>4 năm</option>
                            <option value="5 năm" {{ old('experience') == '5 năm' ? 'selected' : '' }}>5 năm</option>
                            <option value="5+ năm" {{ old('experience') == '5+ năm' ? 'selected' : '' }}>5+ năm</option>
                        </select>
                        @error('experience')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- Rank -->
                    <div class="mb-3">
                        <label for="rank" class="form-label">Cấp bậc</label>
                        <select id="rank" name="rank" class="form-control @error('rank') is-invalid @enderror">
                            <option value="" disabled selected>Chọn cấp bậc</option>
                            <option value="Nhân viên" {{ old('rank') == 'Nhân viên' ? 'selected' : '' }}>Nhân viên
                            </option>
                            <option value="Thực tập sinh" {{ old('rank') == 'Thực tập sinh' ? 'selected' : '' }}>Thực tập
                                sinh</option>
                            <option value="Quản lý" {{ old('rank') == 'Quản lý' ? 'selected' : '' }}>Quản lý</option>
                            <option value="Khác" {{ old('rank') == 'Khác' ? 'selected' : '' }}>Khác</option>
                        </select>
                        @error('rank')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Number of Recruits -->
                    <div class="mb-3">
                        <label for="number_of_recruits" class="form-label">Số lượng tuyển dụng</label>
                        <input type="number" id="number_of_recruits" name="number_of_recruits"
                            class="form-control @error('number_of_recruits') is-invalid @enderror"
                            value="{{ old('number_of_recruits') }}" min="1">
                        @error('number_of_recruits')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Sex -->
                    <div class="mb-3">
                        <label for="sex" class="form-label">Giới tính</label>
                        <select id="sex" name="sex" class="form-control @error('sex') is-invalid @enderror">
                            <option value="" disabled selected>Chọn giới tính</option>
                            <option value="Nam" {{ old('sex') == 'Nam' ? 'selected' : '' }}>Nam</option>
                            <option value="Nữ" {{ old('sex') == 'Nữ' ? 'selected' : '' }}>Nữ</option>
                            <option value="Không yêu cầu" {{ old('sex') == 'Không yêu cầu' ? 'selected' : '' }}>Không yêu
                                cầu</option>
                        </select>
                        @error('sex')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Skills Required -->
                    <div class="mb-3">
                        <label for="skills_required" class="form-label">Kỹ năng yêu cầu</label>
                        <input type="text" id="skills_required" name="skills_required"
                            class="form-control @error('skills_required') is-invalid @enderror"
                            value="{{ old('skills_required') }}">
                        @error('skills_required')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>


                    <!-- Description -->
                    <div class="mb-3">
                        <label for="description" class="form-label">Mô tả công việc</label>
                        <textarea id="description" name="description" class="form-control" rows="4"
                            required>{{ old('description') }}</textarea>
                        @error('description')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Application Email -->
                    <div class="mb-3">
                        <label for="title" class="form-label">Email nhận hồ sơ</label>
                        <input class="search-field" type="text" name="email" value="{{ $employer->email }}" readonly>
                    </div>

                    <!-- Closing Date -->
                    <div class="mb-3">
                        <label for="closing_date" class="form-label">Hạn chót</label>
                        <input type="date" id="closing_date" name="closing_date" class="form-control"
                            value="{{ old('closing_date') }}">
                        @error('closing_date')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Salary -->
                    <div class="mb-3">
                        <label for="salary" class="form-label">Mức lương</label>
                        <input type="text" id="salary" name="salary" class="form-control" value="{{ old('salary') }}">
                        @error('salary')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>



                    <!-- Countries -->
                    <div class="mb-3">
                        <label for="countries" class="form-label">Quốc gia</label>
                        <select id="countries" name="countries[]" class="form-select" multiple>
                            @foreach ($countries as $country)
                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                            @endforeach
                        </select>
                        @error('countries')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>





                    <button type="submit" class="btn btn-primary">Lưu bài đăng</button>
                @else
                    <div class="alert alert-warning">
                        Bạn chưa có gói "Tin cơ bản" còn hiệu lực. Vui lòng mua dịch vụ để đăng tin tuyển dụng.
                    </div>
                @endif

            </form>
        </div>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Toggle switch functionality
            const toggleSwitch = document.querySelector('input[type="checkbox"]');
            toggleSwitch.addEventListener('change', function () {
                // Handle campaign status toggle
                console.log('Campaign status:', this.checked ? 'active' : 'inactive');
            });

            // Search functionality
            const searchInput = document.querySelector('.search-input');
            searchInput.addEventListener('keypress', function (e) {
                if (e.key === 'Enter') {
                    // Handle search
                    console.log('Searching for:', this.value);
                }
            });

            // Campaign filter functionality
            const campaignSelect = document.querySelector('.campaign-select');
            campaignSelect.addEventListener('change', function () {
                // Handle filter change
                console.log('Filter changed to:', this.value);
            });
        });
    </script>
@endsection
