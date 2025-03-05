@extends('layouts.dashboardTemplate')

@section('title', 'Subjects')

@section('content')
    <div class="container">
        <h1 class="my-4">Subjects</h1>
        <a href="{{ route('admin.subjects.create') }}" class="btn btn-primary mb-3">Add Subject</a>
        
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Subjects List</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Subject Code</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Units</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($subjects as $subject)
                                <tr>
                                    <td>{{ $subject->subject_code }}</td>
                                    <td>{{ $subject->name }}</td>
                                    <td>{{ $subject->description }}</td>
                                    <td>{{ $subject->units }}</td>
                                    <td>
                                        <a href="{{ route('admin.subjects.show', $subject) }}" class="btn btn-view btn-sm">
                                            View
                                        </a>
                                        <a href="{{ route('admin.subjects.edit', $subject) }}" class="btn btn-edit btn-sm">
                                            Edit
                                        </a>
                                        <button type="button" class="btn btn-delete btn-sm delete-subject" 
                                                data-id="{{ $subject->id }}"
                                                data-url="{{ route('admin.subjects.destroy', $subject) }}">
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
                    search: "Search registered subjects:",
                    paginate: {
                        first: "First",
                        last: "Last",
                        next: "Next",
                        previous: "Previous"
                    }
                }
            });

            // Handle delete button clicks
            $('.delete-subject').click(function() {
                var button = $(this);
                var url = button.data('url');
                confirmDelete(url, table, button.closest('tr'));
            });
        });
    </script>
@endsection