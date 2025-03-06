@extends('layouts.dashboardTemplate')

@section('title', 'Admin Dashboard')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- Students Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="icon-square bg-info text-white me-3">
                            <i class="fas fa-users"></i>
                        </div>
                        <div>
                            <div class="text-xs text-muted text-uppercase">Students</div>
                            <div class="h4 mb-0 font-weight-bold">{{ number_format($studentCount ?? 0) }}</div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <small class="text-muted">
                            <i class="fas fa-clock me-1"></i> Total Registered Students
                        </small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Subjects Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="icon-square bg-danger text-white me-3">
                            <i class="fas fa-book"></i>
                        </div>
                        <div>
                            <div class="text-xs text-muted text-uppercase">Subjects</div>
                            <div class="h4 mb-0 font-weight-bold">{{ number_format($subjectCount ?? 0) }}</div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <small class="text-muted">
                            <i class="fas fa-list me-1"></i> Available Subjects
                        </small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Enrollments Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="icon-square bg-success text-white me-3">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        <div>
                            <div class="text-xs text-muted text-uppercase">Enrollments</div>
                            <div class="h4 mb-0 font-weight-bold">{{ number_format($enrollmentCount ?? 0) }}</div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <small class="text-muted">
                            <i class="far fa-calendar me-1"></i> Total Enrollments
                        </small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Grades Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="icon-square bg-warning text-white me-3">
                            <i class="fas fa-star"></i>
                        </div>
                        <div>
                            <div class="text-xs text-muted text-uppercase">Grades</div>
                            <div class="h4 mb-0 font-weight-bold">{{ number_format($gradeCount ?? 0) }}</div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <small class="text-muted">
                            <i class="fas fa-check-circle me-1"></i> Total Grades Recorded
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- Recent Enrollments -->
        <div class="col-xl-6 col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Recent Enrollments</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Student</th>
                                    <th>Subject</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentEnrollments ?? [] as $enrollment)
                                <tr>
                                    <td>{{ $enrollment->student->name }}</td>
                                    <td>{{ $enrollment->subject->name }}</td>
                                    <td>{{ $enrollment->created_at->format('M d, Y') }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="text-center">No recent enrollments</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Grades -->
        <div class="col-xl-6 col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Recent Grades</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Student</th>
                                    <th>Subject</th>
                                    <th>Grade</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentGrades ?? [] as $grade)
                                <tr>
                                    <td>{{ $grade->student->name }}</td>
                                    <td>{{ $grade->subject->name }}</td>
                                    <td>{{ $grade->grade }}</td>
                                    <td>
                                        @if($grade->grade >= 1.0 && $grade->grade <= 2.75)
                                            <span class="badge bg-success">Passed</span>
                                        @else
                                            <span class="badge bg-danger">Failed</span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center">No recent grades</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .card {
            transition: all 0.3s ease;
            border: none;
            background: #fff;
            border-radius: 0.5rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .card-body {
            padding: 1.5rem;
        }
        .icon-square {
            width: 56px;
            height: 56px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 0.375rem;
        }
        .icon-square i {
            font-size: 1.5rem;
        }
        .bg-info {
            background-color: #00acee !important;
        }
        .bg-danger {
            background-color: #e91e63 !important;
        }
        .bg-success {
            background-color: #4CAF50 !important;
        }
        .bg-warning {
            background-color: #ff9800 !important;
        }
        .text-muted {
            color: #858796 !important;
        }
        .me-3 {
            margin-right: 1rem !important;
        }
        .me-1 {
            margin-right: 0.25rem !important;
        }
        .mt-3 {
            margin-top: 1rem !important;
        }
        .text-xs {
            font-size: 0.75rem;
        }
        .h4 {
            font-size: 1.5rem;
            line-height: 1.2;
        }
        .badge {
            padding: 0.5em 1em;
            font-weight: 500;
            border-radius: 0.25rem;
        }
        .table td, .table th {
            vertical-align: middle;
        }
    </style>
@endsection