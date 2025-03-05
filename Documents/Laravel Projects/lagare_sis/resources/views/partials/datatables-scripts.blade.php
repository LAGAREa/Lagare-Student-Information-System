<!-- DataTables CSS -->
<link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">

<style>
    .btn-view {
        background-color: #36b9cc;
        color: white;
    }
    .btn-view:hover {
        background-color: #2a8c9c;
        color: white;
    }
    .btn-edit {
        background-color: #f6c23e;
        color: white;
    }
    .btn-edit:hover {
        background-color: #dfa815;
        color: white;
    }
    .btn-delete {
        background-color: #e74a3b;
        color: white;
    }
    .btn-delete:hover {
        background-color: #be2617;
        color: white;
    }
    .table thead th {
        background-color: #4e73df;
        color: white;
        border-color: #4e73df;
    }
    .dataTables_wrapper .dataTables_filter {
        text-align: right;
        margin-bottom: 0.5rem;
    }
    .dataTables_wrapper .dataTables_filter input {
        margin-left: 0.5rem;
        border: 1px solid #d1d3e2;
        border-radius: 0.35rem;
        padding: 0.375rem 0.75rem;
    }
    .dataTables_wrapper .dataTables_filter input:focus {
        border-color: #bac8f3;
        box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
        outline: 0;
    }
</style>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // Set up CSRF token for all AJAX requests
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function initDataTable(tableId, orderColumn = 0) {
        return $(tableId).DataTable({
            pageLength: -1,
            lengthChange: false,
            ordering: true,
            order: [[orderColumn, 'asc']],
            dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>' +
                 '<"row"<"col-sm-12"tr>>',
            language: {
                search: "Search:",
                zeroRecords: "No matching records found",
                info: "Showing _TOTAL_ entries",
                infoEmpty: "Showing 0 entries",
                infoFiltered: "(filtered from _MAX_ total entries)"
            },
            columnDefs: [
                { orderable: false, targets: -1 } // Disable sorting on last column (Actions)
            ]
        });
    }

    // Function to get delete confirmation message based on type
    function getDeleteConfirmation(type) {
        switch(type) {
            case 'student':
                return {
                    title: 'Delete Student?',
                    text: 'This student will be permanently deleted. This action cannot be undone if the student has no enrollments or grades.',
                    warningText: 'Students with enrollments or grades cannot be deleted.'
                };
            case 'subject':
                return {
                    title: 'Delete Subject?',
                    text: 'This subject will be permanently deleted. This action cannot be undone if no students are enrolled.',
                    warningText: 'Subjects with enrolled students cannot be deleted.'
                };
            case 'enrollment':
                return {
                    title: 'Delete Enrollment?',
                    text: 'This enrollment will be permanently deleted. This action cannot be undone if there are no associated grades.',
                    warningText: 'Enrollments with grades cannot be deleted.'
                };
            case 'grade':
                return {
                    title: 'Delete Grade?',
                    text: 'This grade will be permanently deleted. This action cannot be undone.',
                    warningText: null
                };
            default:
                return {
                    title: 'Delete Record?',
                    text: 'This record will be permanently deleted. This action cannot be undone.',
                    warningText: null
                };
        }
    }

    // Function to handle delete confirmations
    function confirmDelete(url, table, row, type = 'record') {
        const confirmation = getDeleteConfirmation(type);
        
        Swal.fire({
            title: confirmation.title,
            text: confirmation.text,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#e74a3b',
            cancelButtonColor: '#858796',
            confirmButtonText: 'Yes, delete it',
            cancelButtonText: 'No, cancel',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: url,
                    type: 'DELETE',
                    success: function(response) {
                        Swal.fire({
                            title: 'Deleted!',
                            text: response.message,
                            icon: 'success',
                            confirmButtonColor: '#3085d6'
                        }).then(() => {
                            if (table) {
                                table.row(row).remove().draw();
                            } else {
                                row.remove();
                            }
                        });
                    },
                    error: function(xhr) {
                        const errorMessage = xhr.responseJSON?.message || confirmation.warningText || 'An error occurred while deleting.';
                        Swal.fire({
                            title: 'Cannot Delete',
                            text: errorMessage,
                            icon: 'error',
                            confirmButtonColor: '#3085d6'
                        });
                    }
                });
            }
        });
    }

    // Initialize delete buttons using event delegation
    $(document).ready(function() {
        // Handle student deletes
        $(document).on('click', '.delete-student', function(e) {
            e.preventDefault();
            var button = $(this);
            var url = button.data('url');
            var table = $('#dataTable').DataTable();
            confirmDelete(url, table, button.closest('tr'), 'student');
        });

        // Handle subject deletes
        $(document).on('click', '.delete-subject', function(e) {
            e.preventDefault();
            var button = $(this);
            var url = button.data('url');
            var table = $('#dataTable').DataTable();
            confirmDelete(url, table, button.closest('tr'), 'subject');
        });

        // Handle enrollment deletes
        $(document).on('click', '.delete-enrollment', function(e) {
            e.preventDefault();
            var button = $(this);
            var url = button.data('url');
            var table = $('#dataTable').DataTable();
            confirmDelete(url, table, button.closest('tr'), 'enrollment');
        });

        // Handle grade deletes
        $(document).on('click', '.delete-grade', function(e) {
            e.preventDefault();
            var button = $(this);
            var url = button.data('url');
            var table = $('#dataTable').DataTable();
            confirmDelete(url, table, button.closest('tr'), 'grade');
        });

        // Handle generic item deletes (fallback)
        $(document).on('click', '.delete-item', function(e) {
            e.preventDefault();
            var button = $(this);
            var url = button.data('url');
            var table = $('#dataTable').DataTable();
            confirmDelete(url, table, button.closest('tr'));
        });
    });

    // Show SweetAlert messages for session flash messages
    @if(session('error'))
        Swal.fire({
            title: 'Error!',
            text: "{{ session('error') }}",
            icon: 'error',
            confirmButtonColor: '#3085d6'
        });
    @endif

    @if(session('success'))
        Swal.fire({
            title: 'Success!',
            text: "{{ session('success') }}",
            icon: 'success',
            confirmButtonColor: '#3085d6'
        });
    @endif
</script> 