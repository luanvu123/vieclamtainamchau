 @extends('layout')
 @section('content')
     <div class="container">
         <div class="sidebar">
             <div class="menu-title">Quản lý đăng tuyển dụng</div>
             <div class="menu-section">

                 <a href="{{ route('employer.job-posting.create.form') }}" class="menu-item">
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
             <h1>Tài khoản nhà tuyển dụng</h1>

             <div class="tabs">
                 <div class="tab active" data-tab="account">Thông tin tài khoản</div>
                 <div class="tab" data-tab="company">Thông tin công ty</div>
             </div>
             <div class="tab-content" id="accountTab">
                 <form action="{{ route('employer.profile.updateInfo') }}" method="POST" enctype="multipart/form-data">
                     @csrf
                     <div class="form-section">
                         <h2>Thông tin đăng nhập</h2>

                         <div class="avatar-section">
                             <div class="avatar-container">
                                 @if ($employer->avatar)
                                     <img src="{{ asset('storage/' . $employer->avatar) }}" alt="Avatar">
                                 @else
                                     <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                         <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                         <circle cx="12" cy="7" r="4"></circle>
                                     </svg>
                                 @endif
                             </div>

                             <input type="file" name="avatar" class="upload-btn">
                         </div>

                         <div class="form-group">
                             <label>Họ và tên</label>
                             <input type="text" name="name" value="{{ old('name', $employer->name) }}" required>
                         </div>

                         <div class="form-group">
                             <label>Số điện thoại</label>
                             <input type="tel" name="phone" value="{{ old('phone', $employer->phone) }}">
                         </div>

                         <div class="form-group">
                             <label>Địa chỉ liên hệ</label>
                             <textarea name="address" rows="3">{{ old('address', $employer->address) }}</textarea>
                         </div>

                         <div class="form-group">
                             <label>Mật khẩu mới</label>
                             <input type="password" name="password">
                         </div>

                         <div class="form-group">
                             <label>Xác nhận mật khẩu</label>
                             <input type="password" name="password_confirmation">
                         </div>

                         <button class="update-btn" type="submit">Cập nhật</button>
                     </div>
                 </form>
             </div>

             <div class="tab-content" id="companyTab" style="display: none;">
                 <form action="{{ route('employer.updateCompany') }}" method="POST" enctype="multipart/form-data">
                     @csrf
                     @method('PUT')
                     <div class="form-section">
                         <h2>Thông tin công ty</h2>

                         <div class="form-group">
                             <label>Mã số thuế</label>
                             <input type="text" name="mst" value="{{ old('mst', $employer->mst) }}">
                         </div>

                         <div class="form-group">
                             <label>Tên công ty</label>
                             <input type="text" name="company_name" placeholder="Tên công ty"
                                 value="{{ old('company_name', $employer->company_name) }}">
                         </div>

                         <div class="form-group">
                             <label>Quy mô nhân sự</label>
                             <select name="scale">
                                 <option value="">Chọn</option>
                                 <option value="Dưới 50 người"
                                     {{ old('scale', $employer->scale) == 'Dưới 50 người' ? 'selected' : '' }}>Dưới 50 người
                                 </option>
                                 <option value="50-100 người"
                                     {{ old('scale', $employer->scale) == '50-100 người' ? 'selected' : '' }}>50-100 người
                                 </option>
                                 <option value="100-500 người"
                                     {{ old('scale', $employer->scale) == '100-500 người' ? 'selected' : '' }}>100-500
                                     người
                                 </option>
                                 <option value="Trên 500 người"
                                     {{ old('scale', $employer->scale) == 'Trên 500 người' ? 'selected' : '' }}>Trên 500
                                     người
                                 </option>
                             </select>
                         </div>

                         <div class="form-group">
                             <label>Bản đồ</label>
                             <input type="text" name="map" placeholder="Đường dẫn Google Map"
                                 value="{{ old('map', $employer->map) }}">
                         </div>

                         <div class="form-group">
                             <label>Lĩnh vực hoạt động</label>
                             <select id="categories" name="categories[]" multiple>
                                 @foreach ($categories as $category)
                                     <option value="{{ $category->id }}"
                                         {{ in_array($category->id, $employer->categories->pluck('id')->toArray()) ? 'selected' : '' }}>
                                         {{ $category->name }}
                                     </option>
                                 @endforeach
                             </select>
                         </div>

                         <div class="form-group">
                             <label>Danh mục</label>
                             <select name="genres[]" id="genres"class="form-select" multiple>
                                 @foreach ($genres as $genre)
                                     <option value="{{ $genre->id }}"
                                         {{ in_array($genre->id, $employer->genres->pluck('id')->toArray()) ? 'selected' : '' }}>
                                         {{ $genre->name }}
                                     </option>
                                 @endforeach
                             </select>
                         </div>
                         <div class="business-license">
                             <h2>Giấy phép kinh doanh</h2>
                             <p>Để chứng thực tài khoản Quý khách đang sử dụng trên Việc Làm 24h, vui lòng đăng tải giấy
                                 phép đăng ký kinh doanh.</p>

                             <div class="upload-file">
                                 <label for="business_license" class="form-label">Tải lên giấy phép kinh doanh</label>
                                 <input type="file" name="business_license" id="business_license"
                                     class="form-control">
                                 <span>(Dạng file: .docx, .doc, .pdf, kích thước tối đa 10 MB)</span>
                                 @if ($employer->business_license)
                                     <p>Giấy phép hiện tại:
                                         <a href="{{ asset('storage/' . $employer->business_license) }}" target="_blank">
                                             Xem tệp
                                         </a>
                                     </p>
                                 @endif

                             </div>

                             <div class="license-note">
                                 <h3>Giấy phép kinh doanh hợp lệ</h3>
                                 <ul>
                                     <li>Có dấu giáp lai của cơ quan có thẩm quyền.</li>
                                     <li>Trường hợp giấy phép kinh doanh là bản photo thì phải có dấu công chứng.</li>
                                 </ul>
                             </div>
                         </div>

                         <button class="update-btn" type="submit">Cập nhật</button>
                     </div>
                 </form>
             </div>
         </div>
     </div>

     <script>
         document.addEventListener('DOMContentLoaded', function() {
             const tabs = document.querySelectorAll('.tab');
             const tabContents = document.querySelectorAll('.tab-content');

             tabs.forEach(tab => {
                 tab.addEventListener('click', () => {
                     // Remove active class from all tabs
                     tabs.forEach(t => t.classList.remove('active'));

                     // Add active class to clicked tab
                     tab.classList.add('active');

                     // Hide all tab contents
                     tabContents.forEach(content => content.style.display = 'none');

                     // Show selected tab content
                     const tabName = tab.getAttribute('data-tab');
                     document.getElementById(tabName + 'Tab').style.display = 'block';
                 });
             });

             // File upload handling
             const fileButton = document.querySelector('.upload-file button');
             if (fileButton) {
                 fileButton.addEventListener('click', () => {
                     const input = document.createElement('input');
                     input.type = 'file';
                     input.accept = '.doc,.docx,.pdf';
                     input.click();

                     input.addEventListener('change', (e) => {
                         const file = e.target.files[0];
                         if (file) {
                             // Handle file upload logic here
                             console.log('Selected file:', file.name);
                         }
                     });
                 });
             }
         });
     </script>
 @endsection
