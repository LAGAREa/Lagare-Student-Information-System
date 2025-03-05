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
                                        @if($grade->grade >= 1.0 && $grade->grade <= 2.75)
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
                                        <button type="button" class="btn btn-delete btn-sm delete-item" 
                                                data-url="{{ route('admin.grades.destroy', $grade) }}">
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-end mt-3">
                        {{ $grades->onEachSide(2)->links() }}
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
                    search: "Search registered grades:",
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
        .badge-success {
            background-color: #1cc88a;
        }
        .badge-danger {
            background-color: #e74a3b;
        }
        .pagination {
            margin: 0;
        }
        .page-item.active .page-link {
            background-color: #4e73df;
            border-color: #4e73df;
        }
        .page-link {
            color: #4e73df;
        }
        .page-link:hover {
            color: #2e59d9;
        }
    </style>
@endsection