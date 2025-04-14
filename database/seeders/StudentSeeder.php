<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 50 student records
        Student::factory(50)->create();
        
        // If you want a specific student with controlled values
        /* Student::factory()->create([
            'email' => 'test@example.com',
            'fname' => 'John',
            'lname' => 'Doe',
        ]); */
    }  
}

