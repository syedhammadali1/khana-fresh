<?php

namespace App\Exports;

use App\Models\Zip;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ZipExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function headings(): array
    {
        return[
            'id',
            'place',
            'zip',
        ];
    }

    public function collection()
    {
       return collect(Zip::all('id','zip_name','name'));
    }
}
