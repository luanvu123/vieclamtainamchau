<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CV Logistics Theme</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <style>
        :root {
            --primary: #003366;
            --secondary: #0066cc;
            --accent: #66a3ff;
            --light: #f0f5ff;
            --text: #333;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }

        body {
            background-color: #f5f5f5;
        }

        .container {
            width: 210mm;
            min-height: 297mm;
            margin: 20px auto;
            background: white;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        .cv-page {
            padding: 0;
            margin: 0;
            width: 100%;
            min-height: 297mm;
            display: grid;
            grid-template-columns: 35% 65%;
        }

        /* Left Sidebar */
        .sidebar {
            background-color: var(--primary);
            color: white;
            padding: 30px 20px;
            min-height: 297mm;
        }

        .profile-img-container {
            width: 150px;
            height: 150px;
            margin: 0 auto 20px;
            position: relative;
            border-radius: 50%;
            overflow: hidden;
            border: 4px solid var(--accent);
        }

        .profile-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .profile-img-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            opacity: 0;
            transition: 0.3s;
            cursor: pointer;
        }

        .profile-img-container:hover .profile-img-overlay {
            opacity: 1;
        }

        #image-upload {
            display: none;
        }

        .sidebar-section {
            margin-bottom: 25px;
        }

        .sidebar-title {
            color: var(--accent);
            font-size: 1.2em;
            margin-bottom: 10px;
            padding-bottom: 5px;
            border-bottom: 2px solid var(--accent);
        }

        /* Main Content */
        .main-content {
            padding: 30px;
            background: white;
        }

        .header {
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid var(--primary);
        }

        .name {
            color: var(--primary);
            font-size: 2em;
            margin-bottom: 5px;
        }

        .title {
            color: var(--secondary);
            font-size: 1.2em;
        }

        .section {
            margin-bottom: 25px;
        }

        .section-title {
            color: var(--primary);
            font-size: 1.3em;
            margin-bottom: 15px;
            padding-bottom: 5px;
            border-bottom: 2px solid var(--accent);
        }

        .experience-item {
            margin-bottom: 15px;
        }

        .experience-title {
            color: var(--secondary);
            font-weight: bold;
        }

        .editable {
            padding: 3px;
            border: 1px solid transparent;
            transition: all 0.3s;
            min-height: 20px;
        }

        .editable:hover {
            border-color: var(--accent);
            background-color: var(--light);
            cursor: text;
        }

        .controls {
            position: fixed;
            bottom: 20px;
            right: 20px;
            display: flex;
            gap: 10px;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            transition: all 0.3s;
        }

        .btn-primary {
            background-color: var(--primary);
            color: white;
        }

        .btn-secondary {
            background-color: var(--secondary);
            color: white;
        }

        @media print {
            .controls, .profile-img-overlay {
                display: none !important;
            }
            .container {
                margin: 0;
                box-shadow: none;
            }
            .cv-page {
                margin: 0;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="cv-page" id="cv-content">
            <div class="sidebar">
                <div class="profile-img-container">
                    <img src="/api/placeholder/150/150" alt="Profile" class="profile-img" id="profile-preview">
                    <div class="profile-img-overlay" onclick="document.getElementById('image-upload').click()">
                        <span>Click để tải ảnh</span>
                    </div>
                </div>
                <input type="file" id="image-upload" accept="image/*">

                <div class="sidebar-section">
                    <h2 class="sidebar-title">Thông Tin Liên Hệ</h2>
                    <div class="editable" data-field="contact">
                        📧 email@example.com<br>
                        📱 0123 456 789<br>
                        📍 Hà Nội, Việt Nam
                    </div>
                </div>

                <div class="sidebar-section">
                    <h2 class="sidebar-title">Kỹ Năng</h2>
                    <div class="editable" data-field="skills">
                        • Quản lý chuỗi cung ứng<br>
                        • Quản lý kho bãi<br>
                        • Tối ưu hóa vận chuyển<br>
                        • MS Office, SAP<br>
                        • Tiếng Anh thành thạo
                    </div>
                </div>

                <div class="sidebar-section">
                    <h2 class="sidebar-title">Chứng Chỉ</h2>
                    <div class="editable" data-field="certificates">
                        • FIATA Diploma<br>
                        • IATA Dangerous Goods<br>
                        • ISO 9001:2015 Lead Auditor
                    </div>
                </div>
            </div>

            <div class="main-content">
                <div class="header">
                    <h1 class="name editable" data-field="name">Nguyễn Văn A</h1>
                    <div class="title editable" data-field="title">Chuyên Viên Logistics</div>
                </div>

                <div class="section">
                    <h2 class="section-title">Giới Thiệu</h2>
                    <div class="editable" data-field="summary">
                        Chuyên viên Logistics với hơn 5 năm kinh nghiệm trong quản lý chuỗi cung ứng và vận tải quốc tế. Có khả năng tối ưu hóa quy trình vận chuyển, giảm chi phí và nâng cao hiệu quả hoạt động.
                    </div>
                </div>

                <div class="section">
                    <h2 class="section-title">Kinh Nghiệm</h2>
                    <div class="editable" data-field="experience">
                        <div class="experience-item">
                            <div class="experience-title">Trưởng phòng Logistics - Công ty ABC</div>
                            <div class="experience-date">2020 - Hiện tại</div>
                            <ul>
                                <li>Quản lý đội ngũ 20 nhân viên logistics</li>
                                <li>Tối ưu hóa chi phí vận chuyển giảm 25%</li>
                                <li>Xây dựng và triển khai hệ thống quản lý kho tự động</li>
                            </ul>
                        </div>
                        <div class="experience-item">
                            <div class="experience-title">Chuyên viên Logistics - Công ty XYZ</div>
                            <div class="experience-date">2018 - 2020</div>
                            <ul>
                                <li>Phụ trách vận tải quốc tế</li>
                                <li>Quản lý quan hệ với đối tác vận chuyển</li>
                                <li>Xử lý thủ tục hải quan</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="section">
                    <h2 class="section-title">Học Vấn</h2>
                    <div class="editable" data-field="education">
                        <div class="experience-item">
                            <div class="experience-title">Đại học Giao Thông Vận Tải</div>
                            <div class="experience-date">2014 - 2018</div>
                            <div>Cử nhân Logistics và Quản lý Chuỗi Cung ứng</div>
                            <ul>
                                <li>GPA: 3.8/4.0</li>
                                <li>Luận văn: Tối ưu hóa mạng lưới vận tải</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="controls">
        <button class="btn btn-primary" onclick="saveCV()">Lưu CV</button>
        <button class="btn btn-secondary" onclick="downloadPDF()">Tải PDF</button>
    </div>

    <script>
        // Xử lý tải ảnh
        document.getElementById('image-upload').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('profile-preview').src = e.target.result;
                    sessionStorage.setItem('profileImage', e.target.result);
                }
                reader.readAsDataURL(file);
            }
        });

        // Làm cho các phần tử có thể chỉnh sửa
        document.querySelectorAll('.editable').forEach(element => {
            element.setAttribute('contenteditable', 'true');
            element.addEventListener('blur', () => {
                saveToSession();
            });
        });

        // Lưu dữ liệu vào sessionStorage
        function saveToSession() {
            const cvData = {};
            document.querySelectorAll('.editable').forEach(element => {
                const field = element.dataset.field;
                cvData[field] = element.innerHTML;
            });
            sessionStorage.setItem('cvData', JSON.stringify(cvData));
        }

        // Khôi phục dữ liệu từ sessionStorage
        function loadFromSession() {
            const savedData = sessionStorage.getItem('cvData');
            if (savedData) {
                const cvData = JSON.parse(savedData);
                Object.keys(cvData).forEach(field => {
                    const element = document.querySelector(`[data-field="${field}"]`);
                    if (element) {
                        element.innerHTML = cvData[field];
                    }
                });
            }

            const savedImage = sessionStorage.getItem('profileImage');
            if (savedImage) {
                document.getElementById('profile-preview').src = savedImage;
            }
        }

        // Tải CV dưới dạng PDF
        function downloadPDF() {
            const element = document.getElementById('cv-content');
            const opt = {
                margin: 0,
                filename: 'cv-logistics.pdf',
                image: { type: 'jpeg', quality: 0.98 },
                html2canvas: { scale: 2 },
                jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' }
            };

            html2pdf().set(opt).from(element).save();
        }

        // Lưu CV
        function saveCV() {
            saveToSession();
            alert('CV đã được lưu thành công!');
        }

        // Load saved data when page loads
        window.addEventListener('load', loadFromSession);
    </script>
</body>
</html>
