<?php

namespace App\Http\Controllers;

use App\Models\LoginModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Login_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.login.index',[
            'title' => "Halaman Login",
        ]);
    }

    public function authenticate(Request $request)
    {
        $login = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
       ]);

       if(Auth::attempt($login)){
        $request->session()->regenerate();
        return redirect()->intended('/dashboard');
       }
       return back()->with('fail', 'Login Failed!');
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(LoginModel $loginModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LoginModel $loginModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LoginModel $loginModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LoginModel $loginModel)
    {
        //
    }
}
