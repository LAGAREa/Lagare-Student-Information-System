<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grade;

class DashboardController extends Controller
{
    public function index()
    {
        if (auth()->user()->hasRole('admin')) {
            return redirect()->route('admin.dashboard');
        }
        
        // For students, get their grades and show the dashboard
        $grades = Grade::with('subject')
            ->where('student_id', auth()->id())
            ->get();
            
        return view('student.dashboard', compact('grades'));
    }
}
