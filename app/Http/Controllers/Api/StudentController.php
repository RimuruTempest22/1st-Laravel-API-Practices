<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use PHPUnit\Framework\MockObject\ReturnValueNotConfiguredException;

class StudentController extends Controller
{
    //Router Crud and Search function
    public function index(){
        $AllData = Student::all();
        if($AllData ->count() > 0)
        {
            return response()-> json([
                'status' => 200
            ,   'students' => $AllData
            ], 200);

        }
        else
        {
            return response()-> json([
                'status' => 404
            ,   'message' => "No Data records Exist!"
            ], 404);
        }
   
    }

    public function store(Request $request){

        $validator = FacadesValidator::make($request->all(),[
            'first_name' => 'required|max:191',
            'last_name' => 'required|max:191',
            'gender' => 'required|max:191',
            'age' => 'required|max:191',
            'email' => 'required|max:191',
        ]);

        if($validator->fails()){
            return response()->json(
                [  
                    'status' => 422
                ,   'errors' => $validator->getMessageBag()
                ], 422
            );
        }else{
            $student = Student::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'gender' => $request->gender,
                'age' => $request->age,
                'email' => $request->email,
            ]);    
            
            if($student){

                return response()->json([
                        'status' => 200
                    ,   'message' => 'Student Created Successfully!'
                ], 200);

            }else{
                return response()->json([
                    'status' => 500
                ,   'message' => 'Something went wrong please check thank you.'
                ], 500);
            }
        }

    }

    public function show($id){

        $student = Student::find($id);

        if($student){
            return response()->json([
                'status' => 200
            ,   'student' => $student
            ], 200);

        }else{
            return response()->json([
                'status' => 404
            ,   'message' => 'No such data found, please check thank you.'
            ], 404);
        }


    }

    public function edit($id){
        $student = Student::find($id);

        if($student){
            return response()->json([
                'status' => 200
            ,   'student' => $student
            ], 200);

        }else{
            return response()->json([
                'status' => 404
            ,   'message' => 'No such data found, please check thank you.'
            ], 404);
        }
    }

    public function update(Request $request, int $id){

        $validator = FacadesValidator::make($request->all(),[
            'first_name' => 'required|max:191',
            'last_name' => 'required|max:191',
            'gender' => 'required|max:191',
            'age' => 'required|max:191',
            'email' => 'required|max:191',
        ]);

        if($validator->fails()){
            return response()->json(
                [  
                    'status' => 422
                ,   'errors' => $validator->getMessageBag()
                ], 422
            );
        }else{
            $student = Student::find($id);
            if($student){
                $student->update([
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'gender' => $request->gender,
                    'age' => $request->age,
                    'email' => $request->email,
                ]);    

                return response()->json([
                        'status' => 200
                    ,   'message' => 'Student updated Successfully!'
                ], 200);

            }else{
                return response()->json([
                    'status' => 404
                ,   'message' => 'No such data found, please check thank you.'
                ], 404);
            }
        }

    }

    public function destroy($id){

        $student = Student::find($id);

        if($student){
            $student->delete();
            return response()->json([
                'status' => 200
            ,   'message' => 'Deleted data Successfully!'
            ], 200);
        }else{
            return response()->json([
                'status' => 404
            ,   'message' => 'No such data found, please check thank you.'
            ], 404);
        }
    }

}
