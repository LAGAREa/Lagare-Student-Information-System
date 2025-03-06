@extends('layouts.dashboardTemplate')

@section('title', 'Add Grade')

@section('content')
    <div class="container">
        <h1 class="my-4">Add Grade</h1>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Add New Grade</h6>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.grades.store') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="student_id">Student</label>
                                <select name="student_id" id="student_id" class="form-control @error('student_id') is-invalid @enderror" required>
                                    <option value="">Select Student</option>
                                    @foreach($students as $student)
                                        <option value="{{ $student->id }}" {{ old('student_id') == $student->id ? 'selected' : '' }}>
                                            {{ $student->student_id }} - {{ $student->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('student_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="subject_id">Subject</label>
                                <select name="subject_id" id="subject_id" class="form-control @error('subject_id') is-invalid @enderror" required>
                                    <option value="">Select Subject</option>
                                    @foreach($subjects as $subject)
                                        <option value="{{ $subject->id }}" {{ old('subject_id') == $subject->id ? 'selected' : '' }}>
                                            {{ $subject->subject_code }} - {{ $subject->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('subject_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group position-relative">
                        <label for="grade">Grade</label>
                        <input type="text" 
                               name="grade" 
                               id="grade" 
                               class="form-control @error('grade') is-invalid @enderror" 
                               value="{{ old('grade') }}"
                               required
                               autocomplete="off">
                        <div id="gradeOptions" class="grade-options shadow-sm">
                            <!-- Grade options will be populated here -->
                        </div>
                        @error('grade')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mt-4">
                        <button type="submit" class="btn btn-primary px-4">Add Grade</button>
                        <a href="{{ route('admin.grades') }}" class="btn btn-secondary px-4 ms-2">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
    .grade-options {
        display: none;
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        background: white;
        border: 1px solid #ddd;
        border-radius: 4px;
        max-height: 200px;
        overflow-y: auto;
        z-index: 1000;
    }

    .grade-option {
        padding: 8px 12px;
        cursor: pointer;
        transition: background-color 0.2s;
    }

    .grade-option:hover {
        background-color: #f8f9fc;
    }

    .grade-option.selected {
        background-color: #4e73df;
        color: white;
    }
    </style>

    @push('scripts')
    <script>
    $(document).ready(function() {
        const gradeValues = [
            '1.00', '1.25', '1.50', '1.75', 
            '2.00', '2.25', '2.50', '2.75',
            '3.00', '5.00', 'INC', 'FA'
        ];
        
        const gradeInput = $('#grade');
        const gradeOptions = $('#gradeOptions');
        
        // Function to populate grade options
        function populateGradeOptions(filter = '') {
            const filteredGrades = gradeValues.filter(grade => 
                grade.toLowerCase().includes(filter.toLowerCase())
            );
            
            gradeOptions.html(filteredGrades.map(grade => 
                `<div class="grade-option" data-value="${grade}">${grade}</div>`
            ).join(''));
        }
        
        // Show options when input is focused
        gradeInput.on('focus', function() {
            populateGradeOptions(gradeInput.val());
            gradeOptions.show();
        });
        
        // Filter options when typing
        gradeInput.on('input', function() {
            populateGradeOptions(gradeInput.val());
            gradeOptions.show();
        });
        
        // Handle option selection
        $(document).on('click', '.grade-option', function() {
            gradeInput.val($(this).data('value'));
            gradeOptions.hide();
        });
        
        // Hide options when clicking outside
        $(document).on('click', function(e) {
            if (!$(e.target).closest('.form-group').length) {
                gradeOptions.hide();
            }
        });
        
        // Handle keyboard navigation
        gradeInput.on('keydown', function(e) {
            const options = $('.grade-option');
            const selected = $('.grade-option.selected');
            
            switch(e.keyCode) {
                case 40: // Down arrow
                    e.preventDefault();
                    if (selected.length) {
                        selected.removeClass('selected')
                               .next('.grade-option')
                               .addClass('selected');
                    } else {
                        options.first().addClass('selected');
                    }
                    break;
                    
                case 38: // Up arrow
                    e.preventDefault();
                    if (selected.length) {
                        selected.removeClass('selected')
                               .prev('.grade-option')
                               .addClass('selected');
                    } else {
                        options.last().addClass('selected');
                    }
                    break;
                    
                case 13: // Enter
                    e.preventDefault();
                    if (selected.length) {
                        gradeInput.val(selected.data('value'));
                        gradeOptions.hide();
                    }
                    break;
                    
                case 27: // Escape
                    gradeOptions.hide();
                    break;
            }
        });
    });
    </script>
    @endpush
@endsection