<?php

namespace App\Imports;

use App\Models\Zip;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class ZipImport implements ToModel, WithChunkReading
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        try {
            if (is_null(Zip::where('name', $row[1])->first())) {
                return new Zip([
                    'zip_name'   => $row[0],
                    'name'    => $row[1],
                    'tax_rate'    => $row[2],
                ]);
            }
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }

    }

    // public function rules(): array
    // {
    //     return [
    //         '1' => ['int', function ($attribute, $value, $onFailure) {
    //             if (!is_null(Zip::where('name', $value)->first())) {
    //                 $onFailure('Already Taken');
    //             }
    //         }]
    //     ];
    // }

    public function chunkSize(): int
    {
        return 500;
    }
}
