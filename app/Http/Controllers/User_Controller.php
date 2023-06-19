<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class User_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.user', [
            "users" => User::get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $validasidata = $request->validate([
        //     'username' => 'required',
        //     'name' => 'required|max:255',
        //     'email' => 'required'
        // ]);

        $users = new User;

        $users->name = $request->name;
        $users->username = $request->username;
        $users->email = $request->email;
        $users->user_role = $request->user_role;
        $users->password = Hash::make($request->password);

        $users->save();
        return redirect('/user')->with('success','User berhasil ditambahkan');
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

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $data['name'] = $request->name;
        $data['username'] = $request->username;
        $data['email'] = $request->email;
        $data['user_role'] = $request->user_role;
        $data['password'] = Hash::make($request->password);
        User::where('id', $user->id)->update($data);
        return redirect('/user')->with('success','User berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        User::destroy($user->id);
        return redirect('/user')->with('success','User berhasil dihapus');
    }
}
