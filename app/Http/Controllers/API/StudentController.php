<?php

namespace App\Http\Controllers\API;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;




class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::all();
        return response()->json([
            'status' => 200,
            'students' => $students,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $student = new Student;
        $validator = Validator::make($request->all(),[
            'name' => 'required|max:191',
            'course' => 'required|max:191',
            'email' => 'required|max:191',
            'phone' => 'required|numeric',

        ]);

        if($validator->fails())
        {
            return response()->json([
                'validator_err' => $validator->messages(),

            ]);
        }


        else
        {
            $student = new Student;

            $student->name = $request->input('name');
            $student->course = $request->input('course');
            $student->email = $request->input('email');
            $student->phone = $request->input('phone');
            $student->save();

            return response()->json([
                'status' => 200,
                'message' => 'Student update Successfully',
            ]);
        }






    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student = Student::find($id);
        if($student)
        {
            return response()->json([

                'status' => 200,
                'student' =>$student,

            ]);
        }

        else
        {
            return response()->json([

                'status' => 404,
                'message' =>'No student ID Found',

            ]);
        }

    }





    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|max:191',
            'course' => 'required|max:191',
            'email' => 'required|max:191',
            'phone' => 'required|numeric',

        ]);

        if($validator->fails())
        {
            return response()->json([
                'validator_err' => $validator->messages(),

            ]);
        }


        else
        {
            $student =  Student::find($id);

            if($student)
            {



            $student->name = $request->input('name');
            $student->course = $request->input('course');
            $student->email = $request->input('email');
            $student->phone = $request->input('phone');
            $student->update();

            return response()->json([
                'status' => 200,
                'message' => 'Student update Successfully',
            ]);
         }
         else
         {
             return response()->json([

                 'status' => 404,
                 'message' =>'No student ID Found',

             ]);
         }
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = Student::find($id);
        $student->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Student deleted Successfully',
        ]);
    }
}
