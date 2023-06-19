<?php

namespace App\Exports;

use App\Models\Destination;
use Maatwebsite\Excel\Concerns\FromCollection;

class DestinasiExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Destination::all();
    }
}
