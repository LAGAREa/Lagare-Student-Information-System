@extends('layouts.dashboardTemplate')

@section('title', 'Students')

@section('content')
    <div class="container">
        <h1 class="my-4">Students</h1>
        <a href="{{ route('admin.students.create') }}" class="btn btn-primary mb-3">Add Student</a>
        
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Students Management</h6>
                <div class="ml-auto">
                    <input type="text" id="searchInput" class="form-control form-control-sm" placeholder="Search...">
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="studentsTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="bg-primary text-white">Student ID</th>
                                <th class="bg-primary text-white">Name</th>
                                <th class="bg-primary text-white">Email</th>
                                <th class="bg-primary text-white">Course</th>
                                <th class="bg-primary text-white">Year Level</th>
                                <th class="bg-primary text-white" style="width: 150px">Actions</th>
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
                                        <div class="btn-group">
                                            <a href="{{ route('admin.students.show', $student->id) }}" class="btn btn-sm btn-info">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.students.edit', $student->id) }}" class="btn btn-sm btn-primary">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button type="button" class="btn btn-sm btn-danger delete-student" 
                                                    data-id="{{ $student->id }}"
                                                    data-name="{{ $student->name }}"
                                                    data-student-id="{{ $student->student_id }}">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-end">
                        {{ $students->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
    .bg-primary {
        background-color: #4e73df !important;
    }
    .btn-group {
        display: flex;
        gap: 5px;
    }
    .btn-group .btn {
        border-radius: 4px !important;
    }
    .btn-primary {
        background-color: #0D6EFD !important;
        border-color: #0D6EFD !important;
    }
    .btn-primary:hover {
        background-color: #0b5ed7 !important;
        border-color: #0b5ed7 !important;
    }
    </style>

    @push('scripts')
    <script>
    $(document).ready(function() {
        // Initialize DataTable with search only
        var table = $('#studentsTable').DataTable({
            paging: false,
            info: false,
            dom: 'rt<"bottom"p><"clear">',
            order: [],
        });

        // Move the search input to our custom location
        $('#searchInput').on('keyup', function() {
            table.search(this.value).draw();
        });

        // Handle delete button click
        $('.delete-student').click(function() {
            var button = $(this);
            var studentId = button.data('id');
            var studentName = button.data('name');
            var studentIdNumber = button.data('student-id');

            Swal.fire({
                title: 'Are you sure?',
                text: `Delete student ${studentIdNumber} - ${studentName}?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `/admin/students/${studentId}`,
                        type: 'DELETE',
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            Swal.fire(
                                'Deleted!',
                                response.message,
                                'success'
                            ).then(() => {
                                button.closest('tr').remove();
                            });
                        },
                        error: function(xhr) {
                            Swal.fire(
                                'Error!',
                                xhr.responseJSON.message || 'Something went wrong!',
                                'error'
                            );
                        }
                    });
                }
            });
        });
    });
    </script>
    @endpush
@endsection