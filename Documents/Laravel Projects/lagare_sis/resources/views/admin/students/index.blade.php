@extends('layouts.dashboardTemplate')

@section('title', 'Students')

@section('content')
    <div class="container">
        <h1 class="my-4">Students</h1>
        <a href="{{ route('admin.students.create') }}" class="btn btn-primary mb-3">Add Student</a>
        
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Students List</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Student ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Course</th>
                                <th>Year Level</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($students as $student)
                                <tr>
                                    <td>{{ $student->student_id }}</td>
                                    <td>{{ $student->name }}</td>
                                    <td>{{ $student->email }}</td>
                                    <td>{{ $student->course }}</td>
                                    <td>{{ $student->year_level }}</td>
                                    <td>
                                        <a href="{{ route('admin.students.show', $student) }}" class="btn btn-view btn-sm">
                                            View
                                        </a>
                                        <a href="{{ route('admin.students.edit', $student) }}" class="btn btn-edit btn-sm">
                                            Edit
                                        </a>
                                        <button type="button" class="btn btn-delete btn-sm delete-student" 
                                                data-id="{{ $student->id }}"
                                                data-url="{{ route('admin.students.destroy', $student) }}">
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-end mt-3">
                        {{ $students->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('partials.datatables-scripts')

    <script>
        $(document).ready(function() {
            var table = $('#dataTable').DataTable({
                paging: false,  // Disable DataTables pagination since we're using Laravel's
                ordering: true,
                order: [[0, 'asc']],
                dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>' +
                     '<"row"<"col-sm-12"tr>>',
                language: {
                    search: "Search registered students:",
                    info: "_TOTAL_ entries",
                    infoEmpty: "0 entries",
                    infoFiltered: "(filtered from _MAX_ total entries)"
                }
            });

            // Handle delete button clicks
            $('.delete-student').click(function() {
                var button = $(this);
                var url = button.data('url');
                confirmDelete(url, table, button.closest('tr'));
            });
        });
    </script>
@endsection