<?php

namespace App\Exports;

use App\Models\Admin\Fees;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class FeeExport implements FromCollection,WithHeadings,ShouldAutoSize, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Fees::select(['beneficiary_id','beneficiary','yearlyfee','yearlyfeebal','year'])->get();
    }

    public function headings(): array
    {
        return [
            'Beneficiary Id',
            'Beneficiary',
            'Yearly Fee',
            'Yearly Fee Balance',
            'Year'
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:E1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);
            },
        ];
    }
}
