<?php

namespace App\Http\Controllers\Admin;

use App\Models\Student;
use App\Models\Subject;
use App\Models\Enrollment;
use App\Models\Grade;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Get counts for dashboard cards
        $studentCount = Student::count();
        $subjectCount = Subject::count();
        $enrollmentCount = Enrollment::count();
        $gradeCount = Grade::count();

        // Get recent enrollments
        $recentEnrollments = Enrollment::with(['student', 'subject'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Get recent grades
        $recentGrades = Grade::with(['student', 'subject'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'studentCount',
            'subjectCount',
            'enrollmentCount',
            'gradeCount',
            'recentEnrollments',
            'recentGrades'
        ));
    }
}