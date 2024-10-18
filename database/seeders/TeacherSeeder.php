<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Teacher;
class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teachers = [
            ['name' => 'Mrs. Alice Brown'],
            ['name' => 'Mr. Bob Smith'],
            ['name' => 'Mrs. Carol Johnson'],
            ['name' => 'Mr. David Wilson'],
            ['name' => 'Mrs. Emily Davis'],
            ['name' => 'Mr. Frank Thompson'],
            ['name' => 'Mrs. Grace Lewis'],
            ['name' => 'Mr. Harry White'],
            ['name' => 'Mrs. Irene Miller'],
            ['name' => 'Mr. Jack Martin'],
        ];

    
        Teacher::insert($teachers);
    }
}
