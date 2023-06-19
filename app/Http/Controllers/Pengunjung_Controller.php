<?php

namespace App\Http\Controllers;

use App\Exports\TourisExport;
use App\Models\Pengunjung;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class Pengunjung_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.pengunjung', [
            "pengunjung" => Pengunjung::join('users', 'pengunjungs.user', '=', 'users.id')
            ->select('pengunjungs.*','users.name')->get(),
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
        $pengunjungs = new Pengunjung();

        $pengunjungs->user = $request->id_user;
        $pengunjungs->alamat = $request->alamat;
        $pengunjungs->nohp = $request->nohp;
        $pengunjungs->fl_active = 1;

        $pengunjungs->save();
        return redirect('/pengunjung')->with('success','Touris berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pengunjung $pengunjung)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pengunjung $pengunjung)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pengunjung $pengunjung)
    {
        $data['user'] = $request->id_user;
        $data['alamat'] = $request->alamat;
        $data['nohp'] = $request->nohp;
        $data['fl_active'] = $request->fl_active;
        Pengunjung::where('id', $pengunjung->id)->update($data);
        return redirect('/pengunjung')->with('success','Touris berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pengunjung $pengunjung)
    {
        Pengunjung::destroy($pengunjung->id);
        return redirect('/pengunjung')->with('success','Pengunjung berhasil dihapus');
    }

    public function cetak()
    {
        return Excel::download(new TourisExport, 'touris.xlsx');
    }
}
