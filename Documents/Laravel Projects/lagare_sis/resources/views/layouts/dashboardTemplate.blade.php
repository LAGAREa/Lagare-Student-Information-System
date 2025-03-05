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
        }
        
        .sidebar {
            min-height: 100vh;
            background-color: #4e73df;
            background-image: linear-gradient(180deg, #4e73df 10%, #224abe 100%);
            width: 14rem;
            transition: width 0.15s ease-in-out;
        }
        
        .sidebar.toggled {
            width: 6.5rem;
        }
        
        .sidebar.toggled .nav-link span {
            display: none;
        }
        
        .sidebar.toggled .sidebar-brand-text {
            display: none;
        }
        
        .sidebar-brand {
            height: 4.375rem;
            text-decoration: none;
            font-size: 1rem;
            font-weight: 800;
            padding: 1.5rem 1rem;
            text-align: center;
            text-transform: uppercase;
            letter-spacing: 0.05rem;
            z-index: 1;
        }

        .nav-item {
            position: relative;
        }

        .nav-link {
            color: rgba(255, 255, 255, 0.8);
            padding: 1rem;
            width: 100%;
            font-weight: 500;
            font-size: 0.85rem;
            display: flex;
            align-items: center;
        }

        .nav-link:hover {
            color: #fff;
            background-color: rgba(255, 255, 255, 0.1);
        }

        .nav-link.active {
            color: #fff;
            font-weight: 600;
        }

        .nav-link i {
            min-width: 2rem;
            font-size: 0.85rem;
            text-align: center;
        }

        .topbar {
            height: 4.375rem;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
        }

        .topbar .navbar-nav {
            display: flex;
            align-items: center;
            padding-right: 1rem;
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
        }

        .dropdown-item:active {
            background-color: #4e73df;
        }

        .content-wrapper {
            min-height: 100vh;
            padding: 1.5rem;
            background-color: #f8f9fc;
        }

        .img-profile {
            height: 2rem;
            width: 2rem;
        }

        .topbar .nav-item .nav-link .user-name {
            margin-right: 0.5rem;
            color: #3a3b45;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 6.5rem;
            }
            
            .sidebar .nav-link span {
                display: none;
            }
            
            .sidebar .sidebar-brand-text {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="d-flex align-items-center justify-content-between" style="padding: 1rem;">
                <a class="sidebar-brand-text text-white text-decoration-none" href="{{ Auth::user()->role == 'admin' ? route('admin.dashboard') : route('student.dashboard') }}" style="font-weight: bold; font-size: 1rem;">
                    {{ Auth::user()->role == 'admin' ? 'ADMIN' : 'STUDENT' }}
                </a>
                <button class="border-0 bg-transparent p-0" id="sidebarToggle" style="color: white;">
                    <i class="fas fa-bars" style="font-size: 1.4rem;"></i>
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
        <div class="flex-grow-1">
            <!-- Top Navigation -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                <!-- Sidebar Toggle (Mobile) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none">
                    <i class="fa fa-bars"></i>
                </button>

                <!-- Topbar Navbar -->
                <ul class="navbar-nav">
                    <!-- Nav Item - Notifications -->
                    <li class="nav-item dropdown no-arrow mx-1">
                        <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-bell fa-fw"></i>
                            <!-- Counter - Notifications -->
                            <span class="badge badge-danger badge-counter">0</span>
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
                            <span class="user-name d-none d-lg-inline">{{ Auth::user()->name }}</span>
                            <img class="img-profile rounded-circle"
                                src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=4e73df&color=ffffff">
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-end shadow animated--grow-in"
                            aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                Profile
                            </a>
                            <div class="dropdown-divider"></div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </button>
                            </form>
                        </div>
                    </li>
                </ul>
            </nav>

            <!-- Main Content -->
            <div class="content-wrapper">
                @yield('content')
            </div>
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
    </script>

    @stack('scripts')
</body>

</html>