@extends('layouts.dashboardTemplate')

@section('title', 'Add Grade')

@section('content')
    <div class="container">
        <h1 class="my-4">Add Grade</h1>
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('admin.grades.store') }}" method="POST">
            @csrf
            <div class="form-group mb-3">
                <label for="student_id">Student</label>
                <select class="form-control select2" id="student_id" name="student_id" required>
                    <option value="">Search Student</option>
                    @foreach($students as $student)
                        <option value="{{ $student->id }}">{{ $student->name }} - {{ $student->student_id }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="subject_id">Subject</label>
                <select class="form-control select2" id="subject_id" name="subject_id" required>
                    <option value="">Search Subject</option>
                    @foreach($subjects as $subject)
                        @php
                            $isGraded = $grades->where('student_id', old('student_id'))->where('subject_id', $subject->id)->first();
                        @endphp
                        <option value="{{ $subject->id }}" @if($isGraded) disabled @endif>
                            {{ $subject->code }} - {{ $subject->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="grade">Grade</label>
                <select class="form-control select2" id="grade" name="grade" required>
                    <option value="">Search Grade</option>
                    <option value="1.00">1.00</option>
                    <option value="1.25">1.25</option>
                    <option value="1.50">1.50</option>
                    <option value="1.75">1.75</option>
                    <option value="2.00">2.00</option>
                    <option value="2.25">2.25</option>
                    <option value="2.50">2.50</option>
                    <option value="2.75">2.75</option>
                    <option value="3.00">3.00</option>
                    <option value="4.00">4.00</option>
                    <option value="5.00">5.00</option>
                </select>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn" style="background-color: #0C6291; color: white;">Add Grade</button>
                <a href="{{ route('admin.grades') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>

    <script>
        $(document).ready(function() {
            // Initialize Select2 for all dropdowns
            $('.select2').select2({
                width: '100%',
                theme: 'bootstrap4',
                allowClear: true
            });

            // Handle student selection
            $('#student_id').on('change', function() {
                const studentId = $(this).val();
                const subjectSelect = $('#subject_id');
                
                // Enable all options first
                subjectSelect.find('option').prop('disabled', false);
                
                if (studentId) {
                    // Hide subjects that are already graded for this student
                    $.get(`/admin/grades/student/${studentId}/subjects`, function(gradedSubjects) {
                        gradedSubjects.forEach(subjectId => {
                            subjectSelect.find(`option[value="${subjectId}"]`).prop('disabled', true);
                        });
                        subjectSelect.select2('destroy').select2({
                            width: '100%',
                            theme: 'bootstrap4',
                            allowClear: true
                        });
                    });
                }
                
                // Clear subject selection
                subjectSelect.val('').trigger('change');
            });
        });
    </script>

    <style>
    .select2-container .select2-selection--single {
        height: 38px;
        padding: 8px;
            border: 1px solid #ced4da;
            border-radius: 4px;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 36px;
    }
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: normal;
            padding-left: 0;
        }
        .select2-container--default .select2-search--dropdown .select2-search__field {
        border: 1px solid #ced4da;
            border-radius: 4px;
        }
        .select2-dropdown {
        border: 1px solid #ced4da;
            border-radius: 4px;
        }
        .select2-results__option[aria-disabled=true] {
            color: #6c757d;
        background-color: #e9ecef;
    }
        .form-group {
            margin-bottom: 1rem;
        }
        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
        }
        .d-flex.gap-2 {
            display: flex;
            gap: 0.5rem;
    }
    </style>
@endsection