<?php

namespace App\Exports;

use App\Models\Admin\Fees;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;

class FeeExport implements FromCollection,WithHeadings,ShouldAutoSize, WithEvents,WithStrictNullComparison
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DB::table('fees')
        ->join('fee_sections','fees.id','=','fee_sections.fees_id')
        ->select('fees.beneficiary_id', 'fees.beneficiary','fees.school', 'fees.yearlyfee', 'fees.AllocatedYealyFee','fees.year',
        'fees.expectedterm1','fees.expectedterm2','fees.expectedterm3',
        'fee_sections.term1','fee_sections.term2','fee_sections.term3','fees.yearlyfeebal'
        )
        ->get();

        // (['beneficiary_id','beneficiary','yearlyfee','yearlyfeebal','year'])
    }

    public function headings(): array
    {
        return [
            'Beneficiary No',
            'Beneficiary Name',
            'School',
            'Expected Yearly Fee',
            'Allocated Fee',
            'Year',
            'Expected Term 1',
            'Expected Term 2',
            'Expected Term 3',
            'Term 1',
            'Term 2',
            'Term 3',
            'Annual Fee Balance',
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:L1'; // All headers
                $styleArray = [
                    'borders' => [
                        'outline' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                            'color' => ['argb' => 'FFFF0000'],
                        ],
                    ],
                ];
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(13);
                // ->applyFromArray($styleArray);
                
            },
        ];
    }
}
