@extends('layouts.layout_candidate_profile')

@section('content')
 <style>


        /* Popup Styles */
        .popup {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
        }

        .popup-content {
            position: relative;
            background-color: #fff;
            margin: 15% auto;
            padding: 20px;
            width: 90%;
            max-width: 500px;
            border-radius: 8px;
        }

        .detail-content {
            max-width: 800px;
            margin: 5% auto;
        }

        .close-btn {
            position: absolute;
            right: 20px;
            top: 10px;
            font-size: 24px;
            cursor: pointer;
            color: #666;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }

      

        .job-categories2 {
            padding: 60px 20px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .section-title {
            text-align: center;
            font-size: 24px;
            margin-bottom: 40px;
            font-weight: bold;
        }

        .slider-container {
            position: relative;
            overflow: hidden;
        }

        .slider {
            display: flex;
            transition: transform 0.5s ease;
            gap: 20px;
        }

        .job-card {
            flex: 0 0 calc(33.333% - 20px);
            min-width: calc(33.333% - 20px);
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .job-image {
            height: 200px;
            overflow: hidden;
        }

        .job-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .job-content {
            padding: 20px;
        }

        .date {
            color: #666;
            font-size: 14px;
            margin-bottom: 10px;
        }

        .job-content h3 {
            font-size: 18px;
            margin-bottom: 15px;
            font-weight: bold;
        }

        .job-details {
            list-style: none;
            padding: 0;
            margin-bottom: 20px;
        }

        .job-details li {
            margin-bottom: 10px;
            font-size: 14px;
            line-height: 1.4;
        }

        .job-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
        }

        .location {
            color: #666;
            font-size: 14px;
        }

        .btn-participate {
            background: #ff1f6d;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
        }

        .slider-nav {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 20px;
        }

        .nav-dot {
            width: 30px;
            height: 4px;
            background: #ccc;
            border: none;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .nav-dot.active {
            background: #ff1f6d;
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .job-card {
                flex: 0 0 calc(50% - 20px);
                min-width: calc(50% - 20px);
            }
        }

        @media (max-width: 768px) {
            .job-card {
                flex: 0 0 100%;
                min-width: 100%;
            }
        }
    </style>

        @if ($savedStudyAbroad->count() > 0)
            <div class="main-content">
                <div class="row">

                    @foreach ($savedStudyAbroad as $study)
                        <div class="job-card">
                        <div class="job-image">
                            <img src="{{ asset('storage/' . $study->image) }}" alt="{{ $study->name }}">
                        </div>
                        <div class="job-content">
                            <div class="date">
                                <i class="far fa-calendar"></i>
                                {{ now()->locale('vi')->translatedFormat('j F, Y') }}
                            </div>

                            <h3>{{ $study->name }}

                            </h3>

                            <div class="job-details">
                                {{ $study->short_detail }}
                            </div>

                            <div class="job-footer">
                                <span class="location">
                                    @foreach ($study->countries as $country)
                                        <img src="{{ asset('storage/' . $country->image) }}" alt="{{ $country->name }}"
                                            class="country-flag">@if (!$loop->last) @endif
                                    @endforeach
                                </span>

                                <div class="action-buttons">
                                    <button class="btn-participate" onclick="showRegisterPopup({{ $study->id }})"
                                        data-id="{{ $study->id }}">
                                        <i class="fas fa-user-plus fa-lg"></i>
                                    </button>
                                    <button class="save-btn" onclick="toggleSaveStudyAbroad({{ $study->id }})"
                                        data-id="{{ $study->id }}">
                                        <i class="far fa-heart fa-lg"></i>
                                    </button>
                                    <a href="{{ route('study-abroad.show', $study->slug) }}" class="btn-detail">
                                        <i class="fas fa-info-circle fa-lg"></i>
                                    </a>
                                </div>
                            </div>

                            <style>
                                .job-footer {
                                    display: flex;
                                    justify-content: space-between;
                                    align-items: center;
                                    margin-top: 15px;
                                }

                                .location {
                                    display: flex;
                                    gap: 5px;
                                }

                                .country-flag {
                                    width: 24px;
                                    height: 16px;
                                    object-fit: cover;
                                    vertical-align: middle;
                                }

                                .action-buttons {
                                    display: flex;
                                    gap: 10px;
                                }

                                .action-buttons button,
                                .action-buttons a {
                                    background: transparent;
                                    border: 1px solid #ddd;
                                    border-radius: 5px;
                                    padding: 8px 12px;
                                    cursor: pointer;
                                    transition: all 0.3s ease;
                                    display: flex;
                                    align-items: center;
                                    justify-content: center;
                                }

                                .action-buttons i {
                                    font-size: 18px;
                                    width: 20px;
                                    height: 20px;
                                    display: flex;
                                    align-items: center;
                                    justify-content: center;
                                }

                                .btn-participate:hover {
                                    background-color: #4CAF50;
                                    color: white;
                                    border-color: #4CAF50;
                                }

                                .btn-detail:hover {
                                    background-color: #2196F3;
                                    color: white;
                                    border-color: #2196F3;
                                }

                                .save-btn:hover {
                                    background-color: #ff5252;
                                    color: white;
                                    border-color: #ff5252;
                                }

                                .save-btn.saved {
                                    background-color: #ff5252;
                                    color: white;
                                    border-color: #ff5252;
                                }

                                .save-btn.processing {
                                    opacity: 0.7;
                                    pointer-events: none;
                                }
                            </style>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
            <div class="pagination-container mt-4">
                {{ $savedStudyAbroad->links() }}
            </div>

        @else
            <div class="empty-state">
                <i class="far fa-heart fa-4x"></i>
                <h3>Bạn chưa lưu du học nghề nào</h3>

            </div>
        @endif
<script>
        window.toggleSaveStudyAbroad = function (studyAbroadId) {
            document.querySelectorAll(".save-btn").forEach(button => {
                button.addEventListener("click", function () {
                    const studyAbroadId = this.dataset.id;
                    toggleSaveStudyAbroad(studyAbroadId);
                });
            });

            fetch(`/candidate/save-study-abroad/${studyAbroadId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const saveBtn = document.querySelector(`.save-btn[data-id="${studyAbroadId}"]`);
                        if (data.saved) {
                            saveBtn.innerHTML = 'Đã lưu';
                            saveBtn.classList.add('saved');
                        } else {
                            saveBtn.innerHTML = 'Lưu';
                            saveBtn.classList.remove('saved');
                        }
                    }
                })
                .catch(error => {
                    console.error('Lỗi:', error);
                    alert('Có lỗi xảy ra khi lưu chương trình du học.');
                });
        };

        // Kiểm tra nếu chương trình đã được lưu
        document.addEventListener("DOMContentLoaded", function () {
            document.querySelectorAll(".save-btn").forEach(button => {
                const studyAbroadId = button.dataset.id;

                fetch(`/candidate/study-abroad/${studyAbroadId}/check-saved`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.saved) {
                            button.innerHTML = '❤️';
                            button.classList.add('saved');
                        }
                    });
            });
        });
    </script>
    <script>
        function showRegisterPopup(studyAbroadId) {
            const popup = document.getElementById('registerPopup');
            const form = document.getElementById('registerForm');

            // Gán action route động đúng với route Laravel
            const actionRoute = `/candidate/register-study-abroad/${studyAbroadId}`;
            form.action = actionRoute;

            popup.style.display = 'block';
        }

        function closeRegisterPopup() {
            document.getElementById('registerPopup').style.display = 'none';
        }
    </script>
@endsection
