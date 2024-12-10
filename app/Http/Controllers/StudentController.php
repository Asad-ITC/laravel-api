<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{

    function list()
    {
        // return "List function called";
        return Student::all();
    }

    function addStudent(Request $request)
    {
        $student = new Student();
        $student->name = $request->name;
        $student->email = $request->email;
        $student->phone = $request->phone;
        if ($student->save()) {
            return ["status" => "success", "message" => "Student added successfully"];
        } else {
            return ["status" => "error", "message" => "Something went wrong"];
        }
    }

    function updateStudent(Request $request)
    {
        $student = Student::find($request->id);
        $student->name = $request->name;
        $student->email = $request->email;
        $student->phone = $request->phone;
        if ($student->save()) {
            return ["status" => "success", "message" => "Student updated successfully"];
        } else {
            return ["status" => "error", "message" => "Something went wrong"];
        }
    }
}
