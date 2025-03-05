<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Grade;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Enrollment;

class GradeController extends Controller
{
    public function index()
    {
        $grades = Grade::with(['student', 'subject'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('admin.grades.index', compact('grades'));
    }

    public function create()
    {
        $students = Student::all();
        $subjects = Subject::all();
        $grades = Grade::all();

        return view('admin.grades.create', compact('students', 'subjects', 'grades'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'subject_id' => 'required|exists:subjects,id',
            'grade' => 'required|numeric|between:1.0,5.0',
        ]);

        // Check if the student is enrolled in the selected subject
        $enrollment = Enrollment::where('student_id', $request->student_id)
                                ->where('subject_id', $request->subject_id)
                                ->first();

        if (!$enrollment) {
            return redirect()->back()->withErrors(['subject_id' => 'The student is not enrolled in the selected subject.']);
        }

        // Check if the student already has a grade for the selected subject
        $existingGrade = Grade::where('student_id', $request->student_id)
                              ->where('subject_id', $request->subject_id)
                              ->first();

        if ($existingGrade) {
            return redirect()->back()->withErrors(['subject_id' => 'This student already has a grade for the selected subject.']);
        }

        $data = $request->all();
        $data['student_name'] = Student::find($data['student_id'])->name;
        $data['subject_name'] = Subject::find($data['subject_id'])->name;
        $data['grade'] = number_format($data['grade'], 2);
        $data['remark'] = $this->getRemark($data['grade']);
        $data['curriculum_evaluation'] = $data['remark'];

        Grade::create($data);

        return redirect()->route('admin.grades')->with('success', 'Grade created successfully.');
    }

    public function edit(Grade $grade)
    {
        $students = Student::all();
        $subjects = Subject::all();
        return view('admin.grades.edit', compact('grade', 'students', 'subjects'));
    }

    public function update(Request $request, Grade $grade)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'subject_id' => 'required|exists:subjects,id',
            'grade' => 'required|numeric|between:1.0,5.0',
        ]);

        $data = $request->all();
        $data['subject_name'] = Subject::find($data['subject_id'])->name;
        $data['grade'] = number_format($data['grade'], 2);
        $data['remark'] = $this->getRemark($data['grade']);
        $data['curriculum_evaluation'] = $data['remark'];

        $grade->update($data);

        return redirect()->route('admin.grades')->with('success', 'Grade updated successfully.');
    }

    public function destroy(Grade $grade)
    {
        try {
            // Get grade details for the success message
            $studentName = $grade->student->name;
            $subjectName = $grade->subject->name;
            $gradeValue = $grade->grade;

            // Delete the grade
            $grade->delete();

            // Log the deletion
            \Log::info('Grade deleted successfully', [
                'student' => $studentName,
                'subject' => $subjectName,
                'grade' => $gradeValue
            ]);

            return response()->json([
                'message' => "Grade for {$studentName} in {$subjectName} has been deleted successfully."
            ]);
        } catch (\Exception $e) {
            \Log::error('Error deleting grade: ' . $e->getMessage());
            return response()->json([
                'message' => 'An error occurred while deleting the grade. Please try again.'
            ], 500);
        }
    }

    public function viewGrades()
    {
        $student = Student::where('email', auth()->user()->email)->first();
        
        if (!$student) {
            return view('student.view-grades', ['grades' => collect([])]);
        }

        $grades = Grade::where('student_id', $student->id)
                       ->with(['subject', 'student'])
                       ->get();

        return view('student.view-grades', compact('grades'));
    }

    public function show(Grade $grade)
    {
        return view('admin.grades.show', compact('grade'));
    }

    private function getRemark($grade)
    {
        $grade = floatval($grade);
        if ($grade >= 1.0 && $grade <= 2.75) {
            return 'Passed';
        } else {
            return 'Failed';
        }
    }
}
