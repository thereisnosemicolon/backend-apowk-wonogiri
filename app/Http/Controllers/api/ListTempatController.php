<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Destination;

class ListTempatController extends Controller
{
    public function index()
    {
        $data = Destination::all();


        return response()->json([
            'status' => 200,
            'messages' => $data
        ]);
    }



    public function show(string $id)
    {
        $data = Destination::where('id', $id)->get();
        return response()->json([
            'status' => 200,
            'messages' => $data
        ]);
    }


    public function edit(string $id)
    {
        //
    }


    public function update(Request $request, string $id)
    {
        //
    }


    public function destroy(string $id)
    {
        //
    }
}
