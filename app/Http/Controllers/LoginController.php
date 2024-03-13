<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Auth, Hash;

class LoginController extends Controller
{
    public function login(Request $request){
        try{
            $validator = Validator::make($request->all(), [
                'email' => 'required',
                'password' => 'required',
            ],
            [
                'email.required'=> 'Email is required',
                'password.required'=> 'Password is required'
            ]);
     
            if ($validator->fails()) {
                return redirect()->withErrors($validator);
            }
            $userdata = array(
                'email' => $request->get('email') ,
                'password' => $request->get('password')
            );
            if (Auth::attempt($userdata))
            {
                return redirect()->route('products');
            }
            else
            {
                return redirect()->back()->with('error','Login failed');
            }
        }
        catch(\Exception $e){
            return redirect()->back()->with('error', 'Something Went Wrong');
        }
    }

    public function signUp(Request $request){
        try{
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required',
            ],
            [
                'name.required'=> 'Name is required',
                'email.required'=> 'Email is required',
                'password.required'=> 'Password is required'
            ]);
            if ($validator->fails()) {
                return redirect()->withErrors($validator);
            }

            if ($request->get('name') != "" && $request->get('email') != "" && $request->get('password') != "")
            {
                $user = User::create([
                    'name' => $request->get('name'),
                    'email' => $request->get('email'),
                    'password' => Hash::make($request->get('password')),
                ]);

                return redirect()->route('login-page');
             }
            else
            {
                return redirect()->back()->with('error','Sign Up failed');
            }
        }
        catch(\Exception $e){
            return redirect()->back()->with('error', 'Something Went Wrong');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login-page');
    }
}
