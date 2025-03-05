<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\User;
use DataTables;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::with('user')->paginate(10);
        return view('admin.students.index', compact('students'));
    }

    public function create()
    {
        $users = User::where('role', 'student')->get();
        return view('admin.students.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|unique:students',
            'name' => [
                'required',
                function ($attribute, $value, $fail) use ($request) {
                    $user = User::where('name', $value)
                                ->where('email', $request->email)
                                ->where('role', 'student')
                                ->first();
                    if (!$user) {
                        $fail('The name and email must match a registered student user.');
                    }
                },
            ],
            'email' => 'required|email|unique:students',
            'course' => 'required|string',
        ]);

        Student::create($request->all());

        return redirect()->route('admin.students')->with('success', 'Student created successfully.');
    }

    public function edit(Student $student)
    {
        return view('admin.students.edit', compact('student'));
    }

    public function update(Request $request, Student $student)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:students,email,' . $student->id,
            'course' => 'required|string',
        ]);

        $student->update($request->all());

        return redirect()->route('admin.students')->with('success', 'Student updated successfully.');
    }

    public function destroy(Student $student)
    {
        try {
            // Check if student has enrollments or grades
            if ($student->enrollments()->count() > 0) {
                return response()->json([
                    'message' => 'Cannot delete student. This student is enrolled in one or more subjects.'
                ], 400);
            }

            if ($student->grades()->count() > 0) {
                return response()->json([
                    'message' => 'Cannot delete student. This student has grades recorded.'
                ], 400);
            }

            $student->delete();
            return response()->json([
                'message' => 'Student deleted successfully.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while deleting the student.'
            ], 500);
        }
    }

    public function show(Student $student)
    {
        return view('admin.students.show', compact('student'));
    }
}

