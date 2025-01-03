<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CV Coffee Theme</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <style>
        /* Reset CSS */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }

        :root {
            --primary: #6F4E37;
            --secondary: #C4A484;
            --accent: #8B4513;
            --light: #FFF8DC;
            --text: #333;
        }

        body {
            background-color: #f5f5f5;
            color: var(--text);
        }

        /* A4 Container Settings */
        .container {
            width: 210mm;
            min-height: 297mm;
            margin: 20px auto;
            background: white;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            position: relative;
        }

        .cv-page {
            padding: 0;
            margin: 0;
            width: 100%;
            min-height: 297mm;
            position: relative;
        }

        /* Header Section */
        .header {
            background-color: var(--primary);
            color: white;
            padding: 20px;
            text-align: center;
            width: 100%;
            margin: 0;
        }

        /* Profile Image */
        .profile-img-container {
            position: relative;
            width: 120px;
            height: 120px;
            margin: 0 auto 15px;
            border-radius: 50%;
            overflow: hidden;
            border: 4px solid var(--secondary);
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
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            opacity: 0;
            transition: opacity 0.3s;
            cursor: pointer;
        }

        .profile-img-container:hover .profile-img-overlay {
            opacity: 1;
        }

        .profile-img-overlay span {
            color: white;
            font-size: 12px;
            text-align: center;
            padding: 5px;
        }

        #image-upload {
            display: none;
        }

        /* Content Sections */
        .content {
            padding: 20px 30px;
        }

        .section {
            margin-bottom: 15px;
            padding: 10px 15px;
            border-left: 3px solid var(--secondary);
        }

        .section-title {
            color: var(--primary);
            margin-bottom: 8px;
            font-size: 1.2em;
        }

        .editable {
            padding: 3px;
            border: 1px solid transparent;
            transition: all 0.3s;
            min-height: 20px;
        }

        .editable:hover {
            border-color: var(--secondary);
            background-color: var(--light);
            cursor: text;
        }

        /* Controls */
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

        .btn:hover {
            opacity: 0.9;
            transform: translateY(-2px);
        }

        /* Print/PDF Specific Styles */
        @media print {
            .controls, .profile-img-overlay {
                display: none !important;
            }

            .container {
                margin: 0;
                padding: 0;
                box-shadow: none;
                width: 210mm;
                height: 297mm;
            }

            .cv-page {
                margin: 0;
                padding: 0;
                width: 210mm;
                height: 297mm;
            }

            body {
                margin: 0;
                padding: 0;
                width: 210mm;
                height: 297mm;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="cv-page" id="cv-content">
            <div class="header">
                <div class="profile-img-container">
                    <img src="/api/placeholder/150/150" alt="Profile" class="profile-img" id="profile-preview">
                    <div class="profile-img-overlay" onclick="document.getElementById('image-upload').click()">
                        <span>Click để tải ảnh</span>
                    </div>
                </div>
                <input type="file" id="image-upload" accept="image/*">
                <h1 class="editable" data-field="name">Nguyễn Văn A</h1>
                <p class="editable" data-field="title">Chuyên Viên Phát Triển Web</p>
            </div>

            <div class="content">
                <div class="section">
                    <h2 class="section-title">Thông Tin Liên Hệ</h2>
                    <p class="editable" data-field="email">email@example.com</p>
                    <p class="editable" data-field="phone">0123 456 789</p>
                    <p class="editable" data-field="address">Hà Nội, Việt Nam</p>
                </div>

                <div class="section">
                    <h2 class="section-title">Giới Thiệu</h2>
                    <p class="editable" data-field="summary">
                        Tôi là một chuyên viên phát triển web với hơn 5 năm kinh nghiệm trong việc xây dựng và phát triển các ứng dụng web.
                    </p>
                </div>

                <div class="section">
                    <h2 class="section-title">Kinh Nghiệm</h2>
                    <div class="editable" data-field="experience">
                        <p><strong>Senior Web Developer</strong> - Công ty ABC (2020 - Hiện tại)</p>
                        <p>- Phát triển và duy trì các ứng dụng web quy mô lớn</p>
                        <p>- Quản lý team 5 người</p>
                    </div>
                </div>

                <div class="section">
                    <h2 class="section-title">Học Vấn</h2>
                    <div class="editable" data-field="education">
                        <p><strong>Đại học XYZ</strong> - Cử nhân CNTT (2015-2019)</p>
                        <p>- Tốt nghiệp loại Giỏi</p>
                        <p>- GPA: 3.8/4.0</p>
                    </div>
                </div>

                <div class="section">
                    <h2 class="section-title">Kỹ Năng</h2>
                    <div class="editable" data-field="skills">
                        - HTML, CSS, JavaScript
                        - React, Vue.js
                        - Node.js, PHP
                        - MySQL, MongoDB
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
                filename: 'cv.pdf',
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
