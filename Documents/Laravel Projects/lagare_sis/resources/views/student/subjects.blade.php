@extends('layouts.dashboardTemplate')

@section('title', 'My Subjects')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">My Subjects</h1>
    </div>

    <!-- Content Row -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Enrolled Subjects</h6>
        </div>
        <div class="card-body">
            @if(count($subjects) > 0)
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
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
                                    <td>{{ $subject->subject_code }}</td>
                                    <td>{{ $subject->name }}</td>
                                    <td>{{ $subject->description }}</td>
                                    <td>{{ $subject->units }}</td>
                                    <td>
                                        @if($grade)
                                            @if($grade->grade >= 1.0 && $grade->grade <= 2.75)
                                                <span class="badge badge-success">Passed ({{ $grade->grade }})</span>
                                            @else
                                                <span class="badge badge-danger">Failed ({{ $grade->grade }})</span>
                                            @endif
                                        @else
                                            <span class="badge badge-info">Ongoing</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-center">You are not enrolled in any subjects.</p>
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
            }
        });
    });
</script>
@endpush

<style>
.badge {
    padding: 0.5em 1em;
    font-size: 0.75rem;
}
.badge-success {
    background-color: #1cc88a;
    color: white;
}
.badge-danger {
    background-color: #e74a3b;
    color: white;
}
.badge-info {
    background-color: #36b9cc;
    color: white;
}
</style> 