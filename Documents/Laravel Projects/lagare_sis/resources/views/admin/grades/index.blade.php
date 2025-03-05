@extends('layouts.dashboardTemplate')

@section('title', 'Grades')

@section('content')
    <div class="container">
        <h1 class="my-4">Grades</h1>
        <a href="{{ route('admin.grades.create') }}" class="btn btn-primary mb-3">Add Grade</a>
        
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Grades List</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Student</th>
                                <th>Subject</th>
                                <th>Grade</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($grades as $grade)
                                <tr>
                                    <td>{{ $grade->student->name }}</td>
                                    <td>{{ $grade->subject->name }}</td>
                                    <td>{{ $grade->grade }}</td>
                                    <td>
                                        @if($grade->grade >= 75)
                                            <span class="badge badge-success">Passed</span>
                                        @else
                                            <span class="badge badge-danger">Failed</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.grades.show', $grade) }}" class="btn btn-view btn-sm">
                                            View
                                        </a>
                                        <a href="{{ route('admin.grades.edit', $grade) }}" class="btn btn-edit btn-sm">
                                            Edit
                                        </a>
                                        <button type="button" class="btn btn-delete btn-sm delete-grade" 
                                                data-id="{{ $grade->id }}"
                                                data-url="{{ route('admin.grades.destroy', $grade) }}">
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @include('partials.datatables-scripts')

    <script>
        $(document).ready(function() {
            var table = $('#dataTable').DataTable({
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
                    search: "Search registered grades:",
                    paginate: {
                        first: "First",
                        last: "Last",
                        next: "Next",
                        previous: "Previous"
                    }
                }
            });

            // Handle delete button clicks
            $('.delete-grade').click(function() {
                var button = $(this);
                var url = button.data('url');
                confirmDelete(url, table, button.closest('tr'));
            });
        });
    </script>
@endsection