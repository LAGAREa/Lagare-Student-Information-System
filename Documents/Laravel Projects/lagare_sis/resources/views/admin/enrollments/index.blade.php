@extends('layouts.dashboardTemplate')

@section('title', 'Enrollments')

@section('content')
    <div class="container">
        <h1 class="my-4">Enrollments</h1>
        <a href="{{ route('admin.enrollments.create') }}" class="btn btn-primary mb-3">Add Enrollment</a>
        
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Enrollments List</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Student</th>
                                <th>Subject</th>
                                <th>Course</th>
                                <th>Year Level</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($enrollments as $enrollment)
                                <tr>
                                    <td>{{ $enrollment->student->name }}</td>
                                    <td>{{ $enrollment->subject->name }}</td>
                                    <td>{{ $enrollment->student->course }}</td>
                                    <td>{{ $enrollment->student->year_level }}</td>
                                    <td>
                                        <a href="{{ route('admin.enrollments.show', $enrollment) }}" class="btn btn-view btn-sm">
                                            View
                                        </a>
                                        <a href="{{ route('admin.enrollments.edit', $enrollment) }}" class="btn btn-edit btn-sm">
                                            Edit
                                        </a>
                                        <button type="button" class="btn btn-delete btn-sm delete-item" 
                                                data-url="{{ route('admin.enrollments.destroy', $enrollment) }}">
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-end mt-3">
                        {{ $enrollments->onEachSide(1)->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('partials.datatables-scripts')

    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var table = $('#dataTable').DataTable({
                paging: false,
                ordering: true,
                order: [[0, 'asc']],
                dom: '<"row"<"col-sm-12 col-md-6"f>>',
                language: {
                    search: "Search registered enrollments:",
                    info: "_TOTAL_ entries",
                    infoEmpty: "0 entries",
                    infoFiltered: "(filtered from _MAX_ total entries)"
                }
            });

            // Handle delete button clicks
            $(document).on('click', '.delete-item', function() {
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
                            success: function(response) {
                                Swal.fire(
                                    'Deleted!',
                                    'Record has been deleted successfully.',
                                    'success'
                                ).then(() => {
                                    button.closest('tr').remove();
                                });
                            },
                            error: function(xhr) {
                                Swal.fire(
                                    'Error!',
                                    xhr.responseJSON?.message || 'Cannot delete this record.',
                                    'error'
                                );
                            }
                        });
                    }
                });
            });
        });
    </script>

    <style>
        .pagination {
            margin: 0;
            display: flex;
            padding-left: 0;
            list-style: none;
        }
        .page-link {
            position: relative;
            display: block;
            padding: 8px 12px;
            margin: 0px 0px 0px -1px;
            font-family: "Nunito", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            font-size: 16px;
            line-height: 1.25;
            color: #4e73df;
            background-color: #fff;
            border: 1px solid #dddfeb;
        }
        .page-item:first-child .page-link {
            margin-left: 0;
            border-top-left-radius: 0.35rem;
            border-bottom-left-radius: 0.35rem;
        }
        .page-item:last-child .page-link {
            border-top-right-radius: 0.35rem;
            border-bottom-right-radius: 0.35rem;
        }
        .page-item.active .page-link {
            z-index: 3;
            color: #fff;
            background-color: #4E73DF;
            border-color: #4E73DF;
        }
        .page-item.disabled .page-link {
            color: #858796;
            pointer-events: none;
            cursor: auto;
            background-color: #fff;
            border-color: #dddfeb;
        }
        .page-link:hover {
            z-index: 2;
            color: #224abe;
            text-decoration: none;
            background-color: #eaecf4;
            border-color: #dddfeb;
        }
        .page-link:focus {
            z-index: 3;
            outline: 0;
            box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
        }
    </style>
@endsection