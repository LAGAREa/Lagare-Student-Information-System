<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grade;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Enrollment;

class DashboardController extends Controller
{
    public function index()
    {
        if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        
        // Get the current student
        $student = Student::where('email', auth()->user()->email)->first();
        
        if (!$student) {
            return view('student.dashboard', [
                'enrolledSubjectsCount' => 0,
                'passedSubjectsCount' => 0,
                'gpa' => 0,
                'currentSubjects' => collect([]),
                'recentGrades' => collect([])
            ]);
        }

        // Get enrolled subjects count
        $enrolledSubjectsCount = $student->enrollments()->count();

        // Get grades with their subjects
        $grades = Grade::with('subject')
            ->where('student_id', $student->id)
            ->get();

        // Calculate passed subjects count
        $passedSubjectsCount = $grades->filter(function($grade) {
            return $grade->isPassing();
        })->count();

        // Calculate GPA
        $totalGradePoints = $grades->sum(function($grade) {
            return $grade->grade * $grade->subject->units;
        });
        $totalUnits = $grades->sum(function($grade) {
            return $grade->subject->units;
        });
        $gpa = $totalUnits > 0 ? $totalGradePoints / $totalUnits : 0;

        // Get current subjects (enrolled but no grades yet)
        $currentSubjects = Subject::whereIn('id', function($query) use ($student) {
            $query->select('subject_id')
                ->from('enrollments')
                ->where('student_id', $student->id)
                ->whereNotIn('subject_id', function($q) use ($student) {
                    $q->select('subject_id')
                        ->from('grades')
                        ->where('student_id', $student->id);
                });
        })->get();

        // Get recent grades
        $recentGrades = Grade::with('subject')
            ->where('student_id', $student->id)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('student.dashboard', compact(
            'enrolledSubjectsCount',
            'passedSubjectsCount',
            'gpa',
            'currentSubjects',
            'recentGrades'
        ));
    }
}
