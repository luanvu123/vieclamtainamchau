<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>
        Trang Admin
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="keywords" content="Glance Design Dashboard Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template,
SmartPhone Compatible web template, free WebDesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
    <script type="application/x-javascript">
        addEventListener("load", function() {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@3.1.0/dist/css/multi-select-tag.css">
    <script src="{{ asset('backend_admin/js/jquery-1.11.1.min.js') }}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.lordicon.com/qjzruarw.js"></script>
    <!-- Fonts -->

    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="{{ asset('backend_admin/css/bootstrap.css') }}" rel="stylesheet" type="text/css" />
    <!-- Custom CSS -->
    <link href="{{ asset('backend_admin/css/style.css') }}" rel="stylesheet" type="text/css" />
    {{-- button --}}
    <link href="{{ asset('backend_admin/css/fronend/metachose.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend_admin/css/fronend/categorychoose.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend_admin/css/fronend/plane.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend_admin/css/fronend/hotdeal.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend_admin/css/fronend/buttoncoupon.css') }}" rel="stylesheet" type="text/css" />
    <!-- font-awesome icons CSS -->
    <link href="{{ asset('backend_admin/css/font-awesome.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend_admin/css/SidebarNav.min.css') }}" media="all" rel="stylesheet" type="text/css" />


    <script src="{{ asset('backend_admin/js/modernizr.custom.js') }}"></script>


    <!--webfonts-->
    <link href="//fonts.googleapis.com/css?family=PT+Sans:400,400i,700,700i&amp;subset=cyrillic,cyrillic-ext,latin-ext"
        rel="stylesheet" />
    <script src="https://kit.fontawesome.com/3e3afb65d3.js" crossorigin="anonymous"></script>
    <!-- Metis Menu -->
    <script src="{{ asset('backend_admin/js/metisMenu.min.js') }}"></script>
    <script src="{{ asset('backend_admin/js/custom.js') }}"></script>
    <link href="{{ asset('backend_admin/css/custom.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend_admin/css/owl.carousel.css') }}" rel="stylesheet" />
    <script src="{{ asset('backend_admin/js/owl.carousel.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('backend_admin/css/dropzone.min.css') }}">

    <script>
        $(document).ready(function () {
            $('#owl-demo').owlCarousel({
                items: 3,
                lazyLoad: true,
                autoPlay: true,
                pagination: true,
                nav: true,
            });
        });
    </script>

    <style>
        /* In your CSS file */
        .avatar-container {
            position: relative;
        }

        .new-badge {
            position: absolute;
            top: 0;
            right: 0;
            background-color: #f39c12;
            color: white;
            font-size: 12px;
            font-weight: bold;
            padding: 2px 5px;
            border-radius: 10px;
        }

        .image-card {
            position: relative;
        }

        .image-card .btn-danger {
            position: absolute;
            right: 20px;
            top: 20px;
        }

        .message-avatar img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
        }
    </style>
</head>

<body class="cbp-spmenu-push">
    @if (Auth::check())
        <div class="main-content">
            <div class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">
                <!--left-fixed -navigation-->
                <aside class="sidebar-left">
                    <nav class="navbar navbar-inverse">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                                data-target=".collapse" aria-expanded="false">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <h1>
                                <a class="navbar-brand" href="{{ url('/') }}"><span class="fa fa-area-chart"></span>
                                    HOME<span class="dashboard_text">Vieclamtainamchau
                                        Admin</span></a>
                            </h1>
                        </div>
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <ul class="sidebar-menu">
                                <li class="header">MAIN ADMIN</li>
                                <li class="treeview">
                                    <a href="{{ route('home') }}">
                                        <img src="{{ asset('backend_admin/images/3643769_building_home_house_main_menu_icon.svg') }}"
                                            alt="Google" width="20" height="20">
                                        <span> Trang chủ</span>
                                    </a>
                                </li>
                                @php
                                    $segment = Request::segment(1);
                                @endphp
                                <li
                                    class="treeview {{ Request::is('users*') || Request::is('cv_templates*') ||Request::is('typeservice*')|| Request::is('company-partners*') || Request::is('roles*')  || Request::is('typeLanguagetrainings*')  ? 'active' : '' }}">
                                    <a href="#">
                                        <img src="{{ asset('backend_admin/images/8673763_ic_fluent_slide_size_filled_icon.svg') }}"
                                            alt="Google" width="20" height="20">
                                        <span>Quản lý hệ thống</span>
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </a>
                                    <ul class="treeview-menu">
                                        <li class="{{ Request::is('users*') ? 'active' : '' }}">
                                            <a href="{{ route('users.index') }}">
                                                <img src="{{ asset('backend_admin/images/9989338_rating_evaluation_grade_ranking_rate_icon.svg') }}"
                                                    alt="Google" width="20" height="20"> Tài khoản quản trị
                                            </a>
                                        </li>
                                        <li class="{{ Request::is('roles*') ? 'active' : '' }}">
                                            <a href="{{ route('roles.index') }}">
                                                <img src="{{ asset('backend_admin/images/3018587_admin_administrator_ajax_options_permission_icon.svg') }}"
                                                    alt="Google" width="20" height="20"> Phân quyền quản trị
                                            </a>
                                        </li>


                                        <li class="{{ Request::is('typeservice*') ? 'active' : '' }}">
    <a href="{{ route('typeservice.index') }}">
        <i class="fa fa-list-alt"></i> Danh sách thể loại dịch vụ
    </a>
</li>



 <li class="{{ Request::is('company-partners*') ? 'active' : '' }}">
            <a href="{{ route('company-partners.index') }}">
                <i class="fa fa-building"></i> Danh sách Đối tác
            </a>
        </li>

                                          <li class="treeview {{ Request::is('typeLanguagetrainings*') ? 'active' : '' }}">
                                            <a href="{{ route('typeLanguagetrainings.index') }}">
                                                <img src="{{ asset('backend_admin/images/newspaper-news-svgrepo-com.svg') }}"
                                                    alt="Google" width="20" height="20">
                                                <span>Ngôn ngữ đào tạo</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>

                                <li
                                    class="treeview  {{ Request::is('manage/employers')  || Request::is('banks*') || Request::is('manage/job-postings') || Request::is('manage/orders*') || Request::is('services*') || Request::is('labor-exports*') ? 'active' : '' }}">
                                    <a href="{{ route('manage.employers.index') }}">
                                        <i class="fa fa-table"></i> <span>Nhà tuyển dụng</span>
                                        @if ($employerCountTwoHour > 0)
                                            <span class="label label-primary pull-right">{{ $employerCountTwoHour }}</span>
                                        @endif
                                        @if ($jobPostingCountTwoHour > 0)
                                            <span class="label label-primary pull-right">{{ $jobPostingCountTwoHour }}
                                            </span>
                                        @endif
                                        @if ($orderCountTwoHour > 0)
                                            <span class="label label-primary pull-right">{{ $orderCountTwoHour }} </span>
                                        @endif
                                          @if ($employerCountTwoHour > 0)
                                                    <span class="label label-primary pull-right">{{ $employerCountTwoHour }}
                                                        </span>
                                                @endif
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </a>

                                    <ul class="treeview-menu">
                                        <li class="{{ Request::routeIs('manage.employers.*') ? 'active' : '' }}">
    <a href="{{ route('manage.employers.index') }}">
        <img src="{{ asset('backend_admin/images/3018587_admin_administrator_ajax_options_permission_icon.svg') }}"
             alt="Google" width="20" height="20">
        Danh sách NTD
           @if ($employerCountTwoHour > 0)
                                                    <span class="label label-primary pull-right">{{ $employerCountTwoHour }}
                                                        </span>
                                                @endif
    </a>
</li>
                                     <li class="{{ Request::is('banks*') ? 'active' : '' }}">
    <a href="{{ route('banks.index') }}">
        <i class="fa fa-credit-card"></i> Thông tin thanh toán
    </a>
</li>

                                        <li class="{{ Request::is('manage/job-postings') ? 'active' : '' }}">
                                            <a href="{{ route('manage.employers.indexJobPosting') }}">
                                                <img src="{{ asset('backend_admin/images/file-document-svgrepo-com.svg') }}"
                                                    alt="Google" width="20" height="20">Việc làm
                                                @if ($jobPostingCountTwoHour > 0)
                                                    <span class="label label-primary pull-right">{{ $jobPostingCountTwoHour }}
                                                        New</span>
                                                @endif
                                            </a>
                                        </li>
                                        <li class="{{ Request::is('services*') ? 'active' : '' }}">
                                            <a href="{{ route('services.index') }}">
                                                <img src="{{ asset('backend_admin/images/shopping-cart-reversed-svgrepo-com.svg') }}"
                                                    alt="Google" width="20" height="20"> Danh sách dịch vụ
                                            </a>
                                        </li>
                                        <li class="{{ Request::is('manage/orders*') ? 'active' : '' }}">
                                            <a href="{{ route('manage.orders.index') }}">
                                                <img src="{{ asset('backend_admin/images/order-1-svgrepo-com.svg') }}"
                                                    alt="Google" width="20" height="20"> Mua tin
                                                @if ($orderCountTwoHour > 0)
                                                    <span class="label label-primary pull-right">{{ $orderCountTwoHour }}
                                                        New</span>
                                                @endif
                                            </a>
                                        </li>

                                <li class="treeview {{ Request::is('labor-exports*') ? 'active' : '' }}">
                                    <a href="{{ route('labor-exports.index') }}">
                                        <img src="{{ asset('backend_admin/images/register-svgrepo-com.svg') }}" alt="Google"
                                            width="20" height="20">
                                        <span> Xuất khẩu lao động </span>
                                    </a>
                                </li>
                            </ul>
                            </li>
<li class="treeview {{ Request::is('news*') || Request::is('advertises*') ? 'active' : '' }}">
    <a href="{{ route('news-manage.index') }}">
        <i class="fa fa-newspaper"></i> <span>Tin tức & Quảng cáo</span>
        @if ($newsCountTwoHour > 0)
            <span class="label label-primary pull-right">{{ $newsCountTwoHour }}</span>
        @endif
        @if ($advertisesCountTwoHour > 0)
            <span class="label label-primary pull-right">{{ $advertisesCountTwoHour }}</span>
        @endif
        <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu">
        <li class="{{ Request::is('news*') ? 'active' : '' }}">
            <a href="{{ route('news-manage.index') }}">
                <i class="fa fa-list"></i> Danh sách tin tức
                @if ($newsCountTwoHour > 0)
                    <span class="label label-primary pull-right">{{ $newsCountTwoHour }}</span>
                @endif
            </a>
        </li>
        <li class="{{ Request::is('advertises*') ? 'active' : '' }}">
            <a href="{{ route('advertises-manage.index') }}">
                <i class="fa fa-bullhorn"></i> Danh sách quảng cáo
                @if ($advertisesCountTwoHour > 0)
                    <span class="label label-primary pull-right">{{ $advertisesCountTwoHour }}</span>
                @endif
            </a>
        </li>
    </ul>
</li>
<li class="treeview {{ Request::is('language-training-manage*') || Request::is('study-abroad-manage*') ? 'active' : '' }}">
    <a href="#">
        <i class="fa fa-language"></i> <span> Đào tạo Ngoại ngữ & Du học nghề</span>
        @if ($languagetrainingCountTwoHour > 0 || $studyabroadCountTwoHour > 0)
            <span class="label label-primary pull-right">
                {{ $languagetrainingCountTwoHour + $studyabroadCountTwoHour }}
            </span>
        @endif
        <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu">
        <li class="{{ Request::is('language-training-manage*') ? 'active' : '' }}">
            <a href="{{ route('language-training-manage.index') }}">
                <i class="fa fa-list"></i> Danh sách đào tạo
                @if ($languagetrainingCountTwoHour > 0)
                    <span class="label label-primary pull-right">{{ $languagetrainingCountTwoHour }}</span>
                @endif
            </a>
        </li>
        <li class="{{ Request::is('study-abroad-manage*') ? 'active' : '' }}">
            <a href="{{ route('study-abroad-manage.index') }}">
                <i class="fa fa-plane"></i> Du học nghề
                @if ($studyabroadCountTwoHour > 0)
                    <span class="label label-primary pull-right">{{ $studyabroadCountTwoHour }}</span>
                @endif
            </a>
        </li>
    </ul>
</li>
<li class="treeview {{ Request::is('candidate-manage*')||Request::is('application-manage*') ||Request::is('languages*')||Request::is('soft-skills*') || Request::is('skills*') ? 'active' : '' }}">
    <a href="#">
         <img src="{{ asset('backend_admin/images/candidate-for-elections-svgrepo-com.svg') }}"
                                        alt="Google" width="20" height="20">
                                    <span> Ứng viên</span>
         @if ($candidateCountTwoHour > 0)
                                        <span class="label label-primary pull-right">{{ $candidateCountTwoHour }}
                                        </span>
                                    @endif
        <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu">
        <li class="{{ Request::is('candidate-manage*') ? 'active' : '' }}">
           <a href="{{ route('candidate-manage.index') }}">
                <i class="fa fa-user"></i>
                                    <span> Ứng viên</span>
         @if ($candidateCountTwoHour > 0)
                                        <span class="label label-primary pull-right">{{ $candidateCountTwoHour }}
                                        </span>
                                    @endif
            </a>
        </li>
        <li class="{{ Request::is('skills*') ? 'active' : '' }}">
            <a href="{{ route('skills.index') }}">
                <i class="fa fa-cogs"></i> <span>Danh sách kỹ năng</span>
            </a>
        </li>
        <li class="{{ Request::is('soft-skills*') ? 'active' : '' }}">
    <a href="{{ route('soft-skills.index') }}">
        <i class="fa fa-handshake"></i> <span>Danh sách kỹ năng mềm</span>
    </a>
</li>
<li class="{{ Request::is('languages*') ? 'active' : '' }}">
    <a href="{{ route('languages.index') }}">
        <i class="fa fa-language"></i> <span>Languages</span>
    </a>
</li>
<li class="{{ Request::is('application-manage*') ? 'active' : '' }}">
    <a href="{{ route('application-manage.index') }}">
        <i class="fa fa-file-text-o"></i>
        <span>Duyệt đơn ứng viên</span>
        @if ($applicationlayout > 0)
            <span class="badge badge-danger">{{ $applicationlayout }}</span>
        @endif
    </a>
</li>


    </ul>
</li>


                          <li class="treeview {{ Request::is('support-manage*')||Request::is('locations*') || Request::is('hotline') ? 'active' : '' }}">
    <a href="#">
        <i class="fa fa-support"></i> <span>Hỗ trợ & liên hệ</span>
        @if ($supportCountTwoHour > 0)
            <span class="label label-primary pull-right">{{ $supportCountTwoHour }} New</span>
        @endif
        <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu">
        <li class="{{ Request::is('support-manage*') ? 'active' : '' }}">
            <a href="{{ route('support-manage.index') }}">
                <i class="fa fa-life-ring"></i> <span>Danh sách hỗ trợ</span>
            </a>
        </li>
        <li class="{{ Request::is('hotline') ? 'active' : '' }}">
            <a href="{{ route('hotline.edit') }}">
                <i class="fa fa-phone"></i> <span>Chỉnh sửa liên hệ </span>
            </a>
        </li>

                                        <li class="treeview {{ Request::is('locations*') ? 'active' : '' }}">
                                            <a href="{{ route('locations.index') }}">
                                                <img src="{{ asset('backend_admin/images/register-svgrepo-com.svg') }}"
                                                    alt="Google" width="20" height="20">
                                                <span> Địa chỉ </span>
                                            </a>
                                        </li>
    </ul>
</li>

<li class="treeview {{ Request::is('countries*')|| Request::is('keysearch*') || Request::is('categories*') || Request::is('genres*') ? 'active' : '' }}">
    <a href="#">
        <i class="fa fa-tags"></i> <span>Quốc gia & danh mục & ngành nghề</span>
        <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu">
        <li class="{{ Request::is('countries*') ? 'active' : '' }}">
            <a href="{{ route('countries.index') }}">
                <i class="fa fa-flag"></i> Danh sách Quốc gia
            </a>
        </li>
        <li class="{{ Request::is('categories*') ? 'active' : '' }}">
            <a href="{{ route('categories.index') }}">
                <i class="fa fa-list"></i> Danh sách Ngành nghề
            </a>
        </li>
        <li class="{{ Request::is('genres*') ? 'active' : '' }}">
            <a href="{{ route('genres.index') }}">
                <i class="fa fa-folder-open"></i> Danh mục XKLD
            </a>
        </li>
          <li class="{{ Request::is('keysearch*') ? 'active' : '' }}">
            <a href="{{ route('keysearch.index') }}">
                <i class="fa fa-search"></i> Danh sách Từ khóa tìm kiếm
            </a>
        </li>
    </ul>
</li>




<li class="treeview {{ Request::is('manage/job-postings/*')|| Request::is('employer/admin/employers*') ? 'active' : '' }}">
    <a href="{{ route('manage.employers.indexJobPosting') }}">
        <i class="fa fa-briefcase"></i> <span>Quản lý Đăng tin</span>
        @if ($basicJobCountTwoHour > 0 || $outstandingJobCountTwoHour > 0 || $specialJobCountTwoHour > 0)
            <span class="label label-primary pull-right">
                {{ $basicJobCountTwoHour + $outstandingJobCountTwoHour + $specialJobCountTwoHour }}
            </span>
        @endif
        <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu">
        <li class="{{ Request::is('manage/job-postings/basic') ? 'active' : '' }}">
            <a href="{{ route('manage.employers.indexBasic') }}">
                <i class="fa fa-circle-o"></i> Tin cơ bản
                @if ($basicJobCountTwoHour > 0)
                    <span class="label label-primary pull-right">{{ $basicJobCountTwoHour }}</span>
                @endif
            </a>
        </li>
        <li class="{{ Request::is('manage/job-postings/outstanding') ? 'active' : '' }}">
            <a href="{{ route('manage.employers.indexOutstanding') }}">
                <i class="fa fa-star-o"></i> Tin nổi bật
                @if ($outstandingJobCountTwoHour > 0)
                    <span class="label label-primary pull-right">{{ $outstandingJobCountTwoHour }}</span>
                @endif
            </a>
        </li>
        <li class="{{ Request::is('manage/job-postings/special') ? 'active' : '' }}">
            <a href="{{ route('manage.employers.indexSpecial') }}">
                <i class="fa fa-star"></i> Tin đặc biệt
                @if ($specialJobCountTwoHour > 0)
                    <span class="label label-primary pull-right">{{ $specialJobCountTwoHour }}</span>
                @endif
            </a>
        </li>
    </ul>
</li>


                            <li class="{{ Request::is('admin/info/edit*') ? 'active' : '' }}">
                                <a href="{{ route('info.edit') }}">
                                    <img src="{{ asset('backend_admin/images/5355692_code_coding_development_programming_web_icon.svg') }}"
                                        alt="Google" width="20" height="20"> Quản lý giao diện
                                </a>
                            </li>

                                </ul>
                        </div>

                        <!-- /.navbar-collapse -->
                    </nav>
                </aside>
            </div>
            <!--left-fixed -navigation-->
            <!-- header-starts -->
            <div class="sticky-header header-section">
                <div class="header-left">
                    <!--toggle button start-->
                    <button id="showLeftPush"><i class="fa fa-bars"></i></button>
                    <!--toggle button end-->
                    <div class="clearfix"></div>
                </div>
                <div class="header-right">
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <div class="profile_details">
                            <ul>
                                <li class="dropdown profile_details_drop">
                                    <a href="{{ route('users.edit', auth()->user()) }}" class="dropdown-toggle"
                                        data-toggle="dropdown" aria-expanded="false">
                                        <div class="profile_img">
                                            <span class="prfil-img">
                                                @if (Auth::user()->avatar)
                                                    <img style="width: 40px;height: 40px;border-radius: 50%;object-fit: cover;"
                                                        src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="">
                                                @else
                                                    <img style="width: 40px;height: 40px;border-radius: 50%;object-fit: cover;"
                                                        src="http://www.gravatar.com/avatar/00000000000000000000000000000000?d=mm&amp;s=300"
                                                        alt="">
                                                @endif
                                            </span>
                                            <div class="user-name">
                                                <p> {{ Auth::user()->name }}</p>
                                                <span>{{ Auth::user()->getRoleNames() }}</span>
                                            </div>
                                            <i class="fa fa-angle-down lnr"></i>
                                            <i class="fa fa-angle-up lnr"></i>
                                            <div class="clearfix"></div>
                                        </div>
                                    </a>
                                    <ul class="dropdown-menu drp-mnu">
                                        <li>
                                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                                             document.getElementById('logout-form').submit();">
                                                <i class="fa fa-sign-out"></i> Đăng xuất
                                            </a>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                @csrf
                                            </form>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="{{ route('users.edit', auth()->user()) }}">
                                                <i class="fa fa-user-edit"></i> Hồ sơ
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    @endguest
                    <div class="clearfix"></div>
                </div>

                <div class="clearfix"></div>
            </div>
            <!-- //header-ends -->
            <!-- main content start-->
            <div id="page-wrapper">
                <div class="main-page">
                    <div class="col_3">
                        <div class="col-md-3 widget widget1">
                            <a href="{{ route('support-manage.index') }}">
                                <div class="r3_counter_box">
                                    <i class="pull-left fa fa-dollar icon-rounded"></i>
                                    <div class="stats">
                                        <h5><strong>{{ $supportCount }}</strong></h5>
                                        <span>Hỗ trợ</span>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-md-3 widget widget1">
                            <a href="{{ route('manage.employers.index') }}">
                                <div class="r3_counter_box">
                                    <i class="pull-left fa fa-laptop user1 icon-rounded"></i>
                                    <div class="stats">
                                        <h5><strong>{{ $employerCount }}</strong></h5>
                                        <span>Nhà tuyển dụng</span>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-md-3 widget widget1">
                            <a href="{{ route('candidate-manage.index') }}">
                                <div class="r3_counter_box">
                                    <i class="pull-left fa fa-money user2 icon-rounded"></i>
                                    <div class="stats">
                                        <h5><strong>{{ $candidateCount }}</strong></h5>
                                        <span>Ứng viên</span>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-md-3 widget widget1">
                            <a href="{{ route('manage.employers.indexJobPosting') }}">
                                <div class="r3_counter_box">
                                    <i class="pull-left fa fa-pie-chart dollar1 icon-rounded"></i>
                                    <div class="stats">
                                        <h5><strong>{{ $jobPostingCount }}</strong></h5>
                                        <span>Tổng chiến dịch</span>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-md-3 widget">
                            <a href="{{ route('manage.employers.indexJobPosting') }}">
                                <div class="r3_counter_box">
                                    <i class="pull-left fa fa-users dollar2 icon-rounded"></i>
                                    <div class="stats">
                                        <h5><strong>{{ $activeJobPostingCount }}</strong></h5>
                                        <span>Chiến dịch đang chạy</span>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="clearfix"></div>
                    </div>
                    <br>


                    <script src="{{ asset('backend_admin/js/dropzone.min.js') }}"></script>
                    <!-- for amcharts js -->

                    <script src="{{ asset('backend_admin/js/amcharts.js') }}"></script>
                    <script src="{{ asset('backend_admin/js/serial.js') }}"></script>
                    <script src="{{ asset('backend_admin/js/export.min.js') }}"></script>
                    <link rel="stylesheet" href="{{ asset('backend_admin/css/export.css') }}" type="text/css" media="all" />
                    <script src="{{ asset('backend_admin/js/light.js') }}"></script>
                    <!-- for amcharts js -->
                    <script src="{{ asset('backend_admin/js/index1.js') }}"></script>
                    <script src="{{ asset('backend_admin/js/index.js') }}"></script>
                    <script src="{{ asset('backend_admin/js/index2.js') }}"></script>
                   <div class="col-md-12" style="max-height: 80vh; overflow-y: auto;">

                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @yield('content')
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>

            <!--footer-->
            <div class="footer">
                <p>
                    &copy; 2018 Glance Design Dashboard. All Rights Reserved | Design by
                    <a href="#" target="_blank">w3layouts</a>
                </p>
            </div>
            <!--//footer-->
        </div>
    @else
        @yield('content_login')
    @endif

    <script src="{{ asset('backend_admin/js/classie.js') }}"></script>
    <script>
        var menuLeft = document.getElementById('cbp-spmenu-s1'),
            showLeftPush = document.getElementById('showLeftPush'),
            body = document.body;

        showLeftPush.onclick = function () {
            classie.toggle(this, 'active');
            classie.toggle(body, 'cbp-spmenu-push-toright');
            classie.toggle(menuLeft, 'cbp-spmenu-open');
            disableOther('showLeftPush');
        };

        function disableOther(button) {
            if (button !== 'showLeftPush') {
                classie.toggle(showLeftPush, 'disabled');
            }
        }
    </script>
    <script src="{{ asset('backend_admin/js/jquery.nicescroll.js') }}"></script>
    <script src="{{ asset('backend_admin/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('backend_admin/js/scripts.js') }}"></script>
    <!--//scrolling js-->
    <!-- side nav js -->
    <script src="{{ asset('backend_admin/js/SidebarNav.min.js') }}" type="text/javascript"></script>
    <script>
        $('.sidebar-menu').SidebarNav();
    </script>
    <script src="{{ asset('backend_admin/js/bootstrap.js') }}"></script>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">

    <!-- Include DataTables JavaScript -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#user-table').DataTable();
        });
    </script>
    <script>
        CKEDITOR.replace('summary2');
        CKEDITOR.replace('summary6');
        CKEDITOR.replace('description');
    </script>

    <script src="{{ asset('backend_admin/js/utils.js') }}"></script>

    <link rel="stylesheet" href="https://cdn.bootcdn.net/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <script src="https://cdn.bootcdn.net/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@3.1.0/dist/js/multi-select-tag.js"></script>
    <script>
        new MultiSelectTag('countries') // id
    </script>
    <script>
        new MultiSelectTag('genres')
    </script>
    <script>
        new MultiSelectTag('categories')
    </script>
</body>

</html>
