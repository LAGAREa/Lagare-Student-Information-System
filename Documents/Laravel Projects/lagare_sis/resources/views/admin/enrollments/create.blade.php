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
                <label for="name">Name</label>
                <select class="form-control" id="name" name="student_id" required>
                    <option value="">Select Student</option>
                    @foreach($students as $student)
                        <option value="{{ $student->id }}" data-email="{{ $student->email }}" data-course="{{ $student->course }}">{{ $student->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" readonly>
            </div>

            <div class="form-group mb-3">
                <label for="course">Course</label>
                <input type="text" class="form-control" id="course" readonly>
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
                        <option value="{{ $subject->id }}">{{ $subject->subject_code }} - {{ $subject->name }}</option>
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
        document.getElementById('name').addEventListener('change', function() {
            var email = this.options[this.selectedIndex].getAttribute('data-email');
            var course = this.options[this.selectedIndex].getAttribute('data-course');
            document.getElementById('email').value = email;
            document.getElementById('course').value = course;

            // Handle subject availability
            const studentId = this.value;
            const subjectSelect = document.getElementById('subject_id');
            const originalOptions = Array.from(subjectSelect.options);
            
            // Reset subject selection
            subjectSelect.value = '';
            
            if (studentId) {
                // Hide subjects that are already enrolled for this student
                $.get(`/admin/enrollments/student/${studentId}/subjects`, function(enrolledSubjects) {
                    // Remove all options except the first one (placeholder)
                    while (subjectSelect.options.length > 1) {
                        subjectSelect.remove(1);
                    }
                    
                    // Add back only non-enrolled subjects
                    originalOptions.slice(1).forEach(option => {
                        if (!enrolledSubjects.includes(parseInt(option.value))) {
                            subjectSelect.add(option.cloneNode(true));
                        }
                    });
                });
            } else {
                // Reset to original options
                while (subjectSelect.options.length > 1) {
                    subjectSelect.remove(1);
                }
                originalOptions.slice(1).forEach(option => {
                    subjectSelect.add(option.cloneNode(true));
                });
            }
        });
    </script>

    <style>
        .form-control {
            height: 38px;
            padding: 6px 12px;
            border: 1px solid #ced4da;
            border-radius: 4px;
            width: 100%;
        }

        .form-control[readonly] {
            background-color: #f8f9fc;
            cursor: not-allowed;
        }

        .form-group {
            position: relative;
            margin-bottom: 1rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: #374151;
        }

        .form-text {
            font-size: 0.875rem;
            color: #6b7280;
        }

        /* Status badge styles for the admin dashboard */
        .status-badge {
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-weight: 500;
            font-size: 0.875rem;
            text-align: center;
            display: inline-block;
        }

        .status-passed {
            background-color: #10B981;
            color: white;
        }

        .status-failed {
            background-color: #EF4444;
            color: white;
        }
    </style>
@endsection