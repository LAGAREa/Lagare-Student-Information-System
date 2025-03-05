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
    .dataTables_wrapper .dataTables_length select {
        width: 60px;
    }
    .dataTables_wrapper .dataTables_filter input {
        border-radius: 4px;
        padding: 3px 8px;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        padding: 0.3em 0.8em;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background: #4e73df !important;
        border-color: #4e73df !important;
        color: white !important;
    }
    .table thead th {
        background-color: #4e73df;
        color: white;
        border-color: #4e73df;
    }
</style>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function initDataTable(tableId, orderColumn = 1) {
        return $(tableId).DataTable({
            pageLength: 10,
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
            order: [[orderColumn, 'asc']],
            language: {
                lengthMenu: "Show _MENU_ entries",
                info: "Showing _START_ to _END_ of _TOTAL_ entries",
                infoEmpty: "Showing 0 to 0 of 0 entries",
                infoFiltered: "(filtered from _MAX_ total entries)",
                search: "Search registered students:",
                paginate: {
                    first: "First",
                    last: "Last",
                    next: "Next",
                    previous: "Previous"
                }
            },
            drawCallback: function(settings) {
                // Add Bootstrap classes to the pagination elements
                $('.dataTables_paginate .paginate_button').addClass('btn btn-sm');
            }
        });
    }

    // Function to handle delete confirmations
    function confirmDelete(url, table, row) {
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
                    data: {
                        "_token": "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        Swal.fire(
                            'Deleted!',
                            'Record has been deleted successfully.',
                            'success'
                        );
                        table.row(row).remove().draw();
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
    }

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