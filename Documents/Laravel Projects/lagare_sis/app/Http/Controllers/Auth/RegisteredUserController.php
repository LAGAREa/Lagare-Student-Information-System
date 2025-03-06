<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\DB;
use App\Models\Student;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'student_id' => ['required', 'string', 'max:255', 'unique:students,student_id'],
            'course' => ['required', 'string', 'max:255'],
            'year_level' => ['required', 'integer', 'min:1', 'max:4'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => 'student',
            'password' => Hash::make($request->password),
        ]);

        // Create student record with user_id
        $student = new Student();
        $student->user_id = $user->id;
        $student->student_id = $request->student_id;
        $student->name = $request->name;
        $student->email = $request->email;
        $student->course = $request->course;
        $student->year_level = $request->year_level;
        $student->save();

        Auth::login($user);

        return redirect('/student/dashboard');
    }
}
