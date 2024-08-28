<?php

namespace App\Exports;

use App\Models\Record;
use Maatwebsite\Excel\Concerns\FromCollection;

class RecordsExport implements FromCollection
{
    public function collection()
    {
        return Record::with(['supplier', 'category', 'product'])->get();
    }
}
