<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model

{
    use SoftDeletes;

   protected $table = 'students';


   protected $fillable = [
    'student_name',
    'class_teacher_id',
    'class',
    'admission_date',
    'yearly_fees'
];


  
    public function teacher()
{
    return $this->belongsTo(Teacher::class, 'class_teacher_id');
}

}
