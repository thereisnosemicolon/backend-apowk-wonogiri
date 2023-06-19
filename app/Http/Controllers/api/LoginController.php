<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request){

        csrf_token();

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return response()->json(['status' => "200", 'messages' => $request->email]);
        } else {
            return response()->json(['status' => "400", 'messages' => "Not found users"]);
        }
        // $validation = User::Where('email', $_POST['email'])->Where('password', bcrypt($_POST['password']))->get();
    }
}
