@extends('layouts.dashboardTemplate')

@section('title', 'Add Enrollment')

@section('content')
    <div class="container">
        <h1 class="my-4">Add Enrollment</h1>
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('admin.enrollments.store') }}" method="POST">
            @csrf
            <div class="form-group mb-3">
                <label for="student_name">Student Name</label>
                <select class="form-control" id="student_name" name="student_id" required>
                    <option value="">Select Student</option>
                    @foreach($students as $student)
                        <option value="{{ $student->id }}" 
                                data-email="{{ $student->email }}"
                                data-course="{{ $student->course }}">
                            {{ $student->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="student_email">Email</label>
                <input type="text" class="form-control" id="student_email" readonly>
            </div>

            <div class="form-group mb-3">
                <label for="student_course">Course</label>
                <input type="text" class="form-control" id="student_course" readonly>
            </div>

            <div class="form-group mb-3">
                <label for="semester">Semester</label>
                <select class="form-control" id="semester" name="semester" required>
                    <option value="">Select Semester</option>
                    <option value="1st">First Semester</option>
                    <option value="2nd">Second Semester</option>
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="subject_id">Subject</label>
                <select class="form-control" id="subject_id" name="subject_id" required>
                    <option value="">Select Subject</option>
                    @foreach($subjects as $subject)
                        <option value="{{ $subject->id }}">
                            {{ $subject->subject_code }} - {{ $subject->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-primary">Add Enrollment</button>
                <a href="{{ route('admin.enrollments') }}" class="btn btn-secondary ml-2">Cancel</a>
            </div>
        </form>
    </div>

    <script>
        $(document).ready(function() {
            // Initialize Select2
            $('#student_name').select2({
                width: '100%',
                theme: 'bootstrap4',
                placeholder: 'Select Student'
            });

            $('#semester').select2({
                width: '100%',
                theme: 'bootstrap4',
                placeholder: 'Select Semester'
            });

            $('#subject_id').select2({
                width: '100%',
                theme: 'bootstrap4',
                placeholder: 'Select Subject'
            });

            // Handle student selection
            $('#student_name').on('change', function() {
                var $selectedOption = $(this).find('option:selected');
                var email = $selectedOption.data('email') || '';
                var course = $selectedOption.data('course') || '';
                
                $('#student_email').val(email);
                $('#student_course').val(course);

                // Handle subject availability
                var studentId = $(this).val();
                var $subjectSelect = $('#subject_id');
                
                // Enable all options first
                $subjectSelect.find('option').prop('disabled', false);
                
                if (studentId) {
                    // Hide subjects that are already enrolled for this student
                    $.get(`/admin/enrollments/student/${studentId}/subjects`, function(enrolledSubjects) {
                        enrolledSubjects.forEach(function(subjectId) {
                            $subjectSelect.find(`option[value="${subjectId}"]`).prop('disabled', true);
                        });
                        $subjectSelect.select2('destroy').select2({
                            width: '100%',
                            theme: 'bootstrap4',
                            placeholder: 'Select Subject'
                        });
                    });
                }
                
                // Clear subject selection
                $subjectSelect.val(null).trigger('change');
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
        .form-control[readonly] {
            background-color: #f8f9fc;
            cursor: not-allowed;
        }
        select.form-control {
            cursor: pointer;
        }
        .select2-container--default .select2-results__option--highlighted[aria-selected] {
            background-color: #4e73df;
        }
    </style>
@endsection