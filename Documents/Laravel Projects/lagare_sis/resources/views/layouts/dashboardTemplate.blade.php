<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - {{ config('app.name', 'Laravel') }}</title>

    <!-- Custom fonts for this template-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- DataTables -->
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #4e73df;
            --secondary-color: #858796;
            --success-color: #1cc88a;
            --info-color: #36b9cc;
            --warning-color: #f6c23e;
            --danger-color: #e74a3b;
            --sidebar-width: 14rem;
            --sidebar-width-collapsed: 6.5rem;
        }
        
        body {
            overflow-x: hidden;
        }

        .sidebar {
            width: var(--sidebar-width);
            min-height: 100vh;
            background: linear-gradient(180deg, #4e73df 10%, #224abe 100%);
            transition: all 0.3s ease-in-out;
            position: fixed;
            left: 0;
            top: 0;
            bottom: 0;
            z-index: 100;
        }
        
        .sidebar.toggled {
            width: var(--sidebar-width-collapsed);
        }

        .sidebar-header {
            padding: 1rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .sidebar.toggled .sidebar-header {
            justify-content: center;
            padding: 1rem 0;
        }

        .sidebar .nav-item {
            position: relative;
            margin: 0.5rem 0;
        }
        
        .sidebar .nav-link {
            display: flex;
            align-items: center;
            padding: 0.75rem 1rem;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            white-space: nowrap;
            transition: all 0.3s ease;
        }
        
        .sidebar .nav-link i {
            margin-right: 0.75rem;
            width: 1.5rem;
            font-size: 1.25rem;
            text-align: center;
            transition: all 0.3s ease;
        }
        
        .sidebar.toggled .nav-link {
            justify-content: center;
            padding: 1rem;
        }
        
        .sidebar.toggled .nav-link i {
            margin: 0;
            font-size: 1.25rem;
            width: auto;
        }
        
        .sidebar.toggled .nav-link span,
        .sidebar.toggled .sidebar-brand-text {
            display: none;
        }

        .sidebar .nav-item .nav-link:hover {
            color: #fff;
            background-color: rgba(255, 255, 255, 0.1);
            transform: translateX(5px);
        }

        .sidebar .nav-item.active .nav-link {
            color: #fff;
            font-weight: 600;
            background-color: rgba(255, 255, 255, 0.1);
        }

        #sidebarToggle {
            color: white;
            background: transparent;
            border: none;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 2rem;
            height: 2rem;
            transition: all 0.3s ease;
        }

        #sidebarToggle:hover {
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 0.25rem;
        }

        #sidebarToggle i {
            font-size: 1.2rem;
            transition: all 0.3s ease;
            transform: rotate(0deg);
        }

        .sidebar.toggled #sidebarToggle i:before {
            content: "\f0c9";
        }

        .sidebar.toggled #sidebarToggle i {
            transform: rotate(180deg);
        }

        .sidebar-divider {
            border-color: rgba(255,255,255,0.15);
            margin: 1rem 0;
        }

        #wrapper {
            display: flex;
            width: 100%;
            min-height: 100vh;
        }

        .content-wrapper {
            width: 100%;
            margin-left: var(--sidebar-width);
            transition: all 0.3s ease-in-out;
            min-height: 100vh;
            padding: 0;
            background-color: #f8f9fc;
            display: flex;
            flex-direction: column;
        }

        .container-fluid {
            padding: 1.5rem;
        }

        .sidebar.toggled ~ #content-wrapper {
            margin-left: var(--sidebar-width-collapsed);
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }
            
            .sidebar.toggled {
                transform: translateX(0);
            }
            
            .sidebar .nav-link {
                padding: 1rem;
                justify-content: center;
            }
            
            .sidebar .nav-link i {
                margin: 0;
                font-size: 1.25rem;
                width: auto;
            }
            
            .sidebar .nav-link span,
            .sidebar .sidebar-brand-text {
                display: none;
            }

            .content-wrapper {
                margin-left: 0;
                width: 100%;
            }

            .sidebar.toggled ~ #content-wrapper {
                margin-left: var(--sidebar-width-collapsed);
            }
        }

        .topbar {
            height: 4.375rem;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
            padding: 0 1.5rem;
            margin: 0;
            background-color: #fff;
        }

        .navbar {
            padding: 0;
        }

        .topbar .navbar-nav {
            display: flex;
            align-items: center;
            padding-right: 0;
            margin-left: auto;
        }

        .topbar .dropdown-toggle::after {
            display: none;
        }

        .topbar .nav-item .nav-link {
            color: #3a3b45;
            padding: 0 0.75rem;
            position: relative;
            height: 4.375rem;
            display: flex;
            align-items: center;
        }

        .topbar .nav-item .nav-link .badge-counter {
            position: absolute;
            transform: scale(0.7);
            transform-origin: top right;
            right: 0.25rem;
            margin-top: -0.25rem;
        }

        .dropdown-menu {
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
            min-width: 12rem;
            padding: 0.5rem 0;
            font-size: 0.85rem;
            border: none;
            border-radius: 0.35rem;
        }

        .dropdown-item {
            display: flex;
            align-items: center;
            padding: 0.5rem 1rem;
            white-space: nowrap;
            font-weight: 500;
        }

        .dropdown-item i {
            margin-right: 0.75rem;
            width: 1rem;
            text-align: center;
            font-size: 0.875rem;
        }

        .dropdown-item:hover {
            background-color: #f8f9fc;
            color: #4e73df;
        }

        .dropdown-item:active {
            background-color: #4e73df;
            color: #fff;
        }

        .dropdown-divider {
            margin: 0.5rem 0;
        }

        .img-profile {
            height: 2rem;
            width: 2rem;
            border: 2px solid #eaecf4;
        }

        .user-dropdown {
            display: flex;
            align-items: center;
            padding: 0.5rem 1rem;
            position: relative;
        }

        .user-dropdown .chevron {
            margin-left: 0.5rem;
            transition: transform 0.2s ease;
            color: #858796;
            font-size: 0.75rem;
        }

        .show .chevron {
            transform: rotate(180deg);
        }

        .user-dropdown .user-info {
            margin-right: 1rem;
            text-align: right;
        }

        .user-dropdown .user-name {
            display: block;
            font-weight: 600;
            font-size: 0.875rem;
            color: #3a3b45;
            margin-bottom: 0.125rem;
        }

        .user-dropdown .user-role {
            display: block;
            font-size: 0.75rem;
            color: #858796;
        }

        .footer {
            padding: 1.5rem;
            background-color: #fff;
            border-top: 1px solid #e3e6f0;
            margin-top: auto;
        }

        .footer .copyright {
            color: #858796;
            font-size: 0.875rem;
            text-align: center;
        }
    </style>
