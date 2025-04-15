 @extends('layouts.manage')
 @section('content')
     <style>
         .img-thumbnail {
             object-fit: cover;
             width: 100%;
             /* Full width of the container */
             height: 150px;
             /* Fixed height for uniformity */
             border-radius: 10px;
             /* Optional: rounded corners */
         }

         /* Phone input wrapper */
         .phone-verify-wrapper {
             display: flex;
             align-items: center;
             gap: 10px;
         }

         .phone-input {
             flex: 1;
         }

         /* Verify button */
         .verify-btn {
             padding: 8px 16px;
             background-color: #2563eb;
             color: white;
             border: none;
             border-radius: 4px;
             cursor: pointer;
             display: flex;
             align-items: center;
             gap: 6px;
             transition: all 0.2s ease;
         }

         .verify-btn:hover {
             background-color: #1d4ed8;
         }

         /* Verify badge */
         .verify-badge {
             display: flex;
             align-items: center;
             gap: 6px;
             color: #059669;
             font-size: 14px;
             padding: 6px 12px;
             background-color: #d1fae5;
             border-radius: 4px;
         }

         .verify-badge i {
             color: #059669;
         }

         /* Modal styles */
         .modal {
             display: none;
             position: fixed;
             top: 0;
             left: 0;
             width: 100%;
             height: 100%;
             background-color: rgba(0, 0, 0, 0.5);
             z-index: 1000;
         }

         .modal-content {
             position: relative;
             background-color: #fff;
             margin: 10% auto;
             padding: 20px;
             width: 90%;
             max-width: 500px;
             border-radius: 8px;
             box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
         }

         .close-modal {
             position: absolute;
             right: 20px;
             top: 15px;
             font-size: 24px;
             cursor: pointer;
             color: #666;
         }

         .close-modal:hover {
             color: #000;
         }

         .modal-body {
             text-align: center;
         }

         .modal-body h3 {
             margin-bottom: 20px;
             color: #1f2937;
         }

         .qr-code {
             margin: 20px 0;
         }

         .qr-code img {
             max-width: 200px;
             height: auto;
         }

         .verify-instruction {
             padding: 15px;
             background-color: #f3f4f6;
             border-radius: 4px;
             margin-top: 20px;
         }

         .verify-instruction p {
             color: #4b5563;
             line-height: 1.5;
         }

         .row {
             display: flex;
             flex-wrap: wrap;
             gap: 15px;
             /* Space between columns */
         }

         .col-md-3 {
             flex: 1 1 calc(25% - 15px);
             /* Adjust for 4 columns */
             max-width: calc(25% - 15px);
             box-sizing: border-box;
         }
     </style>

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

                         <!-- Trong form group phone -->
                         <div class="form-group">
                             <label>Số điện thoại</label>
                             <div class="phone-verify-wrapper">
                                 <input type="tel" name="phone" value="{{ old('phone', $employer->phone) }}"
                                     class="phone-input {{ $employer->isVerifyCompany == 1 ? 'verified' : '' }}"
                                     {{ $employer->isVerifyCompany == 1 ? 'readonly' : '' }}>
                                 @if ($employer->isVerifyCompany == 1)
                                     <span class="verify-badge">
                                         <i class="fas fa-check-circle"></i> Đã xác thực
                                     </span>
                                 @else
                                     <button type="button" class="verify-btn" onclick="openVerifyModal()">
                                         <i class="fas fa-shield-alt"></i> Xác thực
                                     </button>
                                 @endif
                             </div>
                         </div>

                         <!-- Modal QR Code -->
                         <div id="verifyModal" class="modal">
                             <div class="modal-content">
                                 <span class="close-modal">&times;</span>
                                 <div class="modal-body">
                                     <h3>Xác thực công ty</h3>
                                     <div class="qr-code">
                                         <img src="{{ asset('frontend/QR zalo.jpg') }}" alt="QR Code Zalo">
                                     </div>
                                     <div class="verify-instruction">
                                         <p>Vui lòng ghi rõ tên công ty số điện thoại và mã số thuế qua mã zalo hoặc liên
                                             hệ: 0846565815</p>
                                     </div>
                                 </div>
                             </div>
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
                                     {{ old('scale', $employer->scale) == 'Dưới 50 người' ? 'selected' : '' }}>Dưới 50
                                     người
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
                             <label for="gallery_images">Hình ảnh gallery</label>
                             <input type="file" name="gallery_images[]" multiple accept="image/*">
                         </div>

                         <!-- Hiển thị hình ảnh gallery hiện tại -->
                         @if ($employer->gallery->isNotEmpty())
                             <div class="form-group">
                                 <label>Hình ảnh hiện tại</label>
                                 <div class="row">
                                     @foreach ($employer->gallery as $image)
                                         <div class="col-md-3 text-center">
                                             <img src="{{ asset('storage/' . $image->image_path) }}"
                                                 class="img-thumbnail mb-2" alt="Gallery Image">
                                             <p>{{ $image->caption }}</p>
                                             <input type="checkbox" name="delete_gallery[]" value="{{ $image->id }}">
                                             Xóa
                                         </div>
                                     @endforeach
                                 </div>
                             </div>
                         @endif




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

     <script>
         // Hàm mở modal
         function openVerifyModal() {
             document.getElementById('verifyModal').style.display = 'block';
         }

         // Hàm đóng modal
         function closeVerifyModal() {
             document.getElementById('verifyModal').style.display = 'none';
         }

         // Thêm event listeners
         document.querySelector('.close-modal').addEventListener('click', closeVerifyModal);

         // Đóng modal khi click bên ngoài
         window.addEventListener('click', function(event) {
             const modal = document.getElementById('verifyModal');
             if (event.target === modal) {
                 closeVerifyModal();
             }
         });

         // Ngăn chặn việc đóng modal khi click vào nội dung modal
         document.querySelector('.modal-content').addEventListener('click', function(event) {
             event.stopPropagation();
         });
     </script>
 @endsection
