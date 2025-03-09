@extends('layouts.dashboardTemplate')

@section('title', 'Student Dashboard')

@section('content')
    <div class="container">
        <h1 class="my-4">Student Dashboard</h1>
        
        <div class="row">
            <!-- Enrolled Subjects Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card dashboard-card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="icon-circle bg-cyan">
                                <i class="fas fa-book text-white"></i>
                            </div>
                            <div class="ms-3">
                                <div class="stat-label">Enrolled Subjects</div>
                                <div class="stat-value">{{ $enrolledSubjectsCount }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Passed Subjects Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card dashboard-card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="icon-circle bg-pink">
                                <i class="fas fa-check-circle text-white"></i>
                            </div>
                            <div class="ms-3">
                                <div class="stat-label">Passed Subjects</div>
                                <div class="stat-value">{{ $passedSubjectsCount }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- GPA Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card dashboard-card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="icon-circle bg-green">
                                <i class="fas fa-chart-line text-white"></i>
                            </div>
                            <div class="ms-3">
                                <div class="stat-label">GPA</div>
                                <div class="stat-value">{{ number_format($gpa, 2) }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Current Subjects Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card dashboard-card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="icon-circle bg-orange">
                                <i class="fas fa-clock text-white"></i>
                            </div>
                            <div class="ms-3">
                                <div class="stat-label">Current Subjects</div>
                                <div class="stat-value">{{ $currentSubjects->count() }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Row -->
        <div class="row">
            <!-- Current Subjects List -->
            <div class="col-xl-6 col-lg-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Current Subjects</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Subject Code</th>
                                        <th>Subject Name</th>
                                        <th>Units</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($currentSubjects as $subject)
                                    <tr>
                                        <td>{{ $subject->subject_code }}</td>
                                        <td>{{ $subject->name }}</td>
                                        <td>{{ $subject->units }}</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="3" class="text-center">No current subjects</td>
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
                                        <th>Subject</th>
                                        <th>Grade</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($recentGrades as $grade)
                                    <tr>
                                        <td>{{ $grade->subject->name }}</td>
                                        <td>{{ $grade->grade }}</td>
                                        <td>
                                            @if($grade->grade >= 1.0 && $grade->grade <= 2.75)
                                                <span class="badge badge-success">Passed</span>
                                            @else
                                                <span class="badge badge-danger">Failed</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="3" class="text-center">No grades yet</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
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
    .badge-success {
        background-color: #4caf50;
        color: white;
        padding: 0.4em 0.8em;
        border-radius: 4px;
    }
    .badge-danger {
        background-color: #f44336;
        color: white;
        padding: 0.4em 0.8em;
        border-radius: 4px;
    }
    </style>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable({
            pageLength: 10,
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
            order: [[0, 'asc']],
            dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>' +
                 '<"row"<"col-sm-12"tr>>' +
                 '<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
            language: {
                lengthMenu: "Show _MENU_ entries",
                info: "Showing _START_ to _END_ of _TOTAL_ entries",
                infoEmpty: "Showing 0 to 0 of 0 entries",
                infoFiltered: "(filtered from _MAX_ total entries)",
                search: "Search grades:",
                paginate: {
                    first: "First",
                    last: "Last",
                    next: "Next",
                    previous: "Previous"
                }
            }
        });
    });
</script>
@endpush 