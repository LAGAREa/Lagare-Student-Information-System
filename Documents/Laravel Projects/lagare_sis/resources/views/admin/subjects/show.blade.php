@extends('layouts.dashboardTemplate')

@section('title', 'Subject Details')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Subject Details</h6>
                    <a href="{{ route('admin.subjects') }}" class="btn btn-primary btn-sm">Back to List</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tr>
                                <th width="30%">Subject Code</th>
                                <td>{{ $subject->subject_code }}</td>
                            </tr>
                            <tr>
                                <th>Subject Name</th>
                                <td>{{ $subject->name }}</td>
                            </tr>
                            <tr>
                                <th>Units</th>
                                <td>{{ $subject->units }}</td>
                            </tr>
                        </table>
                    </div>
                    
                    <div class="mt-3 d-flex justify-content-end">
                        <a href="{{ route('admin.subjects.edit', $subject->id) }}" class="btn btn-primary mr-2">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('admin.subjects.destroy', $subject->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this subject?')">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.table th {
    background-color: #f8f9fc;
}
.btn-sm {
    padding: 0.25rem 0.5rem;
    font-size: 0.875rem;
}
</style>
@endsection 