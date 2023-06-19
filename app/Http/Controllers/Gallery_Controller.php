<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\Gallerys;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Gallery_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.gallery', [
            "gallery" => Gallerys::join('destinations', 'destinations.id', '=', 'gallerys.id_destinasi')
            ->select('gallerys.*','destinations.nama_destinasi')->groupBy('gallerys.id_destinasi')->get(),
            "galleryfoto" => Gallerys::get(),
            "destinasi" => Destination::get(),
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
        $gallerys = new Gallerys();

        if($request->file('foto')){
            $file= $request->file('foto');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('assets/img'), $filename);
            $gallerys['foto']= $filename;
        }

        $gallerys->id_destinasi = $request->id_destinasi;
        $gallerys->save();
        return redirect('/gallery')->with('success','Foto Baru berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Gallerys $gallery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gallerys $gallery)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Gallerys $gallery)
    {
        $gallerys['id_destinasi'] = $request->id_destinasi;

        if($request->file('foto')){
            $file= $request->file('foto');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('assets/img'), $filename);
            $gallerys['foto']= $filename;
        }
        Gallerys::where('id', $gallery->id)->update($gallerys);
        return redirect('/gallery')->with('success','Foto berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gallerys $gallery)
    {
        Gallerys::where('id',$gallery->id)->delete();
        return redirect('/gallery')->with('success','Foto berhasil dihapus');
    }

    // public function destroygallery(Gallerys $gallery)
    // {
    //     Gallerys::destroy($gallery->id_destinasi);
    //     return redirect('/gallery')->with('success','Kumpulan Foto berhasil dihapus');
    // }
}
