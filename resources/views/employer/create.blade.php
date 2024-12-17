 @extends('layout')
 @section('content')
     <style>
         * {
             margin: 0;
             padding: 0;
             box-sizing: border-box;
             font-family: Arial, sans-serif;
         }

         .container {
             display: flex;
             min-height: 100vh;
         }

         .sidebar {
             width: 250px;
             background: #fff;
             padding: 20px;
             border-right: 1px solid #eee;
         }

         .main-content {
             flex: 1;
             padding: 20px;
             background: #f8f9fa;
         }

         .menu-item {
             display: flex;
             align-items: center;
             padding: 10px;
             margin: 5px 0;
             cursor: pointer;
             color: #333;
             text-decoration: none;
         }

         .menu-item i {
             margin-right: 10px;
             color: #ff0000;
         }

         .menu-section {
             margin: 15px 0;
         }

         .menu-title {
             font-weight: bold;
             margin: 10px 0;
             color: #333;
         }

         .top-bar {
             display: flex;
             justify-content: space-between;
             align-items: center;
             margin-bottom: 20px;
         }

         .add-campaign-btn {
             background: #ff0000;
             color: white;
             border: none;
             padding: 10px 20px;
             border-radius: 4px;
             cursor: pointer;
         }

         .search-section {
             display: flex;
             gap: 10px;
             margin-bottom: 20px;
         }

         .campaign-select {
             padding: 8px;
             border: 1px solid #ddd;
             border-radius: 4px;
             min-width: 200px;
         }

         .search-input {
             flex: 1;
             padding: 8px;
             border: 1px solid #ddd;
             border-radius: 4px;
         }

         .campaign-grid {
             display: grid;
             grid-template-columns: repeat(6, 1fr);
             gap: 10px;
             background: white;
             padding: 15px;
             border-radius: 4px;
             border: 1px solid #ddd;
         }

         .campaign-cell {
             padding: 15px;
             border-right: 1px solid #eee;
         }

         .campaign-cell:last-child {
             border-right: none;
         }

         .campaign-header {
             font-weight: bold;
             margin-bottom: 10px;
         }

         .campaign-toggle {
             display: flex;
             align-items: center;
             gap: 10px;
             margin: 10px 0;
         }

         .toggle-switch {
             position: relative;
             display: inline-block;
             width: 50px;
             height: 24px;
         }

         .toggle-switch input {
             opacity: 0;
             width: 0;
             height: 0;
         }

         .toggle-slider {
             position: absolute;
             cursor: pointer;
             top: 0;
             left: 0;
             right: 0;
             bottom: 0;
             background-color: #ccc;
             transition: .4s;
             border-radius: 24px;
         }

         .toggle-slider:before {
             position: absolute;
             content: "";
             height: 16px;
             width: 16px;
             left: 4px;
             bottom: 4px;
             background-color: white;
             transition: .4s;
             border-radius: 50%;
         }

         input:checked+.toggle-slider {
             background-color: #ff0000;
         }

         input:checked+.toggle-slider:before {
             transform: translateX(26px);
         }

         .stat {
             color: #0066ff;
             font-weight: bold;
             font-size: 1.2em;
         }

         .action-btn {
             display: inline-block;
             padding: 6px 12px;
             border-radius: 4px;
             cursor: pointer;
             margin: 4px;
         }

         .primary-btn {
             background: #ff0000;
             color: white;
             border: none;
         }

         .outline-btn {
             border: 1px solid #ff0000;
             color: #ff0000;
             background: white;
         }

         @media (max-width: 1200px) {
             .campaign-grid {
                 grid-template-columns: repeat(3, 1fr);
             }

             .campaign-cell {
                 border-bottom: 1px solid #eee;
             }
         }

         @media (max-width: 768px) {
             .container {
                 flex-direction: column;
             }

             .sidebar {
                 width: 100%;
                 border-right: none;
                 border-bottom: 1px solid #eee;
             }

             .search-section {
                 flex-direction: column;
             }

             .campaign-grid {
                 grid-template-columns: 1fr;
             }

             .campaign-cell {
                 border-right: none;
             }
         }
     </style>
     <div class="container">
         <div class="sidebar">
             <div class="menu-section">
                 <div class="menu-title">Quản lý đăng tuyển dụng</div>
                 <a href="#" class="menu-item">
                     <i>+</i>
                     <span>Tạo tin tuyển dụng</span>
                 </a>
                 <a href="#" class="menu-item">
                     <i>📋</i>
                     <span>Quản lý tin đăng</span>
                 </a>
                 <a href="#" class="menu-item">
                     <i>📊</i>
                     <span>Chiến dịch tuyển dụng</span>
                 </a>
             </div>

             <div class="menu-section">
                 <div class="menu-title">Quản lý ứng viên</div>
                 <a href="#" class="menu-item">
                     <i>👥</i>
                     <span>Hồ sơ ứng tuyển</span>
                 </a>
                 <a href="#" class="menu-item">
                     <i>📄</i>
                     <span>Quản lý thẻ</span>
                 </a>
                 <a href="#" class="menu-item">
                     <i>❤️</i>
                     <span>Hồ sơ đã lưu</span>
                 </a>
                 <a href="#" class="menu-item">
                     <i>🔍</i>
                     <span>Tìm ứng viên mới</span>
                 </a>
             </div>
         </div>

         <div class="main-content">
             <div class="container">
                 <h1 class="mb-4">Tạo bài đăng tuyển dụng</h1>
                 <form action="{{ route('employer.job-posting.create') }}" method="POST">
                     @csrf
                     <div class="mb-3">
                        <label for="title" class="form-label">Your Email</label>
                         <input class="search-field" type="text" name="email" value="{{ $employer->email }}" readonly>
                     </div>
                     <!-- Title -->
                     <div class="mb-3">
                         <label for="title" class="form-label">Tiêu đề</label>
                         <input type="text" id="title" name="title" class="form-control"
                             value="{{ old('title') }}" required>
                         @error('title')
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
                         <input type="text" id="age_range" name="age_range" class="form-control"
                             value="{{ old('age_range') }}">
                         @error('age_range')
                             <span class="text-danger">{{ $message }}</span>
                         @enderror
                     </div>

                     <!-- Location -->
                     <div class="mb-3">
                         <label for="location" class="form-label">Địa điểm</label>
                         <input type="text" id="location" name="location" class="form-control"
                             value="{{ old('location') }}">
                         @error('location')
                             <span class="text-danger">{{ $message }}</span>
                         @enderror
                     </div>

                     <!-- Description -->
                     <div class="mb-3">
                         <label for="description" class="form-label">Mô tả công việc</label>
                         <textarea id="description" name="description" class="form-control" rows="4" required>{{ old('description') }}</textarea>
                         @error('description')
                             <span class="text-danger">{{ $message }}</span>
                         @enderror
                     </div>

                     <!-- Application Email -->
                     <div class="mb-3">
                         <label for="application_email_url" class="form-label">Email ứng tuyển</label>
                         <input type="email" id="application_email_url" name="application_email_url" class="form-control"
                             value="{{ old('application_email_url') }}" required>
                         @error('application_email_url')
                             <span class="text-danger">{{ $message }}</span>
                         @enderror
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
                         <input type="text" id="salary" name="salary" class="form-control"
                             value="{{ old('salary') }}">
                         @error('salary')
                             <span class="text-danger">{{ $message }}</span>
                         @enderror
                     </div>

                     <!-- Categories -->
                     <div class="mb-3">
                         <label for="categories" class="form-label">Danh mục</label>
                         <select id="categories" name="categories[]" class="form-select" multiple>
                             @foreach ($categories as $category)
                                 <option value="{{ $category->id }}">{{ $category->name }}</option>
                             @endforeach
                         </select>
                         @error('categories')
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
                 </form>
             </div>

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
