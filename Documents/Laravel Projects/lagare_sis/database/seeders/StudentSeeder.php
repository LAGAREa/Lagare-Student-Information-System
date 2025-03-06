<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        // Create a student record
        $student = Student::create([
            'student_id' => '100000',
            'name' => 'Test Student',
            'email' => 'student@example.com',
            'year_level' => '1st Year'
        ]);

        // Create corresponding user account
        User::create([
            'name' => $student->name,
            'email' => $student->email,
            'password' => Hash::make('password'),
            'role' => 'student'
        ]);
    }
}
