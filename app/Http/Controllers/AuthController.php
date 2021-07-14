<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiServiceController;

class AuthController extends Controller
{
    public function login(Request $request){
        $data = $request->except('id','_token');

        $validated = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $result = ApiServiceController::postApi('user','login', 'POST', $data);
        if(is_array($result) && $result['error']) return redirect()->back()->with('invalid', 'Wrong Email or Password');
        
        \Session::put('token',$result->token);
        \Session::put('role',$result->role);
        \Session::put('id',$result->id);
        return redirect()->route('home');
    }

    public function register(Request $request){
        $data = $request->except('id','_token');

        $validated = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'username' => 'required',
            'email' => 'required',
            'password' => 'required',
            'age' => 'required|numeric',
        ]);

        $result = ApiServiceController::postApi('user','register', 'POST', $data);

        if(is_array($result) && $result['error']) return redirect()->back()->with('invalid', $result['error']);
        
        return redirect()->route('login');
    }

    public function logout(){
        \Session::flush();
        return redirect()->route('home');
    }
}
