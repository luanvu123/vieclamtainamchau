 @extends('layouts.manage')
 @section('content')


         <div class="main-content">
             <h1 class="mb-4">Chỉnh sửa bài đăng tuyển dụng</h1>
             <div class="container">
                 <form action="{{ route('employer.job-posting.update', $jobPosting->id) }}" method="POST">
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
                             <option value="Không yêu cầu"
                                 {{ $jobPosting->experience == 'Không yêu cầu' ? 'selected' : '' }}>
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
                         <label for="categories" class="form-label">Ngành nghề</label>
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

                     <button type="submit" class="btn btn-primary">Cập nhật bài đăng</button>
                 </form>
             </div>
         </div>





     <script>
         document.addEventListener('DOMContentLoaded', () => {
             // Toggle switch functionality
             const toggleSwitch = document.querySelector('input[type="checkbox"]');
             toggleSwitch.addEventListener('change', function() {
                 // Handle campaign status toggle
                 console.log('Campaign status:', this.checked ? 'active' : 'inactive');
             });

             // Search functionality
             const searchInput = document.querySelector('.search-input');
             searchInput.addEventListener('keypress', function(e) {
                 if (e.key === 'Enter') {
                     // Handle search
                     console.log('Searching for:', this.value);
                 }
             });

             // Campaign filter functionality
             const campaignSelect = document.querySelector('.campaign-select');
             campaignSelect.addEventListener('change', function() {
                 // Handle filter change
                 console.log('Filter changed to:', this.value);
             });
         });
     </script>
 @endsection
