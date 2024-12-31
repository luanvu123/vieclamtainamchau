@extends('layout')
@section('content')
    <div class="container">
        <div class="sidebar">
            <div class="menu-section">
                <div class="menu-title">Quản lý đăng tuyển dụng</div>
                <a href="{{ route('employer.job-posting.create') }}" class="menu-item">
                    <i>+</i>
                    <span>Tạo tin tuyển dụng</span>
                </a>
                <a href="{{ route('employer.job-posting.index') }}" class="menu-item">
                    <i>📋</i>
                    <span>Quản lý tin đăng</span>
                </a>
                <a href="{{ route('employer.services') }}" class="menu-item">
                    <i>📊</i>
                    <span>Mua dịch vụ</span>
                </a>
                <a href="{{ route('employer.service-active') }}" class="menu-item">
                    <i>❤️</i>
                    <span>Dịch vụ đã mua</span>
                </a>
            </div>

            <div class="menu-section">
                <div class="menu-title">Quản lý ứng viên</div>
                <a href="{{ route('employer.saved-applications') }}" class="menu-item">
                    <i>👥</i>
                    <span>Hồ sơ ứng tuyển</span>
                </a>
                <a href="{{ route('employer.job-posting.find-candidate') }}" class="menu-item">
                    <i>🔍</i>
                    <span>Tìm ứng viên mới</span>
                </a>
            </div>
        </div>

        <div class="main-content">



            <!-- HTML -->
            <div class="service-packages">
                <div class="package-container">
                    @if ($employer->IsBasicnews)
                        <div class="package-item basic">
                            <div class="package-icon">
                                <i class="fas fa-newspaper"></i>
                            </div>
                            <div class="package-details">
                                <h4>Tin cơ bản</h4>
                                @if ($employer->IsBasicnews_updated_at)
                                    <div class="timestamp">
                                        <i class="fas fa-clock"></i>
                                        <div class="time-details">
                                            <span>{{ $employer->IsBasicnews_updated_at->format('H:i d/m/Y') }}</span>
                                            <span
                                                class="time-ago">{{ $employer->IsBasicnews_updated_at->diffForHumans() }}</span>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    @if ($employer->isUrgentrecruitment)
                        <div class="package-item urgent">
                            <div class="package-icon">
                                <i class="fas fa-bolt"></i>
                            </div>
                            <div class="package-details">
                                <h4>Tìm ứng viên</h4>
                                @if ($employer->isUrgentrecruitment_updated_at)
                                    <div class="timestamp">
                                        <i class="fas fa-clock"></i>
                                        <div class="time-details">
                                            <span>{{ $employer->isUrgentrecruitment_updated_at->format('H:i d/m/Y') }}</span>
                                            <span
                                                class="time-ago">{{ $employer->isUrgentrecruitment_updated_at->diffForHumans() }}</span>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    @if ($employer->IsPartner)
                        <div class="package-item partner">
                            <div class="package-icon">
                                <i class="fas fa-crown"></i>
                            </div>
                            <div class="package-details">
                                <h4>Đối tác</h4>
                                @if ($employer->IsPartner_updated_at)
                                    <div class="timestamp">
                                        <i class="fas fa-clock"></i>
                                        <div class="time-details">
                                            <span>{{ $employer->IsPartner_updated_at->format('H:i d/m/Y') }}</span>
                                            <span
                                                class="time-ago">{{ $employer->IsPartner_updated_at->diffForHumans() }}</span>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    @if ($employer->IsHoteffect)
                        <div class="package-item hot">
                            <div class="package-icon">
                                <i class="fas fa-fire"></i>
                            </div>
                            <div class="package-details">
                                <h4>Nổi bật</h4>
                                @if ($employer->IsHoteffect_updated_at)
                                    <div class="timestamp">
                                        <i class="fas fa-clock"></i>
                                        <div class="time-details">
                                            <span>{{ $employer->IsHoteffect_updated_at->format('H:i d/m/Y') }}</span>
                                            <span
                                                class="time-ago">{{ $employer->IsHoteffect_updated_at->diffForHumans() }}</span>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <style>
                .service-packages {
                    padding: 15px;
                    background: #fff;
                    border-radius: 8px;
                    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                }

                .package-container {
                    display: flex;
                    flex-direction: column;
                    gap: 15px;
                }

                .package-item {
                    display: flex;
                    align-items: flex-start;
                    padding: 12px;
                    border-radius: 6px;
                    background: #f8f9fa;
                    transition: all 0.3s ease;
                }

                .package-item:hover {
                    transform: translateY(-2px);
                    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                }

                .package-icon {
                    width: 40px;
                    height: 40px;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    border-radius: 50%;
                    margin-right: 15px;
                }

                .package-details {
                    flex: 1;
                }

                .package-details h4 {
                    margin: 0 0 8px 0;
                    font-size: 16px;
                    font-weight: 600;
                }

                .timestamp {
                    display: flex;
                    align-items: flex-start;
                    font-size: 13px;
                    color: #6c757d;
                }

                .timestamp i {
                    margin-right: 8px;
                    margin-top: 3px;
                }

                .time-details {
                    display: flex;
                    flex-direction: column;
                    gap: 4px;
                }

                .time-ago {
                    color: #868e96;
                    font-style: italic;
                }

                /* Package specific styles */
                .basic .package-icon {
                    background: #e3f2fd;
                    color: #1976d2;
                }

                .urgent .package-icon {
                    background: #fff3e0;
                    color: #f57c00;
                }

                .partner .package-icon {
                    background: #fff8e1;
                    color: #ffc107;
                }

                .hot .package-icon {
                    background: #ffebee;
                    color: #e53935;
                }

                /* Responsive */
                @media (min-width: 768px) {
                    .package-container {
                        flex-direction: row;
                        flex-wrap: wrap;
                    }

                    .package-item {
                        flex: 1 1 calc(50% - 15px);
                        min-width: 250px;
                    }
                }
            </style>


        </div>
    </div>
@endsection
