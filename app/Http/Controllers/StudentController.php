<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Validator;

class StudentController extends Controller
{
    // Insert Data Useing Api
    public function index(){
        $student = Student::all();
        $data = [
            'status' =>200,
            'student' =>$student
        ];
        return response()->json($data,200);
    }
    // Insert Data Useing Api
    public function upload(Request $request) {
        $validator = Validator::make($request->all(), 
        [
            'name'=>'required',
            'email'=>'required|email'
        ]);

        if($validator->fails()) {
            $data=[
                "status"=>422,
                "message"=>$validator->messages()
            ];
            return response()->json($data,422);
        } else {
            $student = new Student;

            $student->name=$request->name;
            $student->email=$request->email;
            $student->phone=$request->phone;
            $student->save();

            $data=[
                'status'=>200,
                'message'=>'Data Uploaded Successfully'
            ];
            return response()->json($data,200);
        }
    }

    // Update Data Useing Api
    public function edit(Request $request, $id) {
        $validator = Validator::make($request->all(), 
        [
            'name'=>'required',
            'email'=>'required|email'
        ]);

        if($validator->fails()) {
            $data=[
                "status"=>422,
                "message"=>$validator->messages()
            ];
            return response()->json($data,422);
        } else {
            $student = Student::find($id);

            $student->name=$request->name;
            $student->email=$request->email;
            $student->phone=$request->phone;
            $student->save();

            $data=[
                'status'=>200,
                'message'=>'Data Updated Successfully'
            ];
            return response()->json($data,200);
        }
    }
    // Delete Data useing Api
    public function delete($id) {
        $student = Student::find($id);
        $student->delete();
        $data=[
            'status'=>200,
            'message'=>'Data Deleted Successfully'
        ];
        return response()->json($data,200);
    }
}
