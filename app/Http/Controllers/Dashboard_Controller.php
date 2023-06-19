<?php

namespace App\Http\Controllers;

use App\Models\DashboardModel;
use App\Models\Destination;
use App\Models\Gallerys;
use App\Models\Pengunjung;
use Illuminate\Http\Request;

class Dashboard_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.dashboard', [
            "touris" => Pengunjung::count(),
            "destinasi" => Destination::count(),
            "gallery" => Gallerys::count(),
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(DashboardModel $dashboardModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DashboardModel $dashboardModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DashboardModel $dashboardModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DashboardModel $dashboardModel)
    {
        //
    }
}
