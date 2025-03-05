@extends('layouts.dashboardTemplate')

@section('title', 'Student Dashboard')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Student Dashboard</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">My Grades</h6>
                </div>
                <div class="card-body">
                    @if(isset($grades) && count($grades) > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Subject</th>
                                        <th>Grade</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($grades as $grade)
                                        <tr>
                                            <td>{{ $grade->subject->name }}</td>
                                            <td>{{ $grade->grade }}</td>
                                            <td>
                                                @if($grade->grade >= 75)
                                                    <span class="badge badge-success">Passed</span>
                                                @else
                                                    <span class="badge badge-danger">Failed</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-center">No grades available yet.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection 