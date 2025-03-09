@extends('layouts.dashboardTemplate')

@section('title', 'Admin Dashboard')

@section('content')
    <div class="container">
        <h1 class="my-4">Admin Dashboard</h1>
        
        <div class="row">
            <!-- Twitter-like Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card dashboard-card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="icon-circle bg-cyan">
                                <i class="fas fa-users text-white"></i>
                            </div>
                            <div class="ms-3">
                                <div class="stat-label">Students</div>
                                <div class="stat-value">{{ $studentCount ?? '0' }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Analytics-like Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card dashboard-card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="icon-circle bg-pink">
                                <i class="fas fa-chart-bar text-white"></i>
                            </div>
                            <div class="ms-3">
                                <div class="stat-label">Enrollments</div>
                                <div class="stat-value">{{ $enrollmentCount ?? '0' }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Revenue Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card dashboard-card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="icon-circle bg-green">
                                <i class="fas fa-book text-white"></i>
                            </div>
                            <div class="ms-3">
                                <div class="stat-label">Subjects</div>
                                <div class="stat-value">{{ $subjectCount ?? '0' }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Storage Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card dashboard-card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="icon-circle bg-orange">
                                <i class="fas fa-star text-white"></i>
                            </div>
                            <div class="ms-3">
                                <div class="stat-label">Grades</div>
                                <div class="stat-value">{{ $gradeCount ?? '0' }}</div>
                            </div>
                        </div>
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
                                            <span class="status-badge status-passed">Passed</span>
                                        @else
                                            <span class="status-badge status-failed">Failed</span>
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
    .dashboard-card {
        border: none;
        border-radius: 10px;
        box-shadow: 0 0 15px rgba(0,0,0,0.1);
        transition: transform 0.2s;
    }
    .dashboard-card:hover {
        transform: translateY(-5px);
    }
    .icon-circle {
        width: 48px;
        height: 48px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .icon-circle i {
        font-size: 20px;
    }
    .bg-cyan {
        background-color: #00c3d9;
    }
    .bg-pink {
        background-color: #e91e63;
    }
    .bg-green {
        background-color: #4caf50;
    }
    .bg-orange {
        background-color: #ff9800;
    }
    .stat-label {
        color: #6c757d;
        font-size: 0.875rem;
    }
    .stat-value {
        color: #2c3e50;
        font-size: 1.5rem;
        font-weight: bold;
    }

    /* Status badge styles */
    .status-badge {
        padding: 0.25rem 0.75rem;
        border-radius: 9999px;
        font-weight: 500;
        font-size: 0.875rem;
        text-align: center;
        display: inline-block;
    }

    .status-passed {
        background-color: #10B981;
        color: white;
    }

    .status-failed {
        background-color: #EF4444;
        color: white;
    }
    </style>
@endsection