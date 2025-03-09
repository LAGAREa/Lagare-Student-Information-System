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
            <div class="ml-auto">
                <input type="text" id="searchInput" class="form-control form-control-sm" placeholder="Search...">
            </div>
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
        var table = $('#dataTable').DataTable({
            paging: false,
            info: false,
            dom: 'rt',
            order: [[0, 'asc']]
        });

        // Custom search functionality
        $('#searchInput').on('keyup', function() {
            table.search(this.value).draw();
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
    color: #0C6291;
}
.table-hover tbody tr:hover {
    background-color: #f8f9fc;
}
.card-header {
    background-color: #f8f9fc;
    border-bottom: 1px solid #e3e6f0;
}
#searchInput {
    width: 250px;
    padding: 0.375rem 0.75rem;
    font-size: 0.875rem;
    line-height: 1.5;
    color: #6e707e;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #d1d3e2;
    border-radius: 0.35rem;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}
#searchInput:focus {
    border-color: #bac8f3;
    outline: 0;
    box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
}
</style> 