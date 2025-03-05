@extends('layouts.dashboardTemplate')

@section('title', 'Enrollment Details')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Enrollment Details</h6>
                    <a href="{{ route('admin.enrollments') }}" class="btn btn-primary btn-sm">Back to List</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tr>
                                <th width="30%">Student Name</th>
                                <td>{{ $enrollment->student->name }}</td>
                            </tr>
                            <tr>
                                <th>Student ID</th>
                                <td>{{ $enrollment->student->student_id }}</td>
                            </tr>
                            <tr>
                                <th>Course</th>
                                <td>{{ $enrollment->student->course }}</td>
                            </tr>
                            <tr>
                                <th>Year Level</th>
                                <td>{{ $enrollment->student->year_level }}</td>
                            </tr>
                            <tr>
                                <th>Subject Code</th>
                                <td>{{ $enrollment->subject->subject_code }}</td>
                            </tr>
                            <tr>
                                <th>Subject Name</th>
                                <td>{{ $enrollment->subject->name }}</td>
                            </tr>
                            <tr>
                                <th>Subject Units</th>
                                <td>{{ $enrollment->subject->units }}</td>
                            </tr>
                            <tr>
                                <th>Created At</th>
                                <td>{{ $enrollment->created_at->format('F d, Y h:i A') }}</td>
                            </tr>
                            <tr>
                                <th>Updated At</th>
                                <td>{{ $enrollment->updated_at->format('F d, Y h:i A') }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="mt-3">
                        <a href="{{ route('admin.enrollments.edit', $enrollment) }}" class="btn btn-edit">Edit Enrollment</a>
                        <button type="button" class="btn btn-delete delete-enrollment" 
                                data-id="{{ $enrollment->id }}"
                                data-url="{{ route('admin.enrollments.destroy', $enrollment) }}">
                            Delete Enrollment
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
        $('.delete-enrollment').click(function() {
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
                                'Enrollment has been deleted.',
                                'success'
                            ).then(() => {
                                window.location.href = "{{ route('admin.enrollments') }}";
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