@extends('layouts.dashboardTemplate')

@section('title', 'Grades')

@section('content')
<div class="container">
    <h1 class="my-4">Grades</h1>
    <a href="{{ route('admin.grades.create') }}" class="btn btn-primary mb-3">Add Grade</a>
    
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Grades Management</h6>
            <div class="ml-auto">
                <input type="text" id="searchInput" class="form-control form-control-sm" placeholder="Search...">
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="gradesTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="bg-primary text-white">Student</th>
                            <th class="bg-primary text-white">Subject</th>
                            <th class="bg-primary text-white">Grade</th>
                            <th class="bg-primary text-white">Status</th>
                            <th class="bg-primary text-white" style="width: 150px">Actions</th>
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
                                    <span class="badge bg-success">Passed</span>
                                @else
                                    <span class="badge bg-danger">Failed</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('admin.grades.show', $grade->id) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.grades.edit', $grade->id) }}" class="btn btn-sm btn-primary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button" class="btn btn-sm btn-danger delete-grade" 
                                            data-id="{{ $grade->id }}"
                                            data-student="{{ $grade->student->name }}"
                                            data-subject="{{ $grade->subject->name }}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-end">
                    {{ $grades->links('pagination::bootstrap-4') }}
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
.badge {
    padding: 0.5em 1em;
    font-size: 0.75rem;
    font-weight: 600;
}
.bg-success {
    background-color: #1cc88a !important;
}
.bg-danger {
    background-color: #e74a3b !important;
}
</style>

@push('scripts')
<script>
$(document).ready(function() {
    // Initialize DataTable with search only
    var table = $('#gradesTable').DataTable({
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
    $('.delete-grade').click(function() {
        var button = $(this);
        var gradeId = button.data('id');
        var studentName = button.data('student');
        var subjectName = button.data('subject');

        Swal.fire({
            title: 'Are you sure?',
            text: `Delete grade for ${studentName} in ${subjectName}?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/admin/grades/${gradeId}`,
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