@extends('layouts.dashboardTemplate')

@section('title', 'Student Details')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Student Details</h6>
                    <a href="{{ route('admin.students') }}" class="btn btn-primary btn-sm">Back to List</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tr>
                                <th width="30%">Student ID</th>
                                <td>{{ $student->student_id }}</td>
                            </tr>
                            <tr>
                                <th>Name</th>
                                <td>{{ $student->name }}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>{{ $student->email }}</td>
                            </tr>
                            <tr>
                                <th>Course</th>
                                <td>{{ $student->course }}</td>
                            </tr>
                            <tr>
                                <th>Year Level</th>
                                <td>{{ $student->year_level }}</td>
                            </tr>
                            <tr>
                                <th>Created At</th>
                                <td>{{ $student->created_at->format('F d, Y h:i A') }}</td>
                            </tr>
                            <tr>
                                <th>Updated At</th>
                                <td>{{ $student->updated_at->format('F d, Y h:i A') }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="mt-3">
                        <a href="{{ route('admin.students.edit', $student) }}" class="btn btn-edit">Edit Student</a>
                        <button type="button" class="btn btn-delete delete-student" 
                                data-id="{{ $student->id }}"
                                data-url="{{ route('admin.students.destroy', $student) }}">
                            Delete Student
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('partials.datatables-scripts')

<script>
    $(document).ready(function() {
        // Handle delete button click
        $('.delete-student').click(function() {
            var button = $(this);
            var url = button.data('url');
            
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            Swal.fire(
                                'Deleted!',
                                'Student has been deleted.',
                                'success'
                            ).then(() => {
                                window.location.href = "{{ route('admin.students') }}";
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
@endsection 