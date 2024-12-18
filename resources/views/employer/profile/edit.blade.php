 @extends('layout')
 @section('content')
     <style>
         * {
             margin: 0;
             padding: 0;
             box-sizing: border-box;
             font-family: system-ui, -apple-system, sans-serif;
         }

         body {
             background: #f5f5f5;
             padding: 20px;
         }

         .container {
             max-width: 800px;
             margin: 0 auto;
             background: white;
             padding: 30px;
             border-radius: 8px;
             box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
         }

         h1 {
             font-size: 24px;
             margin-bottom: 30px;
             color: #333;
         }

         .tabs {
             display: flex;
             border-bottom: 1px solid #ddd;
             margin-bottom: 30px;
         }

         .tab {
             padding: 10px 20px;
             cursor: pointer;
             border-bottom: 2px solid transparent;
         }

         .tab.active {
             color: #ff0000;
             border-bottom: 2px solid #ff0000;
         }

         .form-section {
             margin-bottom: 30px;
         }

         .form-section h2 {
             font-size: 18px;
             margin-bottom: 20px;
             color: #333;
         }

         .form-group {
             margin-bottom: 20px;
         }

         .form-group label {
             display: block;
             margin-bottom: 8px;
             color: #555;
         }

         .form-group input,
         .form-group select,
         .form-group textarea {
             width: 100%;
             padding: 10px;
             border: 1px solid #ddd;
             border-radius: 4px;
             font-size: 14px;
         }

         .avatar-section {
             display: flex;
             align-items: center;
             gap: 20px;
             margin-bottom: 30px;
         }

         .avatar {
             width: 100px;
             height: 100px;
             background: #6c5ce7;
             border-radius: 50%;
             display: flex;
             align-items: center;
             justify-content: center;
             color: white;
         }

         .upload-btn {
             color: #ff0000;
             text-decoration: underline;
             cursor: pointer;
         }

         .upload-note {
             font-size: 12px;
             color: #666;
         }

         .add-phone {
             color: #ff0000;
             text-decoration: none;
             font-size: 14px;
             display: inline-block;
             margin-top: 8px;
             cursor: pointer;
         }

         .update-btn {
             background: #ff0000;
             color: white;
             border: none;
             padding: 12px 24px;
             border-radius: 4px;
             cursor: pointer;
             font-size: 14px;
         }

         .update-btn:hover {
             background: #e60000;
         }

         .login-alert {
             margin-top: 30px;
             padding: 20px;
             background: #f8f9fa;
             border-radius: 4px;
         }

         .radio-group {
             display: flex;
             gap: 20px;
         }

         .radio-item {
             display: flex;
             align-items: center;
             gap: 8px;
         }

         .business-license {
             margin-top: 30px;
         }

         .upload-file {
             border: 1px dashed #ddd;
             padding: 20px;
             border-radius: 4px;
             margin-top: 10px;
         }

         .upload-file button {
             background: white;
             border: 1px solid #ddd;
             padding: 8px 16px;
             border-radius: 4px;
             cursor: pointer;
         }

         .license-note {
             margin-top: 20px;
             font-size: 14px;
             color: #00bcd4;
         }

         .license-note ul {
             list-style: none;
             margin-top: 10px;
         }

         .license-note li {
             display: flex;
             align-items: center;
             gap: 8px;
             margin-bottom: 6px;
         }

         .license-note li:before {
             content: "✓";
             color: #00bcd4;
         }

         @media (max-width: 768px) {
             .container {
                 padding: 20px;
             }

             .avatar-section {
                 flex-direction: column;
                 align-items: flex-start;
             }
         }
     </style>
     <div class="container">
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
                         <div class="avatar">
                             @if ($employer->avatar)
                                 <img src="{{ asset('storage/' . $employer->avatar) }}" alt="Avatar">
                             @else
                                 <svg width="40" height="40" viewBox="0 0 24 24" fill="none"
                                     stroke="currentColor">
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
             <div class="form-section">
                 <h2>Thông tin công ty</h2>

                 <div class="form-group">
                     <label>Mã số thuế</label>
                     <input type="text">
                 </div>

                 <div class="form-group">
                     <label>Tên công ty</label>
                     <input type="text" placeholder="Tên công ty">
                 </div>

                 <div class="form-group">
                     <label>Quy mô nhân sự</label>
                     <select>
                         <option>Chọn</option>
                         <option>Dưới 50 người</option>
                         <option>50-100 người</option>
                         <option>100-500 người</option>
                         <option>Trên 500 người</option>
                     </select>
                 </div>

                 <div class="form-group">
                     <label>Địa điểm</label>
                     <select>
                         <option>TP. HCM</option>
                         <option>Hà Nội</option>
                         <option>Đà Nẵng</option>
                     </select>
                 </div>

                 <div class="form-group">
                     <label>Địa chỉ</label>
                     <input type="text">
                 </div>

                 <div class="form-group">
                     <label>Điện thoại cố định</label>
                     <input type="tel">
                 </div>

                 <div class="form-group">
                     <label>Lĩnh vực hoạt động</label>
                     <select>
                         <option>Chọn</option>
                         <option>Công nghệ thông tin</option>
                         <option>Tài chính - Ngân hàng</option>
                         <option>Giáo dục</option>
                     </select>
                 </div>

                 <button class="update-btn">Cập nhật</button>
             </div>

             <div class="business-license">
                 <h2>Giấy phép kinh doanh</h2>
                 <p>Để chứng thực tài khoản Quý khách đang sử dụng trên Việc Làm 24h, vui lòng đăng tải giấy phép đăng ký
                     kinh doanh.</p>

                 <div class="upload-file">
                     <button>Tải file</button>
                     <span>(Dạng file: docx, .doc, .pdf đăng tương = 10 MB)</span>
                 </div>

                 <div class="license-note">
                     <h3>Giấy phép kinh doanh hợp lệ</h3>
                     <ul>
                         <li>Có dấu giáp lai của cơ quan có thẩm quyền.</li>
                         <li>Trường hợp giấy phép kinh doanh là bản photo thì phải có dấu công chứng.</li>
                     </ul>
                 </div>

                 <button class="update-btn">Cập nhật</button>
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
