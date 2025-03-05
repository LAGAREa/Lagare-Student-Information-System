@extends('layouts.dashboardTemplate')

@section('title', 'My Subjects')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">My Subjects</h1>
    </div>

    <!-- Content Row -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Enrolled Subjects</h6>
        </div>
        <div class="card-body">
            @if(count($subjects) > 0)
                <div class="table-responsive">
                    <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Subject Code</th>
                                <th>Subject Name</th>
                                <th>Description</th>
                                <th>Units</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($subjects as $subject)
                                @php
                                    $grade = $subject->grades()
                                        ->where('student_id', App\Models\Student::where('email', auth()->user()->email)->first()->id)
                                        ->first();
                                @endphp
                                <tr>
                                    <td class="align-middle">{{ $subject->subject_code }}</td>
                                    <td class="align-middle">{{ $subject->name }}</td>
                                    <td class="align-middle">{{ $subject->description }}</td>
                                    <td class="align-middle">{{ $subject->units }}</td>
                                    <td class="align-middle">
                                        @if($grade)
                                            @if($grade->grade >= 1.0 && $grade->grade <= 2.75)
                                                <span class="badge bg-success">Passed ({{ $grade->grade }})</span>
                                            @else
                                                <span class="badge bg-danger">Failed ({{ $grade->grade }})</span>
                                            @endif
                                        @else
                                            <span class="badge bg-info">Ongoing</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-center py-3 text-muted">You are not enrolled in any subjects.</p>
            @endif
        </div>
    </div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable({
            paging: false,
            dom: '<"row"<"col-sm-12 col-md-6"f>>',
            language: {
                search: "Search subjects:",
                info: "Showing _START_ to _END_ of _TOTAL_ subjects",
                infoEmpty: "No subjects found",
                infoFiltered: "(filtered from _MAX_ total subjects)"
            },
            order: [[0, 'asc']]
        });
    });
</script>
@endpush

<style>
.badge {
    padding: 0.5em 1em;
    font-size: 0.75rem;
    font-weight: 600;
}
.bg-success {
    background-color: var(--success-color) !important;
}
.bg-danger {
    background-color: var(--danger-color) !important;
}
.bg-info {
    background-color: var(--info-color) !important;
}
.table {
    margin-bottom: 0;
}
.table td, .table th {
    padding: 1rem;
    vertical-align: middle;
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