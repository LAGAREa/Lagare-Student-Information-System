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
        // Create students with their corresponding user accounts
        $students = [
            // First 5 existing students
            [
                'student_id' => '2201111111',
                'name' => 'Jeboy Mapagmahal',
                'email' => 'jeboymapagmahal@gmail.com',
                'course' => 'BSCS',
                'year_level' => '4th Year',
                'password' => 'password123'
            ],
            [
                'student_id' => '2201111112',
                'name' => 'Maria Santos',
                'email' => 'mariasantos@gmail.com',
                'course' => 'BSIT',
                'year_level' => '3rd Year',
                'password' => 'password123'
            ],
            [
                'student_id' => '2201111113',
                'name' => 'Juan Dela Cruz',
                'email' => 'juandelacruz@gmail.com',
                'course' => 'BSCS',
                'year_level' => '2nd Year',
                'password' => 'password123'
            ],
            [
                'student_id' => '2201111114',
                'name' => 'Ana Reyes',
                'email' => 'anareyes@gmail.com',
                'course' => 'BSIT',
                'year_level' => '1st Year',
                'password' => 'password123'
            ],
            [
                'student_id' => '2201111115',
                'name' => 'Pedro Garcia',
                'email' => 'pedrogarcia@gmail.com',
                'course' => 'BSCS',
                'year_level' => '4th Year',
                'password' => 'password123'
            ],
            // Additional 45 students
            [
                'student_id' => '2201111116',
                'name' => 'Angelo Mendoza',
                'email' => 'angelomendoza@gmail.com',
                'course' => 'BSIT',
                'year_level' => '2nd Year',
                'password' => 'password123'
            ],
            [
                'student_id' => '2201111117',
                'name' => 'Sofia Ramos',
                'email' => 'sofiaramos@gmail.com',
                'course' => 'BSCS',
                'year_level' => '3rd Year',
                'password' => 'password123'
            ],
            [
                'student_id' => '2201111118',
                'name' => 'Miguel Torres',
                'email' => 'migueltorres@gmail.com',
                'course' => 'BSIT',
                'year_level' => '1st Year',
                'password' => 'password123'
            ],
            [
                'student_id' => '2201111119',
                'name' => 'Isabella Cruz',
                'email' => 'isabellacruz@gmail.com',
                'course' => 'BSCS',
                'year_level' => '4th Year',
                'password' => 'password123'
            ],
            [
                'student_id' => '2201111120',
                'name' => 'Gabriel Reyes',
                'email' => 'gabrielreyes@gmail.com',
                'course' => 'BSIT',
                'year_level' => '2nd Year',
                'password' => 'password123'
            ],
            [
                'student_id' => '2201111121',
                'name' => 'Sophia Luna',
                'email' => 'sophialuna@gmail.com',
                'course' => 'BSCS',
                'year_level' => '3rd Year',
                'password' => 'password123'
            ],
            [
                'student_id' => '2201111122',
                'name' => 'Rafael Santos',
                'email' => 'rafaelsantos@gmail.com',
                'course' => 'BSIT',
                'year_level' => '1st Year',
                'password' => 'password123'
            ],
            [
                'student_id' => '2201111123',
                'name' => 'Emma Gonzales',
                'email' => 'emmagonzales@gmail.com',
                'course' => 'BSCS',
                'year_level' => '4th Year',
                'password' => 'password123'
            ],
            [
                'student_id' => '2201111124',
                'name' => 'Lucas Fernandez',
                'email' => 'lucasfernandez@gmail.com',
                'course' => 'BSIT',
                'year_level' => '2nd Year',
                'password' => 'password123'
            ],
            [
                'student_id' => '2201111125',
                'name' => 'Olivia Martinez',
                'email' => 'oliviamartinez@gmail.com',
                'course' => 'BSCS',
                'year_level' => '3rd Year',
                'password' => 'password123'
            ],
            [
                'student_id' => '2201111126',
                'name' => 'Liam Rodriguez',
                'email' => 'liamrodriguez@gmail.com',
                'course' => 'BSIT',
                'year_level' => '1st Year',
                'password' => 'password123'
            ],
            [
                'student_id' => '2201111127',
                'name' => 'Ava Perez',
                'email' => 'avaperez@gmail.com',
                'course' => 'BSCS',
                'year_level' => '4th Year',
                'password' => 'password123'
            ],
            [
                'student_id' => '2201111128',
                'name' => 'Noah Santos',
                'email' => 'noahsantos@gmail.com',
                'course' => 'BSIT',
                'year_level' => '2nd Year',
                'password' => 'password123'
            ],
            [
                'student_id' => '2201111129',
                'name' => 'Mia Torres',
                'email' => 'miatorres@gmail.com',
                'course' => 'BSCS',
                'year_level' => '3rd Year',
                'password' => 'password123'
            ],
            [
                'student_id' => '2201111130',
                'name' => 'Ethan Cruz',
                'email' => 'ethancruz@gmail.com',
                'course' => 'BSIT',
                'year_level' => '1st Year',
                'password' => 'password123'
            ],
            [
                'student_id' => '2201111131',
                'name' => 'Amelia Reyes',
                'email' => 'ameliareyes@gmail.com',
                'course' => 'BSCS',
                'year_level' => '4th Year',
                'password' => 'password123'
            ],
            [
                'student_id' => '2201111132',
                'name' => 'Oliver Garcia',
                'email' => 'olivergarcia@gmail.com',
                'course' => 'BSIT',
                'year_level' => '2nd Year',
                'password' => 'password123'
            ],
            [
                'student_id' => '2201111133',
                'name' => 'Aurora Luna',
                'email' => 'auroraluna@gmail.com',
                'course' => 'BSCS',
                'year_level' => '3rd Year',
                'password' => 'password123'
            ],
            [
                'student_id' => '2201111134',
                'name' => 'Sebastian Santos',
                'email' => 'sebastiansantos@gmail.com',
                'course' => 'BSIT',
                'year_level' => '1st Year',
                'password' => 'password123'
            ],
            [
                'student_id' => '2201111135',
                'name' => 'Chloe Gonzales',
                'email' => 'chloegonzales@gmail.com',
                'course' => 'BSCS',
                'year_level' => '4th Year',
                'password' => 'password123'
            ],
            [
                'student_id' => '2201111136',
                'name' => 'Daniel Fernandez',
                'email' => 'danielfernandez@gmail.com',
                'course' => 'BSIT',
                'year_level' => '2nd Year',
                'password' => 'password123'
            ],
            [
                'student_id' => '2201111137',
                'name' => 'Victoria Martinez',
                'email' => 'victoriamartinez@gmail.com',
                'course' => 'BSCS',
                'year_level' => '3rd Year',
                'password' => 'password123'
            ],
            [
                'student_id' => '2201111138',
                'name' => 'Henry Rodriguez',
                'email' => 'henryrodriguez@gmail.com',
                'course' => 'BSIT',
                'year_level' => '1st Year',
                'password' => 'password123'
            ],
            [
                'student_id' => '2201111139',
                'name' => 'Luna Perez',
                'email' => 'lunaperez@gmail.com',
                'course' => 'BSCS',
                'year_level' => '4th Year',
                'password' => 'password123'
            ],
            [
                'student_id' => '2201111140',
                'name' => 'Alexander Santos',
                'email' => 'alexandersantos@gmail.com',
                'course' => 'BSIT',
                'year_level' => '2nd Year',
                'password' => 'password123'
            ],
            [
                'student_id' => '2201111141',
                'name' => 'Hazel Torres',
                'email' => 'hazeltorres@gmail.com',
                'course' => 'BSCS',
                'year_level' => '3rd Year',
                'password' => 'password123'
            ],
            [
                'student_id' => '2201111142',
                'name' => 'Jack Cruz',
                'email' => 'jackcruz@gmail.com',
                'course' => 'BSIT',
                'year_level' => '1st Year',
                'password' => 'password123'
            ],
            [
                'student_id' => '2201111143',
                'name' => 'Scarlett Reyes',
                'email' => 'scarlettreyes@gmail.com',
                'course' => 'BSCS',
                'year_level' => '4th Year',
                'password' => 'password123'
            ],
            [
                'student_id' => '2201111144',
                'name' => 'Leo Garcia',
                'email' => 'leogarcia@gmail.com',
                'course' => 'BSIT',
                'year_level' => '2nd Year',
                'password' => 'password123'
            ],
            [
                'student_id' => '2201111145',
                'name' => 'Nova Luna',
                'email' => 'novaluna@gmail.com',
                'course' => 'BSCS',
                'year_level' => '3rd Year',
                'password' => 'password123'
            ],
            [
                'student_id' => '2201111146',
                'name' => 'Owen Santos',
                'email' => 'owensantos@gmail.com',
                'course' => 'BSIT',
                'year_level' => '1st Year',
                'password' => 'password123'
            ],
            [
                'student_id' => '2201111147',
                'name' => 'Ruby Gonzales',
                'email' => 'rubygonzales@gmail.com',
                'course' => 'BSCS',
                'year_level' => '4th Year',
                'password' => 'password123'
            ],
            [
                'student_id' => '2201111148',
                'name' => 'Felix Fernandez',
                'email' => 'felixfernandez@gmail.com',
                'course' => 'BSIT',
                'year_level' => '2nd Year',
                'password' => 'password123'
            ],
            [
                'student_id' => '2201111149',
                'name' => 'Iris Martinez',
                'email' => 'irismartinez@gmail.com',
                'course' => 'BSCS',
                'year_level' => '3rd Year',
                'password' => 'password123'
            ],
            [
                'student_id' => '2201111150',
                'name' => 'Miles Rodriguez',
                'email' => 'milesrodriguez@gmail.com',
                'course' => 'BSIT',
                'year_level' => '1st Year',
                'password' => 'password123'
            ],
            [
                'student_id' => '2201111151',
                'name' => 'Jade Perez',
                'email' => 'jadeperez@gmail.com',
                'course' => 'BSCS',
                'year_level' => '4th Year',
                'password' => 'password123'
            ],
            [
                'student_id' => '2201111152',
                'name' => 'Kai Santos',
                'email' => 'kaisantos@gmail.com',
                'course' => 'BSIT',
                'year_level' => '2nd Year',
                'password' => 'password123'
            ],
            [
                'student_id' => '2201111153',
                'name' => 'Rose Torres',
                'email' => 'rosetorres@gmail.com',
                'course' => 'BSCS',
                'year_level' => '3rd Year',
                'password' => 'password123'
            ],
            [
                'student_id' => '2201111154',
                'name' => 'Axel Cruz',
                'email' => 'axelcruz@gmail.com',
                'course' => 'BSIT',
                'year_level' => '1st Year',
                'password' => 'password123'
            ],
            [
                'student_id' => '2201111155',
                'name' => 'Lily Reyes',
                'email' => 'lilyreyes@gmail.com',
                'course' => 'BSCS',
                'year_level' => '4th Year',
                'password' => 'password123'
            ]
        ];

        foreach ($students as $studentData) {
            // Check if user already exists
            $existingUser = User::where('email', $studentData['email'])->first();
            if (!$existingUser) {
                // Create user account
                $user = User::create([
                    'name' => $studentData['name'],
                    'email' => $studentData['email'],
                    'password' => Hash::make($studentData['password']),
                    'role' => 'student'
                ]);
            }

            // Check if student already exists
            $existingStudent = Student::where('student_id', $studentData['student_id'])
                                    ->orWhere('email', $studentData['email'])
                                    ->first();
            if (!$existingStudent) {
                // Create student record
                Student::create([
                    'student_id' => $studentData['student_id'],
                    'name' => $studentData['name'],
                    'email' => $studentData['email'],
                    'course' => $studentData['course'],
                    'year_level' => $studentData['year_level']
                ]);
            }
        }
    }
}
