<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interactive CV Template</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background: #f0f0f0;
            padding: 20px;
        }

        .cv-container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 40px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        .edit-mode .editable {
            border: 1px dashed #ccc;
            padding: 5px;
            margin: 2px;
            min-height: 24px;
        }

        .edit-mode .editable:focus {
            border: 1px solid #3498db;
            outline: none;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header h1 {
            color: #333;
            font-size: 32px;
            margin-bottom: 5px;
        }

        .header h2 {
            color: #666;
            font-size: 18px;
            font-weight: normal;
        }

        .profile-section {
            display: grid;
            grid-template-columns: 250px 1fr;
            gap: 30px;
            margin-bottom: 30px;
        }

        .left-column {
            display: flex;
            flex-direction: column;
            gap: 30px;
        }

        .profile-image {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            overflow: hidden;
            margin: 0 auto;
            position: relative;
        }

        .profile-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .profile-image input[type="file"] {
            display: none;
        }

        .profile-image label {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(0,0,0,0.5);
            color: white;
            text-align: center;
            padding: 5px;
            cursor: pointer;
            font-size: 12px;
        }

        .section-title {
            color: #2c3e50;
            font-size: 20px;
            margin-bottom: 15px;
            padding-bottom: 5px;
            border-bottom: 2px solid #3498db;
        }

        .contact-info {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .contact-item {
            display: flex;
            align-items: center;
            gap: 10px;
            color: #666;
        }

        .skills-list {
            list-style: none;
        }

        .skills-list li {
            margin-bottom: 8px;
            color: #666;
        }

        .experience-item {
            margin-bottom: 20px;
        }

        .experience-item h3 {
            color: #333;
            margin-bottom: 5px;
        }

        .experience-item .date {
            color: #666;
            font-size: 14px;
            margin-bottom: 8px;
        }

        .experience-item p {
            color: #666;
            line-height: 1.5;
        }

        .education-item {
            margin-bottom: 15px;
        }

        .button-container {
            position: fixed;
            bottom: 20px;
            right: 20px;
            display: flex;
            gap: 10px;
        }

        .button-container button {
            padding: 10px 20px;
            background: #3498db;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .button-container button:hover {
            background: #2980b9;
        }

        @media print {
            body {
                padding: 0;
                background: white;
            }
            .cv-container {
                box-shadow: none;
            }
            .button-container,
            .profile-image label {
                display: none;
            }
            .edit-mode .editable {
                border: none;
                padding: 0;
                margin: 0;
            }
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
</head>
<body>
    <div class="cv-container" id="cv-content">
        <header class="header">
            <h1 contenteditable="true" class="editable" data-field="name">MILLIE SMITH</h1>
            <h2 contenteditable="true" class="editable" data-field="title">COMMUNICATION DESIGNER</h2>
        </header>

        <div class="profile-section">
            <div class="left-column">
                <div class="profile-image">
                    <img src="/api/placeholder/150/150" alt="Profile Photo" id="profile-img">
                    <label for="profile-upload"></label>
                    <input type="file" id="profile-upload" accept="image/*">
                </div>

                <div class="about">
                    <h3 class="section-title">ABOUT</h3>
                    <p contenteditable="true" class="editable" data-field="about">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
                </div>

                <div class="contact">
                    <h3 class="section-title">CONTACT</h3>
                    <div class="contact-info">
                        <div class="contact-item">
                            <span>📞</span>
                            <span contenteditable="true" class="editable" data-field="phone">+00 123 456 7890</span>
                        </div>
                        <div class="contact-item">
                            <span>✉️</span>
                            <span contenteditable="true" class="editable" data-field="email">example@email.com</span>
                        </div>
                        <div class="contact-item">
                            <span>🌐</span>
                            <span contenteditable="true" class="editable" data-field="website">www.example.com</span>
                        </div>
                        <div class="contact-item">
                            <span>📍</span>
                            <span contenteditable="true" class="editable" data-field="address">123 Street Name, City Name</span>
                        </div>
                    </div>
                </div>

                <div class="skills">
                    <h3 class="section-title">SKILLS</h3>
                    <ul class="skills-list">
                        <li contenteditable="true" class="editable" data-field="skill1">Lorem ipsum dolor</li>
                        <li contenteditable="true" class="editable" data-field="skill2">Consectetur adipiscing</li>
                        <li contenteditable="true" class="editable" data-field="skill3">Sed diam nonummy</li>
                        <li contenteditable="true" class="editable" data-field="skill4">Euismod tincidunt</li>
                    </ul>
                </div>
            </div>

            <div class="right-column">
                <div class="education">
                    <h3 class="section-title">EDUCATION</h3>
                    <div class="education-item">
                        <h3 contenteditable="true" class="editable" data-field="edu1_degree">CERTIFICATE</h3>
                        <div class="date" contenteditable="true" class="editable" data-field="edu1_date">2017 - 2018</div>
                        <p contenteditable="true" class="editable" data-field="edu1_school">UNIVERSITY NAME</p>
                    </div>
                    <div class="education-item">
                        <h3 contenteditable="true" class="editable" data-field="edu2_degree">BACHELOR'S DEGREE</h3>
                        <div class="date" contenteditable="true" class="editable" data-field="edu2_date">2014 - 2017</div>
                        <p contenteditable="true" class="editable" data-field="edu2_school">UNIVERSITY NAME</p>
                    </div>
                </div>

                <div class="experience">
                    <h3 class="section-title">EXPERIENCE</h3>
                    <div class="experience-item">
                        <h3 contenteditable="true" class="editable" data-field="exp1_company">COMPANY NAME</h3>
                        <div class="date" contenteditable="true" class="editable" data-field="exp1_date">2020 - PRESENT</div>
                        <p contenteditable="true" class="editable" data-field="exp1_desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
                    </div>
                    <div class="experience-item">
                        <h3 contenteditable="true" class="editable" data-field="exp2_company">COMPANY NAME</h3>
                        <div class="date" contenteditable="true" class="editable" data-field="exp2_date">2019 - 2020</div>
                        <p contenteditable="true" class="editable" data-field="exp2_desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
                    </div>
                    <div class="experience-item">
                        <h3 contenteditable="true" class="editable" data-field="exp3_company">COMPANY NAME</h3>
                        <div class="date" contenteditable="true" class="editable" data-field="exp3_date">2018 - 2019</div>
                        <p contenteditable="true" class="editable" data-field="exp3_desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="button-container">
        <button onclick="saveCV()">Save Changes</button>
        <button onclick="downloadPDF()">Download PDF</button>
    </div>

    <script>
        // Load saved data on page load
        document.addEventListener('DOMContentLoaded', loadCV);

        // Handle profile image upload
        document.getElementById('profile-upload').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('profile-img').src = e.target.result;
                    // Save image to sessionStorage
                    sessionStorage.setItem('cv_profile_image', e.target.result);
                };
                reader.readAsDataURL(file);
            }
        });

        // Save CV data to sessionStorage
        function saveCV() {
            const cvData = {};
            document.querySelectorAll('.editable').forEach(element => {
                const field = element.dataset.field;
                cvData[field] = element.innerText;
            });

            sessionStorage.setItem('cv_data', JSON.stringify(cvData));
            alert('CV data saved successfully!');
        }

        // Load CV data from sessionStorage
        function loadCV() {
            // Load text content
            const savedData = sessionStorage.getItem('cv_data');
            if (savedData) {
                const cvData = JSON.parse(savedData);
                document.querySelectorAll('.editable').forEach(element => {
                    const field = element.dataset.field;
                    if (cvData[field]) {
                        element.innerText = cvData[field];
                    }
                });
            }

            // Load profile image
            const savedImage = sessionStorage.getItem('cv_profile_image');
            if (savedImage) {
                document.getElementById('profile-img').src = savedImage;
            }
        }

        // Download PDF function
        function downloadPDF() {
            const element = document.getElementById('cv-content');
            const opt = {
                margin: 10,
                filename: 'cv.pdf',
                image: { type: 'jpeg', quality: 0.98 },
                html2canvas: { scale: 2 },
                jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' }
            };

            html2pdf().set(opt).from(element).save();
        }
    </script>
</body>
</html>
