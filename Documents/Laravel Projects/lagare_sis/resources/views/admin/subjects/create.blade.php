@extends('layouts.dashboardTemplate')

@section('title', 'Add Subject')

@section('content')
    <div class="container">
        <h1 class="my-4">Add Subject</h1>
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('admin.subjects.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Subject Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
            </div>
            <div class="form-group">
                <label for="subject_code">Subject Code</label>
                <input type="text" class="form-control" id="subject_code" name="subject_code" value="{{ old('subject_code') }}" required>
            </div>
            <div class="form-group">
                <label for="units">Units</label>
                <input type="number" class="form-control" id="units" name="units" value="{{ old('units') }}" required>
            </div>
            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-primary">Add Subject</button>
                <a href="{{ route('admin.subjects') }}" class="btn btn-secondary ml-2">Cancel</a>
            </div>
        </form>
    </div>

    <style>
    .d-flex.gap-2 {
        display: flex;
        gap: 0.5rem;
    }
    </style>
@endsection