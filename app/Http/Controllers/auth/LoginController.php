<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //use AuthenticatesUsers;

    public function index()
    {
        if(Auth::user()){
            return redirect()->route('task.index');
        }
        return view ('login.index')->with('message', '');
    }

    public function login(Request $request)
    {
         if (!Auth::attempt($request->only(['email','password']))){
            return redirect()->back()->withErrors('Usuário e/ou senha incorretos');
        } 
        
        return redirect()->route('task.index') ->with("message", "Seja bem vindo(a)");
    }
}

