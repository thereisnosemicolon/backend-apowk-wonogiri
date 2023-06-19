<?php

namespace App\Exports;

use App\Models\Pengunjung;
use Maatwebsite\Excel\Concerns\FromCollection;

class TourisExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Pengunjung::join
        ('users', 'pengunjungs.user', '=', 'users.id')
        ->select('users.name','pengunjungs.alamat','pengunjungs.nohp','pengunjungs.created_at')->get();
    }
}
