<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use DataTables;

class StudentController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Student::with('teacher')->get();

            return DataTables::of($data)
                ->addColumn('teacher_name', function ($row) {
                    return $row->teacher->name;
                })

                ->addColumn('actions', function ($row) {
                    $editBtn = '<button class="edit-btn btn btn-primary btn-sm" data-id="' . $row->id . '">Edit</button>';
                    $deleteBtn = '<button class="delete-btn btn btn-danger btn-sm" data-id="' . $row->id . '">Delete</button>';
                    return $editBtn . ' ' . $deleteBtn;
                })

                ->rawColumns(['actions'])

                ->make(true);
        }
            $teachers = Teacher::all();

        return view('student.index',compact('teachers'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_name' => 'required|string|max:255',
            'class' => 'required|string|max:100',
            'class_teacher_id' => 'required|exists:teachers,id',
            'admission_date' => 'required|date',
            'yearly_fees' => 'required|numeric|min:0',
        ]);

        Student::create($validated);

        return response()->json(['success' => 'Student added successfully.']);
    }


    public function edit($id)
    {
        $student = Student::findOrFail($id);
        return response()->json($student);
    }


    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'student_name' => 'required|string|max:255',
            'class' => 'required|string|max:100',
            'class_teacher_id' => 'required|exists:teachers,id',
            'admission_date' => 'required|date',
            'yearly_fees' => 'required|numeric|min:0',
        ]);

        $student = Student::findOrFail($id);
        $student->update($validated);


        
        return response()->json(['success' => 'Student updated successfully.']);
    }


    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();



        return response()->json(['success' => 'Student deleted successfully.']);
    }


    public function getTeachers()
    {
        $teachers = Teacher::all();
        return response()->json($teachers);
    }
}
