<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subject;

class SubjectController extends Controller
{
    public function index()
    {
        $subjects = Subject::orderBy('subject_code', 'asc')
            ->paginate(10);
        return view('admin.subjects.index', compact('subjects'));
    }

    public function create()
    {
        return view('admin.subjects.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:subjects,name',
            'subject_code' => 'required|string|max:255|unique:subjects,subject_code',
            'units' => 'required|integer',
        ]);

        Subject::create($request->all());

        return redirect()->route('admin.subjects')->with('success', 'Subject created successfully.');
    }

    public function edit(Subject $subject)
    {
        return view('admin.subjects.edit', compact('subject'));
    }

    public function update(Request $request, Subject $subject)
    {
        $request->validate([
            'name' => 'required',
            'subject_code' => 'required|unique:subjects,subject_code,' . $subject->id,
            'units' => 'required|integer',
        ]);

        $subject->update($request->all());

        return redirect()->route('admin.subjects')->with('success', 'Subject updated successfully.');
    }

    public function destroy(Subject $subject)
    {
        try {
            // Delete enrollments but keep grades
            $subject->enrollments()->delete();
            
            // Delete the subject
            $subject->delete();

            return response()->json([
                'message' => 'Subject deleted successfully.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while deleting the subject.'
            ], 500);
        }
    }

    public function show(Subject $subject)
    {
        return view('admin.subjects.show', compact('subject'));
    }

    public function studentSubjects()
    {
        // Get the current student
        $student = \App\Models\Student::where('email', auth()->user()->email)->first();
        
        if (!$student) {
            return view('student.subjects', ['subjects' => collect([])]);
        }

        // Get enrolled subjects through enrollments
        $subjects = Subject::whereIn('id', function($query) use ($student) {
            $query->select('subject_id')
                ->from('enrollments')
                ->where('student_id', $student->id);
        })->get();

        return view('student.subjects', compact('subjects'));
    }
}
