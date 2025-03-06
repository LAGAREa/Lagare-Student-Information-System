<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{
    public function run()
    {
        $courses = ['BSIT', 'BSCS', 'BSIS', 'BSEMC'];
        $yearLevels = ['1st Year', '2nd Year', '3rd Year', '4th Year'];

        for ($i = 1; $i <= 50; $i++) {
            // Create user first
            $user = User::create([
                'name' => fake()->name(),
                'email' => fake()->unique()->safeEmail(),
                'password' => Hash::make('password123'), // default password
                'role' => 'student'
            ]);

            // Then create student with reference to user
            Student::create([
                'user_id' => $user->id,
                'student_id' => '2024-' . str_pad($i, 4, '0', STR_PAD_LEFT),
                'name' => $user->name,
                'email' => $user->email,
                'course' => $courses[array_rand($courses)],
                'year_level' => $yearLevels[array_rand($yearLevels)]
            ]);
        }
    }
}
