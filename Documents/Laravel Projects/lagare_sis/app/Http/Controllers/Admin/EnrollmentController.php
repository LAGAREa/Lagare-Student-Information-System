<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Enrollment;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Support\Facades\DB;

class EnrollmentController extends Controller
{
    public function index()
    {
        $enrollments = Enrollment::with(['student', 'subject'])
            ->orderBy('id', 'asc')
            ->paginate(10);
        return view('admin.enrollments.index', compact('enrollments'));
    }

    public function create()
    {
        $students = Student::all();
        $subjects = Subject::all();
        $enrollments = Enrollment::all();

        return view('admin.enrollments.create', compact('students', 'subjects', 'enrollments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'subject_id' => 'required|exists:subjects,id',
        ]);

        // Check if the student is already enrolled in the selected subject
        $existingEnrollment = Enrollment::where('student_id', $request->student_id)
                                        ->where('subject_id', $request->subject_id)
                                        ->first();

        if ($existingEnrollment) {
            return redirect()->back()->withErrors(['subject_id' => 'This student is already enrolled in the selected subject.']);
        }

        Enrollment::create($request->all());

        return redirect()->route('admin.enrollments')->with('success', 'Enrollment created successfully.');
    }

    public function edit(Enrollment $enrollment)
    {
        $students = Student::all();
        $subjects = Subject::all();
        return view('admin.enrollments.edit', compact('enrollment', 'students', 'subjects'));
    }

    public function update(Request $request, Enrollment $enrollment)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'subject_id' => 'required|exists:subjects,id',
        ]);

        $enrollment->update($request->all());

        return redirect()->route('admin.enrollments')->with('success', 'Enrollment updated successfully.');
    }

    public function destroy(Enrollment $enrollment)
    {
        try {
            // Check if enrollment has grades
            if ($enrollment->grades()->count() > 0) {
                return response()->json([
                    'message' => 'Cannot delete enrollment. This student has grades for this subject.'
                ], 400);
            }

            // Get enrollment details for the success message
            $studentName = $enrollment->student->name;
            $subjectName = $enrollment->subject->name;

            $enrollment->delete();
            return response()->json([
                'message' => "Enrollment for {$studentName} in {$subjectName} has been deleted successfully."
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while deleting the enrollment.'
            ], 500);
        }
    }

    public function show(Enrollment $enrollment)
    {
        return view('admin.enrollments.show', compact('enrollment'));
    }
}
