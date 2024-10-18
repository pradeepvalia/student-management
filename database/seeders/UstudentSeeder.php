<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Student;
class UstudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $students = [
            [
                'student_name' => 'John Doe',
                'class' => 'Class 1',
                'class_teacher_id' => 1,
                'admission_date' => '2023-01-01',
                'yearly_fees' => 15000,
            ],
            [
                'student_name' => 'Jane Smith',
                'class' => 'Class 2',
                'class_teacher_id' => 2,
                'admission_date' => '2023-02-01',
                'yearly_fees' => 16000,
            ],
            [
                'student_name' => 'Alice Johnson',
                'class' => 'Class 1',
                'class_teacher_id' => 3,
                'admission_date' => '2023-03-01',
                'yearly_fees' => 14000,
            ],
            [
                'student_name' => 'Bob Brown',
                'class' => 'Class 3',
                'class_teacher_id' => 4,
                'admission_date' => '2023-04-01',
                'yearly_fees' => 17000,
            ],
            [
                'student_name' => 'Charlie Davis',
                'class' => 'Class 2',
                'class_teacher_id' => 5,
                'admission_date' => '2023-05-01',
                'yearly_fees' => 18000,
            ],
            [
                'student_name' => 'David Wilson',
                'class' => 'Class 3',
                'class_teacher_id' => 6,
                'admission_date' => '2023-06-01',
                'yearly_fees' => 19000,
            ],
            [
                'student_name' => 'Eve Thompson',
                'class' => 'Class 1',
                'class_teacher_id' => 7,
                'admission_date' => '2023-07-01',
                'yearly_fees' => 20000,
            ],
            [
                'student_name' => 'Frank White',
                'class' => 'Class 2',
                'class_teacher_id' => 8,
                'admission_date' => '2023-08-01',
                'yearly_fees' => 21000,
            ],
            [
                'student_name' => 'Grace Lewis',
                'class' => 'Class 3',
                'class_teacher_id' => 9,
                'admission_date' => '2023-09-01',
                'yearly_fees' => 22000,
            ],
            [
                'student_name' => 'Hank Martin',
                'class' => 'Class 1',
                'class_teacher_id' => 10,
                'admission_date' => '2023-10-01',
                'yearly_fees' => 23000,
            ]
        ];

    
        Student::insert($students);
    }
}
