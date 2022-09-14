<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\User;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $this->validate($request,[
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            ]);
        $user=User::query()->create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'api_token' => Str::random(60),
        ]);
        $token=$user->createToken('api_token')->plainTextToken;
        return response([
            'message'=>'اطلاعات با موفقیت ذخیره شد.',
            'token' => $token
        ]);
    }

    public function login(Request $request)
    {
        $validate=$this->validate($request,[
           'email' => 'required|exists:users',
            'password' => 'required'
        ]);
        if (! auth()->attempt($validate)){
            return response([
                'messages'=>'اطلاعات صحیح نیست.'
            ]);
        }
            return \response([
                'messages' => 'خوش آمدید.'
            ]);
    }
}
