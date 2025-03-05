@extends('layouts.dashboardTemplate')

@section('title', 'View Grades')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">My Grades</h1>
    </div>

    <!-- Content Row -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Grade List</h6>
        </div>
        <div class="card-body">
            @if(count($grades) > 0)
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Subject Code</th>
                                <th>Subject Name</th>
                                <th>Grade</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($grades as $grade)
                                <tr>
                                    <td>{{ $grade->subject->subject_code }}</td>
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
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-center">No grades available.</p>
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
                search: "Search grades:",
                info: "Showing _START_ to _END_ of _TOTAL_ grades",
                infoEmpty: "No grades found",
                infoFiltered: "(filtered from _MAX_ total grades)"
            }
        });
    });
</script>
@endpush

<style>
.badge-success {
    background-color: #1cc88a;
    color: white;
}
.badge-danger {
    background-color: #e74a3b;
    color: white;
}
</style>