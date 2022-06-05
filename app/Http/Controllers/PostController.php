<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StuRegister;
use Illuminate\Support\Facades\Validator;
use Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return View('post');
        // $method = $request->method();
        // if ($request->isMethod('post')) {
        //     //
        // }
        echo "Santosh Api";
                // $input = $request->all();

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        
       $data = [
            'name' => $post['name'],
        ];

        echo "<pre>";
        print_r($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {    
            //Its  Work  Json && FormData Parameters

        $validator = Validator::make($request->all(), [
            'fname' => 'required|min:3|max:180',
            'lname' => 'required|min:3|max:180',
            'email' => 'required|unique:stu_registers',
            'password' => 'required|min:5|max:180',
        
        ]);

        if($validator->fails()){
            return response()->json([
                'status'=>201,
                'message'=>$validator->messages()
            ], 201);
        }else{
            $student = new StuRegister;

            $student->fname = $request->fname;
            $student->lname = $request->lname;
            $student->email = $request->email;
            $student->password = $request->password;
            $student->phone = $request->phone;
            $student->gender = $request->gender;
            $student->dob = $request->dob;
           // $student->status = $request->fname;

           $student->save();
           return response()->json([
            'status'=>200,
            'id'=> $student->id, //Insert Register User Id
            'email'=>$student->email, //Insert Register User Email Id
            'message'=>'Student Created Succesfully'
        ], 200);
        }
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        
        ]);

        if($validator->fails()){
            return response()->json([
                'status'=>201,
                'message'=>$validator->messages()
            ], 201);
        }else{
            if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 
                echo 'Yessss';
                $user = Auth::StuRegister(); 
                echo $user;
                // $success['token'] =  $user->createToken('MyApp')-> accessToken; 
                // $success['name'] =  $user->name;

                return response()->json([
                    'status'=>201,
                    'message'=>'Login successfully'
                ], 201);
       
              //  return $this->sendResponse($success, 'Login successfully.');
            } 
            else{ 
                return response()->json([
                    'status'=>201,
                    'message'=>'Unauthorised'
                ], 201);
            } 
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
        $student = StuRegister::find($id);

        if(!$student){
            return response()->json([
                'status'=>404,
                'message'=> "Must Be correct pass Student ID"
            ], 404);
        }
        else{
        return response()->json([
            'status'=>200,
            'message'=> $student
        ], 200);
    }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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

        //Update Work Only Json Parameters

        $validator = Validator::make($request->all(), [
            'fname' => 'required|min:3|max:180',
            'lname' => 'required|min:3|max:180',
            'email' => 'required|unique:stu_registers',
            'password' => 'required|min:5|max:180',
        
        ]);

        if($validator->fails()){
            return response()->json([
                'status'=>422,
                'message'=>$validator->messages()
            ], 422);
        }else{

        $student = StuRegister::find($id);

        if(!$student){
            return response()->json([
                'status'=>404,
                'message'=> "Must Be correct pass Student ID"
            ], 404);

        }else{

            $student->fname = $request->fname;
            $student->lname = $request->lname;
            $student->email = $request->email;
            $student->password = $request->password;
            $student->phone = $request->phone;
            $student->gender = $request->gender;
            $student->dob = $request->dob;

            $student->update();
            return response()->json([
                'status'=>200,
                'message'=> "Student Update Successfully"
            ], 200);

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
        $student = StuRegister::find($id);

        if(!$student){
            return response()->json([
                'status'=>404,
                'message'=> "Must Be correct pass Student ID"
            ], 404);
        }
        else{
            $student->delete();
        return response()->json([
            'status'=>200,
            'message'=> 'Student Deleted Succefully'
        ], 200);
    }
    }
}
