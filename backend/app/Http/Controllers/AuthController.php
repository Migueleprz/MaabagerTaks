<?php

namespace App\Http\Controllers;

use App\Helpers\JwtAuth;
use App\Http\Requests\AuthRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function registro(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'=>'required|string',
            'email'=>'required|string|email|unique:users',
            'password'=>'required|string|min:6',
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json([
                'error'=> $errors
            ],400);
        }

        try {
            User::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=> hash('sha256',$request->password),
            ]);

            return response()->json([
                'message'=> 'Usuario registrado!'
            ],200);

        }catch (\Exception $e) {
            return response()->json([
                'message'=>'Error: '.$e->getMessage()
            ],500);
        }
    }

    public function iniciarSesion(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'=>'required|string|email',
            'password'=>'required|string|min:6',
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json([
                'error'=> $errors
            ],400);
        }

        $email = $request->email;
        $password = $request->password;
        return  (new JwtAuth())->iniciarSesion($email, $password);
    }
}
