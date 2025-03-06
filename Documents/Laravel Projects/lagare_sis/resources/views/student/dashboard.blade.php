@extends('layouts.dashboardTemplate')

@section('title', 'Student Dashboard')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Student Dashboard</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- Total Subjects Card -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="icon-square bg-info text-white me-3">
                            <i class="fas fa-book"></i>
                        </div>
                        <div>
                            <div class="text-xs text-muted text-uppercase">Total Subjects</div>
                            <div class="h4 mb-0 font-weight-bold">{{ number_format($enrolledSubjectsCount ?? 0) }}</div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <small class="text-muted">
                            <i class="fas fa-list me-1"></i> Currently Enrolled Subjects
                        </small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Passed Subjects Card -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="icon-square bg-success text-white me-3">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div>
                            <div class="text-xs text-muted text-uppercase">Passed Subjects</div>
                            <div class="h4 mb-0 font-weight-bold">{{ number_format($passedSubjectsCount ?? 0) }}</div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <small class="text-muted">
                            <i class="fas fa-trophy me-1"></i> Successfully Completed
                        </small>
                    </div>
                </div>
            </div>
        </div>

        <!-- GPA Card -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="icon-square bg-warning text-white me-3">
                            <i class="fas fa-star"></i>
                        </div>
                        <div>
                            <div class="text-xs text-muted text-uppercase">Current GPA</div>
                            <div class="h4 mb-0 font-weight-bold">{{ number_format($gpa ?? 0, 2) }}</div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <small class="text-muted">
                            <i class="fas fa-chart-line me-1"></i> Overall Performance
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- Current Subjects -->
        <div class="col-xl-6 col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Current Subjects</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Subject Code</th>
                                    <th>Subject Name</th>
                                    <th>Units</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($currentSubjects ?? [] as $subject)
                                <tr>
                                    <td class="align-middle">{{ $subject->subject_code }}</td>
                                    <td class="align-middle">{{ $subject->name }}</td>
                                    <td class="align-middle">{{ $subject->units }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="text-center py-3 text-muted">No current subjects</td>
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
                <div class="card-header py-3 d-flex align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Recent Grades</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Subject</th>
                                    <th>Grade</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentGrades ?? [] as $grade)
                                <tr>
                                    <td class="align-middle">{{ $grade->subject->name }}</td>
                                    <td class="align-middle">{{ $grade->grade }}</td>
                                    <td class="align-middle">
                                        @if($grade->grade >= 1.0 && $grade->grade <= 2.75)
                                            <span class="badge bg-success">Passed</span>
                                        @else
                                            <span class="badge bg-danger">Failed</span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="text-center py-3 text-muted">No grades available</td>
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
            padding: 1rem;
            border-top: 1px solid #e3e6f0;
        }
        .table thead th {
            border-bottom: 2px solid #e3e6f0;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.8rem;
            color: #4e73df;
        }
        .table-hover tbody tr:hover {
            background-color: #f8f9fc;
        }
        .card-header {
            background-color: #f8f9fc;
            border-bottom: 1px solid #e3e6f0;
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