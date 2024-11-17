<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordFormRequest;
use App\Http\Requests\UserFormRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $message = $request->session()->get('message');
        return view ('home', compact ( "message"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('register.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserFormRequest $request)
    {
        User::create($request->all());

        $message = "Usuário criado com sucesso";

        return redirect()->route('login', compact ( "message"));
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
    public function changepassword(){
        return view('register.change_password');
    }

    public function changedpassword(Request $request){
        if (!Auth::attempt($request->only(['email','password']))){
            return redirect()->back()->withErrors('Senha Atual incorreta');
        }

        if($request->newpassword !== $request->password_confirmation){
            return redirect()->back()->withErrors('A confirmação da nova senha não confere');
        }

        $user = User::find(Auth::user()->id);
        $user->password = Hash::make($request->newpassword);
        

        $user->save();
        $request->session()->flash('mensagem',"Senha alterada com sucesso");
        return redirect()->route('task.index');
    }
}
