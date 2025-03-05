@extends('layouts.dashboardTemplate')

@section('title', 'Grade Details')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Grade Details</h6>
                    <a href="{{ route('admin.grades') }}" class="btn btn-primary btn-sm">Back to List</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tr>
                                <th width="30%">Student Name</th>
                                <td>{{ $grade->student->name }}</td>
                            </tr>
                            <tr>
                                <th>Student ID</th>
                                <td>{{ $grade->student->student_id }}</td>
                            </tr>
                            <tr>
                                <th>Subject Code</th>
                                <td>{{ $grade->subject->subject_code }}</td>
                            </tr>
                            <tr>
                                <th>Subject Name</th>
                                <td>{{ $grade->subject->name }}</td>
                            </tr>
                            <tr>
                                <th>Grade</th>
                                <td>{{ $grade->grade }}</td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>
                                    @if($grade->grade >= 1.0 && $grade->grade <= 2.75)
                                        <span class="badge badge-success">Passed</span>
                                    @else
                                        <span class="badge badge-danger">Failed</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Created At</th>
                                <td>{{ $grade->created_at->format('F d, Y h:i A') }}</td>
                            </tr>
                            <tr>
                                <th>Updated At</th>
                                <td>{{ $grade->updated_at->format('F d, Y h:i A') }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="mt-3">
                        <a href="{{ route('admin.grades.edit', $grade) }}" class="btn btn-edit">Edit Grade</a>
                        <button type="button" class="btn btn-delete delete-grade" 
                                data-id="{{ $grade->id }}"
                                data-url="{{ route('admin.grades.destroy', $grade) }}">
                            Delete Grade
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
        $('.delete-grade').click(function() {
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
                                'Grade has been deleted.',
                                'success'
                            ).then(() => {
                                window.location.href = "{{ route('admin.grades') }}";
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