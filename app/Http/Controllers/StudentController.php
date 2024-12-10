<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{

    function list()
    {
        // return "List function called";
        return Student::all();
    }

    function addStudent(Request $request)
    {
        $rules = [
            'name' => 'required | min:2 | max:10',
            'email' => 'required | email',
            'phone' => 'required',
        ];
        $validation = Validator::make($request->all(), $rules);

        if ($validation->fails()) {
            return ["status" => "error", "message" => $validation->errors()];
        }

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

    function deleteStudent($id)
    {
        $student = Student::find($id);
        if ($student->delete()) {
            return ["status" => "success", "message" => "Student deleted successfully"];
        } else {
            return ["status" => "error", "message" => "Something went wrong"];
        }
    }


    function deleteStudent2($id)
    {
        $student = Student::destroy($id);
        if ($student) {
            return ["status" => "success", "message" => "Student deleted successfully"];
        } else {
            return ["status" => "error", "message" => "Something went wrong"];
        }
    }

    function searchStudent($name)
    {
        $student = Student::where('name', 'like', '%' . $name . '%')->get();
        if ($student) {
            return ["status" => "success", "message" => $student];
        } else {
            return ["status" => "error", "message" => "no record found"];
        }
    }
}
