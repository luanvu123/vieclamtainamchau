 @extends('layout')
 @section('content')
    
     <div class="container">
         <div class="sidebar">
             <div class="menu-section">
                 <div class="menu-title">Quản lý đăng tuyển dụng</div>
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
             <div class="top-bar">
                 <h2>Quản lý chiến dịch</h2>
                 <button class="add-campaign-btn">+ Thêm chiến dịch mới</button>
             </div>

             <div class="search-section">
                 <select class="campaign-select">
                     <option>Tất cả chiến dịch</option>
                 </select>
                 <input type="text" class="search-input" placeholder="Tìm chiến dịch ( Nhấn enter để tìm kiếm )">
             </div>

             <div class="campaign-grid">
                 <div class="campaign-cell">
                     <div class="campaign-header">Chiến dịch tuyển dụng</div>
                     <div class="campaign-toggle">
                         <label class="toggle-switch">
                             <input type="checkbox" checked>
                             <span class="toggle-slider"></span>
                         </label>
                         <span>#132344</span>
                     </div>
                     <div>Nhân viên kinh doanh</div>
                     <div>Chưa có CV nào</div>
                 </div>

                 <div class="campaign-cell">
                     <div class="campaign-header">Tối ưu</div>
                     <div class="stat">24%</div>
                 </div>

                 <div class="campaign-cell">
                     <div class="campaign-header">Tin tuyển dụng</div>
                     <button class="action-btn primary-btn">Đăng tin</button>
                 </div>

                 <div class="campaign-cell">
                     <div class="campaign-header">Tin tuyển dụng</div>
                     <div>CV đề xuất</div>
                 </div>

                 <div class="campaign-cell">
                     <div class="campaign-header">Lọc CV</div>
                     <button class="action-btn outline-btn">Tìm CV</button>
                 </div>

                 <div class="campaign-cell">
                     <div class="campaign-header">Dịch vụ đang chạy</div>
                     <button class="action-btn outline-btn">Thêm</button>
                 </div>
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
