<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
//use Validator;
use Illuminate\Support\Facades\Validator;

class UserApiController extends Controller
{
    //get api for fetch user
    public function showData($id=null){
        if($id==''){
            $users=User::get();
            return response()->json(['users'=>$users],200);
        }
        else{
            $users=User::find($id);
            return response()->json(['users'=>$users],200);
        }
    }

    //post api for add user
    public function addUser(Request $request){
        if($request->ismethod('post')){
            $data=$request->all();
            //return $data;
            $rules=[
                'name'=>'required',
                'email'=>'required|email|unique:users',
                'password'=>'required'
            ];

            $customMesage=[
                'name.required'=>'Name is required',
                'email.required'=>'Email is required',
                'email.email'=>'Email Must be a Valid email',
                'password.required'=>'Password is required',

            ];
            $validator=Validator::make($data,$rules,$customMesage);
            if($validator->fails()){
                return response()->json($validator->errors(), 422);
            }
            $user=new User();
            $user->name=$data['name'];
            $user->email=$data['email'];
            $user->password=bcrypt($data['password']);
            $user->save();
            $message="Usewr Successfully Added";
            return response()->json(['message'=>$message], 201);
        }
    }

    //post api for multiple add user
    public function addMultipleUser(Request $request){
        if($request->ismethod('post')){
            $data=$request->all();
            //return $data;
            $rules=[
                'users.*.name'=>'required',
                'users.*.email'=>'required|email|unique:users',
                'users.*.password'=>'required'
            ];

            $customMesage=[
                'users.*.name.required'=>'Name is required',
                'users.*.email.required'=>'Email is required',
                'users.*.email.email'=>'Email Must be a Valid email',
                'users.*.password.required'=>'Password is required',

            ];
            $validator=Validator::make($data,$rules,$customMesage);
            if($validator->fails()){
                return response()->json($validator->errors(), 422);
            }
            foreach($data['users'] as $adduser){
                $user=new User();
            $user->name=$adduser['name'];
            $user->email=$adduser['email'];
            $user->password=bcrypt($adduser['password']);
            $user->save();
            $message="User Multiple Successfully Added";
            }
            return response()->json(['message'=>$message], 201);
        }
    }
}
