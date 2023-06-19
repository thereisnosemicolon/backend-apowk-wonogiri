<?php

namespace App\Http\Controllers;

use App\Exports\DestinasiExport;
use App\Models\Destination;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class Destinations_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.destinasi', [
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
        $destinations = new Destination();

        $destinations->nama_destinasi = $request->nama_destinasi;
        $destinations->lokasi = $request->lokasi;
        $destinations->deskripsi = $request->deskripsi;
        $destinations->latitude = $request->latitude;
        $destinations->longitude = $request->longitude;
        $destinations->link = $request->link;

        $destinations->save();
        return redirect('/destinasi')->with('success','Destinasi Baru berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Destination $destinasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Destination $destinasi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Destination $destinasi)
    {
            $data['nama_destinasi'] = $request->nama_destinasi;
            $data['deskripsi'] = $request->deskripsi;
            $data['lokasi'] = $request->lokasi;
            $data['latitude'] = $request->latitude;
            $data['longitude'] = $request->longitude;
            $data['link'] = $request->link;
            Destination::where('id', $destinasi->id)->update($data);
            return redirect('/destinasi')->with('success','Destinasi berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Destination $destinasi)
    {
        Destination::destroy($destinasi->id);
        return redirect('/destinasi')->with('success','Destinasi berhasil dihapus');
    }

    public function cetak()
    {
        return Excel::download(new DestinasiExport, 'destinasi.xlsx');
    }

}