</head>

<body>
    <div id="wrapper">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="sidebar-header">
                <a class="sidebar-brand-text text-white text-decoration-none" href="{{ Auth::user()->role == 'admin' ? route('admin.dashboard') : route('student.dashboard') }}" style="font-weight: bold; font-size: 1rem;">
                    {{ Auth::user()->role == 'admin' ? 'ADMIN' : 'STUDENT' }}
                </a>
                <button class="btn p-0" id="sidebarToggle">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <!-- Divider -->
            <hr class="sidebar-divider my-0" style="border-color: rgba(255,255,255,0.15);">

            <!-- Nav Items -->
            @if(Auth::user()->role == 'admin')
                <!-- Admin Navigation -->
                <ul class="nav flex-column">
                    <li class="nav-item @if(request()->routeIs('admin.dashboard')) active @endif">
                        <a class="nav-link" href="{{ route('admin.dashboard') }}">
                            <i class="fas fa-fw fa-tachometer-alt"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item @if(request()->routeIs('admin.students*')) active @endif">
                        <a class="nav-link" href="{{ route('admin.students') }}">
                            <i class="fas fa-fw fa-users"></i>
                            <span>Students</span>
                        </a>
                    </li>
                    <li class="nav-item @if(request()->routeIs('admin.subjects*')) active @endif">
                        <a class="nav-link" href="{{ route('admin.subjects') }}">
                            <i class="fas fa-fw fa-book"></i>
                            <span>Subjects</span>
                        </a>
                    </li>
                    <li class="nav-item @if(request()->routeIs('admin.enrollments*')) active @endif">
                        <a class="nav-link" href="{{ route('admin.enrollments') }}">
                            <i class="fas fa-fw fa-clipboard-list"></i>
                            <span>Enrollments</span>
                        </a>
                    </li>
                    <li class="nav-item @if(request()->routeIs('admin.grades*')) active @endif">
                        <a class="nav-link" href="{{ route('admin.grades') }}">
                            <i class="fas fa-fw fa-star"></i>
                            <span>Grades</span>
                        </a>
                    </li>
                </ul>
            @else
                <!-- Student Navigation -->
                <ul class="nav flex-column">
                    <li class="nav-item @if(request()->routeIs('student.dashboard')) active @endif">
                        <a class="nav-link" href="{{ route('student.dashboard') }}">
                            <i class="fas fa-fw fa-tachometer-alt"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item @if(request()->routeIs('student.subjects')) active @endif">
                        <a class="nav-link" href="{{ route('student.subjects') }}">
                            <i class="fas fa-fw fa-book"></i>
                            <span>Subjects</span>
                        </a>
                    </li>
                    <li class="nav-item @if(request()->routeIs('student.view-grades')) active @endif">
                        <a class="nav-link" href="{{ route('student.view-grades') }}">
                            <i class="fas fa-fw fa-star"></i>
                            <span>Grades</span>
                        </a>
                    </li>
                </ul>
            @endif
        </div>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="content-wrapper">
            <!-- Top Navigation -->
            <nav class="navbar navbar-expand navbar-light topbar static-top shadow">
                <!-- Sidebar Toggle (Mobile) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none">
                    <i class="fa fa-bars"></i>
                </button>

                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Nav Item - Notifications -->
                    <li class="nav-item dropdown no-arrow mx-1">
                        <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-bell fa-fw"></i>
                            <!-- Counter - Notifications -->
                            @if($notificationCount ?? 0 > 0)
                                <span class="badge badge-danger badge-counter">{{ $notificationCount }}</span>
                            @endif
                        </a>
                        <!-- Dropdown - Notifications -->
                        <div class="dropdown-list dropdown-menu dropdown-menu-end shadow animated--grow-in"
                            aria-labelledby="alertsDropdown">
                            <h6 class="dropdown-header">
                                Notifications
                            </h6>
                            <a class="dropdown-item text-center small text-gray-500" href="#">No notifications</a>
                        </div>
                    </li>

                    <div class="topbar-divider d-none d-sm-block"></div>

                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="user-dropdown">
                                <div class="user-info">
                                    <span class="user-name">{{ Auth::user()->name }}</span>
                                    <span class="user-role">{{ ucfirst(Auth::user()->role) }}</span>
                                </div>
                                <img class="img-profile rounded-circle"
                                    src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=4e73df&color=ffffff">
                                <i class="fas fa-chevron-down chevron"></i>
                            </div>
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-end shadow animated--grow-in"
                            aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                <i class="fas fa-user fa-sm fa-fw text-gray-400"></i>
                                Profile Settings
                            </a>
                            <div class="dropdown-divider"></div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw text-gray-400"></i>
                                    Log Out
                                </button>
                            </form>
                        </div>
                    </li>
                </ul>
            </nav>

            <!-- Main Content -->
            <div class="container-fluid">
                @yield('content')
            </div>

            <!-- Footer -->
            <footer class="footer">
                <div class="copyright">
                    &copy; {{ date('Y') }} lagareDev. All rights reserved.
                </div>
            </footer>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

    <!-- Custom scripts -->
    <script>
        // Toggle sidebar
        $("#sidebarToggle, #sidebarToggleTop").on('click', function(e) {
            $(".sidebar").toggleClass("toggled");
        });

        // Close sidebar on small screens
        $(window).resize(function() {
            if ($(window).width() < 768) {
                $('.sidebar').addClass('toggled');
            }
        });

        // Handle dropdown chevron rotation
        $('#userDropdown').on('show.bs.dropdown', function () {
            $(this).find('.chevron').addClass('show');
        }).on('hide.bs.dropdown', function () {
            $(this).find('.chevron').removeClass('show');
        });
    </script>

    @stack('scripts')
</body>

</html>