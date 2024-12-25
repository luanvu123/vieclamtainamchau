<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern Professional CV</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: #f5f5f5;
            padding: 20px;
            color: #333;
        }

        .cv-container {
            max-width: 1000px;
            margin: 0 auto;
            background: white;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            position: relative;
            overflow: hidden;
        }

        .cv-header {
            background: #2c3e50;
            padding: 60px 40px 40px;
            color: white;
            display: grid;
            grid-template-columns: auto 1fr;
            gap: 40px;
            align-items: center;
        }

        .profile-image-container {
            position: relative;
            width: 180px;
            height: 180px;
            border-radius: 50%;
            border: 4px solid #fff;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }

        .profile-image-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .profile-image-container label {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(0,0,0,0.7);
            color: white;
            text-align: center;
            padding: 8px;
            cursor: pointer;
            font-size: 12px;
            transition: 0.3s;
            opacity: 0;
        }

        .profile-image-container:hover label {
            opacity: 1;
        }

        .profile-image-container input[type="file"] {
            display: none;
        }

        .header-content h1 {
            font-size: 2.5em;
            margin-bottom: 10px;
            font-weight: 600;
        }

        .header-content h2 {
            font-size: 1.5em;
            color: #3498db;
            font-weight: 400;
        }

        .main-content {
            display: grid;
            grid-template-columns: 300px 1fr;
            gap: 40px;
            padding: 40px;
        }

        .section {
            margin-bottom: 30px;
        }

        .section-title {
            font-size: 1.3em;
            color: #2c3e50;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #3498db;
            font-weight: 600;
        }

        .contact-info {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .contact-item {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .contact-item span:first-child {
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #3498db;
            color: white;
            border-radius: 50%;
            font-size: 12px;
        }

        .skills-list {
            list-style: none;
        }

        .skill-item {
            margin-bottom: 15px;
        }

        .skill-item span {
            display: block;
            margin-bottom: 5px;
        }

        .skill-bar {
            height: 6px;
            background: #eee;
            border-radius: 3px;
            overflow: hidden;
        }

        .skill-level {
            height: 100%;
            background: #3498db;
            border-radius: 3px;
            transition: width 0.5s;
        }

        .experience-item, .education-item {
            margin-bottom: 25px;
            position: relative;
            padding-left: 20px;
        }

        .experience-item::before, .education-item::before {
            content: '';
            position: absolute;
            left: 0;
            top: 8px;
            width: 8px;
            height: 8px;
            background: #3498db;
            border-radius: 50%;
        }

        .date {
            color: #666;
            font-size: 0.9em;
            margin: 5px 0;
        }

        .edit-mode .editable {
            border: 1px dashed transparent;
            padding: 5px;
            transition: all 0.3s;
        }

        .edit-mode .editable:hover {
            border-color: #3498db;
            background: rgba(52, 152, 219, 0.05);
        }

        .edit-mode .editable:focus {
            border-color: #3498db;
            background: white;
            outline: none;
            box-shadow: 0 0 5px rgba(52, 152, 219, 0.3);
        }

        .button-container {
            position: fixed;
            bottom: 20px;
            right: 20px;
            display: flex;
            gap: 10px;
            z-index: 1000;
        }

        .button-container button {
            padding: 12px 24px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: all 0.3s;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }

        .save-btn {
            background: #2ecc71;
            color: white;
        }

        .download-btn {
            background: #3498db;
            color: white;
        }

        .button-container button:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
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
            .profile-image-container label,
            .edit-mode .editable {
                display: none;
            }
        }

        @media (max-width: 768px) {
            .cv-header {
                grid-template-columns: 1fr;
                text-align: center;
            }
            .profile-image-container {
                margin: 0 auto;
            }
            .main-content {
                grid-template-columns: 1fr;
            }
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
</head>
<body>
    <div class="cv-container" id="cv-content">
        <div class="cv-header">
            <div class="profile-image-container">
                <img src="/api/placeholder/180/180" alt="Profile Photo" id="profile-img">
                <label for="profile-upload">Change Photo</label>
                <input type="file" id="profile-upload" accept="image/*">
            </div>
            <div class="header-content">
                <h1 contenteditable="true" class="editable" data-field="name">ALEXANDER WILSON</h1>
                <h2 contenteditable="true" class="editable" data-field="title">SENIOR SOFTWARE ENGINEER</h2>
            </div>
        </div>

        <div class="main-content">
            <div class="sidebar">
                <div class="section">
                    <h3 class="section-title">CONTACT</h3>
                    <div class="contact-info">
                        <div class="contact-item">
                            <span>📞</span>
                            <span contenteditable="true" class="editable" data-field="phone">+1 234 567 890</span>
                        </div>
                        <div class="contact-item">
                            <span>✉️</span>
                            <span contenteditable="true" class="editable" data-field="email">alex.wilson@email.com</span>
                        </div>
                        <div class="contact-item">
                            <span>🌐</span>
                            <span contenteditable="true" class="editable" data-field="website">www.alexwilson.dev</span>
                        </div>
                        <div class="contact-item">
                            <span>📍</span>
                            <span contenteditable="true" class="editable" data-field="location">San Francisco, CA</span>
                        </div>
                    </div>
                </div>

                <div class="section">
                    <h3 class="section-title">SKILLS</h3>
                    <div class="skills-list">
                        <div class="skill-item">
                            <span contenteditable="true" class="editable" data-field="skill1">JavaScript / React</span>
                            <div class="skill-bar">
                                <div class="skill-level" style="width: 95%"></div>
                            </div>
                        </div>
                        <div class="skill-item">
                            <span contenteditable="true" class="editable" data-field="skill2">Node.js / Express</span>
                            <div class="skill-bar">
                                <div class="skill-level" style="width: 90%"></div>
                            </div>
                        </div>
                        <div class="skill-item">
                            <span contenteditable="true" class="editable" data-field="skill3">Python / Django</span>
                            <div class="skill-bar">
                                <div class="skill-level" style="width: 85%"></div>
                            </div>
                        </div>
                        <div class="skill-item">
                            <span contenteditable="true" class="editable" data-field="skill4">DevOps / AWS</span>
                            <div class="skill-bar">
                                <div class="skill-level" style="width: 80%"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="section">
                    <h3 class="section-title">LANGUAGES</h3>
                    <div class="skills-list">
                        <div class="skill-item">
                            <span contenteditable="true" class="editable" data-field="lang1">English</span>
                            <div class="skill-bar">
                                <div class="skill-level" style="width: 100%"></div>
                            </div>
                        </div>
                        <div class="skill-item">
                            <span contenteditable="true" class="editable" data-field="lang2">Spanish</span>
                            <div class="skill-bar">
                                <div class="skill-level" style="width: 80%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="main">
                <div class="section">
                    <h3 class="section-title">ABOUT ME</h3>
                    <p contenteditable="true" class="editable" data-field="about">
                        Experienced software engineer with over 8 years of expertise in full-stack development. Passionate about creating scalable solutions and mentoring junior developers. Proven track record of delivering high-impact projects in fast-paced environments.
                    </p>
                </div>

                <div class="section">
                    <h3 class="section-title">EXPERIENCE</h3>
                    <div class="experience-item">
                        <h4 contenteditable="true" class="editable" data-field="exp1_title">Senior Software Engineer</h4>
                        <div contenteditable="true" class="editable" data-field="exp1_company">Tech Solutions Inc.</div>
                        <div class="date" contenteditable="true" class="editable" data-field="exp1_date">2020 - Present</div>
                        <p contenteditable="true" class="editable" data-field="exp1_desc">
                            Led development of cloud-native applications using React and Node.js. Implemented microservices architecture, improving system scalability by 200%. Mentored team of 5 junior developers.
                        </p>
                    </div>

                    <div class="experience-item">
                        <h4 contenteditable="true" class="editable" data-field="exp2_title">Full Stack Developer</h4>
                        <div contenteditable="true" class="editable" data-field="exp2_company">Digital Innovations Corp</div>
                        <div class="date" contenteditable="true" class="editable" data-field="exp2_date">2018 - 2020</div>
                        <p contenteditable="true" class="editable" data-field="exp2_desc">
                            Developed and maintained multiple web applications using React, Node.js, and Python. Reduced server response time by 40% through optimization of database queries.
                        </p>
                    </div>
                </div>

                <div class="section">
                    <h3 class="section-title">EDUCATION</h3>
                    <div class="education-item">
                        <h4 contenteditable="true" class="editable" data-field="edu1_degree">Master of Computer Science</h4>
                        <div contenteditable="true" class="editable" data-field="edu1_school">Stanford University</div>
                        <div class="date" contenteditable="true" class="editable" data-field="edu1_date">2016 - 2018</div>
                    </div>

                    <div class="education-item">
                        <h4 contenteditable="true" class="editable" data-field="edu2_degree">Bachelor of Software Engineering</h4>
                        <div contenteditable="true" class="editable" data-field="edu2_school">MIT</div>
                        <div class="date" contenteditable="true" class="editable" data-field="edu2_date">2012 - 2016</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="button-container">
        <button class="save-btn" onclick="saveCV()">Save Changes</button>
        <button class="download-btn" onclick="downloadPDF()">Download PDF</button>
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
                      sessionStorage.setItem('cv_profile_image', e.target.result);
                };
                reader.readAsDataURL(file);
            }
        });

        // Handle skill bar updates
        function updateSkillBar(element) {
            const text = element.innerText.toLowerCase();
            const level = parseInt(text.match(/\d+/)?.[0] || '0');
            if (!isNaN(level) && level >= 0 && level <= 100) {
                const skillBar = element.nextElementSibling.querySelector('.skill-level');
                if (skillBar) {
                    skillBar.style.width = `${level}%`;
                }
            }
        }

        // Add event listeners for skill updates
        document.querySelectorAll('.skill-item .editable').forEach(element => {
            element.addEventListener('blur', () => updateSkillBar(element));
        });

        // Save CV data to sessionStorage
        function saveCV() {
            const cvData = {
                content: {},
                skillLevels: {}
            };

            // Save text content
            document.querySelectorAll('.editable').forEach(element => {
                const field = element.dataset.field;
                cvData.content[field] = element.innerText;
            });

            // Save skill levels
            document.querySelectorAll('.skill-item').forEach((item, index) => {
                const skillLevel = item.querySelector('.skill-level');
                if (skillLevel) {
                    cvData.skillLevels[`skill${index + 1}`] = skillLevel.style.width;
                }
            });

            sessionStorage.setItem('cv_data', JSON.stringify(cvData));

            // Show success message
            const notification = document.createElement('div');
            notification.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                background: #2ecc71;
                color: white;
                padding: 15px 25px;
                border-radius: 5px;
                box-shadow: 0 2px 5px rgba(0,0,0,0.2);
                animation: slideIn 0.5s ease-out;
                z-index: 1000;
            `;
            notification.textContent = 'CV saved successfully!';
            document.body.appendChild(notification);

            setTimeout(() => {
                notification.style.animation = 'slideOut 0.5s ease-in';
                setTimeout(() => notification.remove(), 500);
            }, 2000);
        }

        // Load CV data from sessionStorage
        function loadCV() {
            const savedData = sessionStorage.getItem('cv_data');
            if (savedData) {
                const cvData = JSON.parse(savedData);

                // Load text content
                document.querySelectorAll('.editable').forEach(element => {
                    const field = element.dataset.field;
                    if (cvData.content[field]) {
                        element.innerText = cvData.content[field];
                    }
                });

                // Load skill levels
                if (cvData.skillLevels) {
                    Object.entries(cvData.skillLevels).forEach(([key, value]) => {
                        const skillItem = document.querySelector(`[data-field="${key}"]`)?.closest('.skill-item');
                        if (skillItem) {
                            const skillLevel = skillItem.querySelector('.skill-level');
                            if (skillLevel) {
                                skillLevel.style.width = value;
                            }
                        }
                    });
                }
            }

            // Load profile image
            const savedImage = sessionStorage.getItem('cv_profile_image');
            if (savedImage) {
                document.getElementById('profile-img').src = savedImage;
            }
        }

        // Download PDF function with improved styling
        function downloadPDF() {
            const element = document.getElementById('cv-content');
            const opt = {
                margin: [10, 10],
                filename: 'professional-cv.pdf',
                image: { type: 'jpeg', quality: 0.98 },
                html2canvas: {
                    scale: 2,
                    logging: false,
                    dpi: 192,
                    letterRendering: true
                },
                jsPDF: {
                    unit: 'mm',
                    format: 'a4',
                    orientation: 'portrait'
                }
            };

            // Add loading indicator
            const loadingEl = document.createElement('div');
            loadingEl.style.cssText = `
                position: fixed;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                background: rgba(0,0,0,0.8);
                color: white;
                padding: 20px 40px;
                border-radius: 5px;
                z-index: 1000;
            `;
            loadingEl.textContent = 'Generating PDF...';
            document.body.appendChild(loadingEl);

            // Generate PDF
            html2pdf()
                .set(opt)
                .from(element)
                .save()
                .then(() => {
                    loadingEl.remove();
                })
                .catch(err => {
                    loadingEl.remove();
                    alert('Error generating PDF. Please try again.');
                });
        }

        // Add animation styles
        const style = document.createElement('style');
        style.textContent = `
            @keyframes slideIn {
                from { transform: translateX(100%); opacity: 0; }
                to { transform: translateX(0); opacity: 1; }
            }
            @keyframes slideOut {
                from { transform: translateX(0); opacity: 1; }
                to { transform: translateX(100%); opacity: 0; }
            }
        `;
        document.head.appendChild(style);
    </script>
</body>
</html>
