<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Teacher extends Model
{
    use SoftDeletes;

    protected $table = 'teachers';

    protected $fillable = [
        'name',

    ];


    public function students()
    {
        return $this->hasMany(Student::class, 'class_teacher_id');
    }

}
